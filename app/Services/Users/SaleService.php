<?php

namespace App\Services\Users;

use App\Models\Coa;
use App\Models\Journal;
use App\Models\Sale;
use App\Traits\UserTrait;
use Illuminate\Support\Facades\DB;

class SaleService{
    use UserTrait;

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            $data['remarks'] = $this->remarks();
            $data['create_by'] = $this->create_by();
            Sale::create($data);

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
            $sale = Sale::find($id);
            $data = $request->all();
            $data['remarks'] = $this->remarks();
            $data['create_by'] = $this->create_by();
            $sale->update($data);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
        }
    }
}