<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'id'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function restaurants(): HasMany
    {
        return $this->hasMany(Restaurant::class);
    }

    public function notes(): BelongsToMany
    {
        return $this->belongsToMany(Note::class, 'notes', 'user_id', 'restaurant_id');
    }

    public function types(): BelongsToMany
    {
        return $this->belongsToMany(Type::class, 'users_types', 'user_id', 'type_id');
    }

    public function favoris(): HasMany
    {
        return $this->hasMany(Favoris::class,'user_id');
    }
}
