<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'from',
        'to',
        'title',
        'content',
    ];

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, "from");
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, "to");
    }
}
