<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function coa()
    {
        return $this->hasOne(Coa::class,"id","coa_id");
    }

    public function customer()
    {
        return $this->hasOne(Customer::class,"id","customer_id");
    }

    public function product()
    {
        return $this->hasOne(Product::class,"id","product_id");
    }
}
