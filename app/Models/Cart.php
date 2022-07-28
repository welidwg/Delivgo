<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'resto_id',
        'product_id',
        'user_id',
        'quantity',
        'total',
    ];

    function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, "product_id");
    }
    function resto(): BelongsTo
    {
        return $this->belongsTo(User::class, "resto_id");
    }
}
