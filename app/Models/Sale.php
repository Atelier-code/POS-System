<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    /** @use HasFactory<\Database\Factories\SaleFactory> */
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected static function generateId(): string
    {
        $prefix = 'ORD';

        $datePart = now()->format('dmy');


        $number = str_pad(mt_rand(1, 999), 3, '0', STR_PAD_LEFT);


        $letter = chr(mt_rand(65, 90));

        return $prefix . $datePart . $number . $letter;
    }


    protected static function booted(): void
    {
        static::creating(function ($sale) {
            $sale->id = static::generateId();
        });
    }
    public $guarded =[];


    public function user (){
        return $this->belongsTo(User::class);
    }

    public function saleItem (){
        return $this->hasMany(SaleItem::class);
    }

    public function returns(){
        return $this->hasMany(Returns::class);
    }

}
