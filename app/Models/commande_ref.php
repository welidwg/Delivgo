<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class commande_ref extends Model
{
    use HasFactory;
    protected $table = "commandes_refs";
    protected $primarykey = "id";

    public function resto(): BelongsTo
    {
        return $this->belongsTo(User::class, "resto_id");
    }

    public function deliverer(): BelongsTo
    {
        return $this->belongsTo(User::class, "deliverer_id");
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id");
    }


    public function items(): HasMany
    {
        return $this->hasMany(Commande::class, "commande_id");
    }

    public function messages(): HasMany
    {
        return $this->hasMany(CommandeMessage::class, "commande_id");
    }

    protected static function boot()
    {
        parent::boot();

        // Order by name ASC
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('created_at', 'desc');
        });
    }
}
