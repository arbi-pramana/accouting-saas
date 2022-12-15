<?php

namespace App\Services\Users;

use App\Models\Coa;
use App\Models\Journal;
use App\Models\Purchase;
use App\Traits\UserTrait;
use Illuminate\Support\Facades\DB;

class PurchaseService{
    use UserTrait;

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $data['remarks'] = $this->remarks();
            $data['create_by'] = $this->create_by();
            $purchase = Purchase::create($data);

            if($request->type == "Pembelian"){
                // debit +
                // "Inventory",
                $coa_id = Coa::where('name',"Inventory")->where('create_by',$this->create_by())->first()->id;
                $journal = new Journal();
                $journal->coa_id = $coa_id;
                $journal->debit = $request->subtotal;
                $journal->reference_id = $purchase->id;
                $journal->type = "purchase";
                $journal->create_by =  $this->create_by();
                $journal->remarks =  $this->remarks();
                $journal->save();
                
                // "PPN",
                $coa_id = Coa::where('name',"PPN")->where('create_by',$this->create_by())->first()->id;
                $journal = new Journal();
                $journal->coa_id = $coa_id;
                $journal->debit = $request->tax_amount;
                $journal->reference_id = $purchase->id;
                $journal->type = "purchase";
                $journal->create_by =  $this->create_by();
                $journal->remarks =  $this->remarks();
                $journal->save();

                // credit -
                // coa selected
                $journal = new Journal();
                $journal->coa_id = $request->coa_id;
                $journal->credit = $request->payment_amount;
                $journal->reference_id = $purchase->id;
                $journal->type = "purchase";
                $journal->create_by =  $this->create_by();
                $journal->remarks =  $this->remarks();
                $journal->save();

                // "Hutang Usaha",
                $coa_id = Coa::where('name',"Hutang Usaha")->where('create_by',$this->create_by())->first()->id;
                $journal = new Journal();
                $journal->coa_id = $coa_id;
                $journal->credit = $request->payment_due_amount;
                $journal->reference_id = $purchase->id;
                $journal->type = "purchase";
                $journal->create_by =  $this->create_by();
                $journal->remarks =  $this->remarks();
                $journal->save();
            } else if($request->type == "Retur Pembelian"){
                // credit -
                // "Inventory",
                $coa_id = Coa::where('name',"Inventory")->where('create_by',$this->create_by())->first()->id;
                $journal = new Journal();
                $journal->coa_id = $coa_id;
                $journal->credit = $request->subtotal;
                $journal->reference_id = $purchase->id;
                $journal->type = "purchase";
                $journal->create_by =  $this->create_by();
                $journal->remarks =  $this->remarks();
                $journal->save();
                
                // "PPN",
                $coa_id = Coa::where('name',"PPN")->where('create_by',$this->create_by())->first()->id;
                $journal = new Journal();
                $journal->coa_id = $coa_id;
                $journal->credit = $request->tax_amount;
                $journal->reference_id = $purchase->id;
                $journal->type = "purchase";
                $journal->create_by =  $this->create_by();
                $journal->remarks =  $this->remarks();
                $journal->save();

                // debit +
                // coa selected
                $journal = new Journal();
                $journal->coa_id = $request->coa_id;
                $journal->debit = $request->payment_amount;
                $journal->reference_id = $purchase->id;
                $journal->type = "purchase";
                $journal->create_by =  $this->create_by();
                $journal->remarks =  $this->remarks();
                $journal->save();

                // "Hutang Usaha",
                $coa_id = Coa::where('name',"Hutang Usaha")->where('create_by',$this->create_by())->first()->id;
                $journal = new Journal();
                $journal->coa_id = $coa_id;
                $journal->debit = $request->payment_due_amount;
                $journal->reference_id = $purchase->id;
                $journal->type = "purchase";
                $journal->create_by =  $this->create_by();
                $journal->remarks =  $this->remarks();
                $journal->save();
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
        }
    }
}