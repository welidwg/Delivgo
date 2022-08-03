<?php

namespace App\Models;

use Illuminate\Console\Command;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'avatar',
        'type',
        'city',
        'state',
        'address',
        'phone',
        'statut',
        'deliveryPrice',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    public $primaryKey  = 'user_id';

    public function products(): HasMany
    {
        # code...
        return $this->hasMany(Product::class, "resto_id");
    }

    public function toppings(): HasMany
    {
        # code...
        return $this->hasMany(Garniture::class, "resto_id");
    }

    public function sauces(): HasMany
    {
        # code...
        return $this->hasMany(Sauce::class, "resto_id");
    }

    public function drinks(): HasMany
    {
        # code...
        return $this->hasMany(Drink::class, "resto_id");
    }

    public function supplements(): HasMany
    {
        # code...
        return $this->hasMany(Supplement::class, "resto_id");
    }

    public function configs(): HasMany
    {
        # code...
        return $this->hasMany(RestoConfig::class, "resto_id");
    }

    public function region(): BelongsTo
    {
        # code...
        return $this->belongsTo(Region::class, "city");
    }

    public function commandesPassed(): HasMany
    {
        # code...
        return $this->hasMany(commande_ref::class, "user_id");
    }


    public function commandesReceived(): HasMany
    {
        # code...
        return $this->hasMany(commande_ref::class, "resto_id");
    }

    protected $hidden = [
        'password',
    ];
}
