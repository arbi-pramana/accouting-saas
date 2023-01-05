<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model 
{

    protected $table = 'suppliers';
    protected $guarded = [];
    public $timestamps = true;

    public function hutang_dagang()
    {
        $date = [request('start'),request('end')];
        return $this->hasMany(Purchase::class,'supplier_id','id')
            ->when(request('start'),function($q) use ($date){
                return $q->wherebetWeen('date',$date);
            })
            ->where('type','Pembelian');
    }

    public function retur_pembelian()
    {
        $date = [request('start'),request('end')];
        return $this->hasMany(Purchase::class,'supplier_id','id')
            ->when(request('start'),function($q) use ($date){
                return $q->wherebetWeen('date',$date);
            })
            ->where('type','Retur Pembelian');
    }
}