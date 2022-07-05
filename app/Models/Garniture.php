<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garniture extends Model
{
    use HasFactory;
    protected $fillable = [
        'resto_id',
        'product_id',
        'label',
        'maxPer',
    ];
}
