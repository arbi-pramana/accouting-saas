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
            Purchase::create($data);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
        }
    }

    public function update($request,$id)
    {
        DB::beginTransaction();
        try {
            $purchase = Purchase::find($id);
            $data = $request->all();
            $data['remarks'] = $this->remarks();
            $data['create_by'] = $this->create_by();
            $purchase->update($data);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
        }
    }
}