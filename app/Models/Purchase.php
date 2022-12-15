<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function coa()
    {
        return $this->hasOne(Coa::class,"id","coa_id");
    }

    public function supplier()
    {
        return $this->hasOne(Supplier::class,"id","supplier_id");
    }

    public function product()
    {
        return $this->hasOne(Product::class,"id","product_id");
    }
}
