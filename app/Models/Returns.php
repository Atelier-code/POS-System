<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Returns extends Model
{
    /** @use HasFactory<\Database\Factories\ReturnsFactory> */
    use HasFactory , HasUuids;

    protected function product()
    {
        return $this->belongsTo(Product::class);
    }
}
