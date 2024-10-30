<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    use SoftDeletes;
    use HasUuids;

    protected $guarded =[];

    protected function saleItem()
    {
        return $this->hasMany(SaleItem::class);
    }

    protected function returns()
    {
        return $this->hasMany(Returns::class);
    }
}
