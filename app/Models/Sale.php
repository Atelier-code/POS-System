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

    public $guarded =[];


    public function user (){
        return $this->belongsTo(User::class);
    }

    public function saleItem (){
        return $this->hasMany(SaleItem::class);
    }

}
