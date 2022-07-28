<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Commande extends Model
{
    use HasFactory;
    protected $fillable = [
        'ref',
        'product_id',
        'garnitures',
        'sauces',
        'supplements',
        'total',
        'statut',
    ];
   
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, "product_id");
    }
}
