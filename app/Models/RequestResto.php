<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RequestResto extends Model
{
    use HasFactory;

    public function resto(): BelongsTo
    {
        # code...
        return $this->belongsTo(User::class, "resto_id");
    }

    public function deliverer(): BelongsTo
    {
        # code...
        return $this->belongsTo(User::class, "deliverer_id");
    }
}
