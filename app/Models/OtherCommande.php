<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OtherCommande extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function deliverer(): BelongsTo
    {
        return $this->belongsTo(User::class, "deliverer_id");
    }
}
