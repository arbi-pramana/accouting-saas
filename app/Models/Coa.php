<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Coa extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = true;

    public function saldo($id)
    {
        if(request('year') != null){
            $date = request('year')."-".request('month');
        } else {
            $date = null;
        }

        $coa = Coa::find($id)->total_opening_balance;
        $debit = JournalItem::where('coa_id',$id)->where('date','like','%'.$date.'%')->sum('debit');
        $credit = JournalItem::where('coa_id',$id)->where('date','like','%'.$date.'%')->sum('credit');
        $saldo = $coa  + $debit - $credit;
        return $saldo;
    }

    public function saldoByPeriod($id,$period)
    {
        if(request('year') != null){
            $date = request('year');
        } else {
            $date = date("Y");
        }
        $date = $date.'-'.str_pad($period,2,0,STR_PAD_LEFT);

        $debit = JournalItem::where('coa_id',$id)->where('date','like','%'.$date.'%')->sum('debit');
        $credit = JournalItem::where('coa_id',$id)->where('date','like','%'.$date.'%')->sum('credit');
        $coa = Coa::where('id',$id)->where('date','like','%'.$date.'%')->first();
        $coa = $coa ? $coa->total_opening_balance : 0;
        $saldo = $coa + $debit - $credit;
        
        return $saldo;
    }

    public function saldoByRange($id)
    {
        $request = request()->all();
        $journals = JournalItem::when(request('start'),function($q) use ($request){
                $q->whereBetween('date',[$request['start'],$request['end']]);
                return $q;
            })
            ->where('coa_id',$id)
            ->get();
            
        $data['debit'] = $journals->sum('debit');
        $data['credit'] = $journals->sum('credit');
        return $data;
    }
}
