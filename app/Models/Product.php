<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'label',
        'resto_id',
        'price',
        'statut',
    ];

    public function Resto(): BelongsTo
    {
        return $this->belongsTo(User::class, "resto_id");
    }

    public $primaryKey  = 'product_id';
}
