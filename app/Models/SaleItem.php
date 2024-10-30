<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    /** @use HasFactory<\Database\Factories\SaleItemFactory> */
    use HasFactory, HasUuids;

    protected function product(){
        return $this->belongsTo(Product::class);
    }

    protected function sale(){
        return $this->belongsTo(Sale::class);
    }

}
