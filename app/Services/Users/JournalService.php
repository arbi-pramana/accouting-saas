<?php

namespace App\Services\Users;

use App\Models\Journal;
use App\Models\JournalItem;
use App\Traits\UserTrait;
use Illuminate\Support\Facades\DB;

class JournalService{
    use UserTrait;
    
    public function store($request)
    {
        DB::beginTransaction();
        try {
            $journal = new Journal();
            $journal->document_no = $request->document_no;
            $journal->date = $request->date;
            $journal->reference = $request->reference;
            $journal->description = $request->description;
            $journal->remarks =  $this->remarks();
            $journal->create_by = $this->create_by();
            $journal->save();
            
            foreach ($request->coa_id as $i => $value) {
                $item = new JournalItem();
                $item->date = $request->date;
                $item->journal_id = $journal->id;
                $item->coa_id = $request->coa_id[$i];
                $item->description = $request->description[$i];
                $item->debit = $request->debit[$i];
                $item->credit = $request->credit[$i];
                $item->create_by = $this->create_by();
                $item->remarks = $this->remarks();
                $item->save();
            }

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
            $journal = Journal::find($id);
            $journal->document_no = $request->document_no;
            $journal->date = $request->date;
            $journal->reference = $request->reference;
            $journal->description = $request->description;
            $journal->remarks =  $this->remarks();
            $journal->create_by = $this->create_by();
            $journal->save();
            
            JournalItem::where('journal_id',$journal->id)->delete();
            foreach ($request->coa_id as $i => $value) {
                $item = new JournalItem();
                $item->date = $request->date;
                $item->journal_id = $journal->id;
                $item->coa_id = $request->coa_id[$i];
                $item->description = $request->description[$i];
                $item->debit = $request->debit[$i];
                $item->credit = $request->credit[$i];
                $item->create_by = $this->create_by();
                $item->remarks = $this->remarks();
                $item->save();
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
        }
    }
}