<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    /** @use HasFactory<\Database\Factories\SaleFactory> */
    use HasFactory;
    use HasUuids;

    protected function user (){
        return $this->belongsTo(User::class);
    }

    protected function saleItem (){
        return $this->hasMany(SaleItem::class);
    }

}
