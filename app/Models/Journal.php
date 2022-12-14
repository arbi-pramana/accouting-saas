<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    public function journal_items()
    {
        return $this->hasMany(JournalItem::class,'journal_id','id');
    }
}
