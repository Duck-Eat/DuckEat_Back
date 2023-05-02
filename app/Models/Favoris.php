<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Favoris extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'restaurant_id'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users');
    }

    public function restaurants(): BelongsToMany
    {
        return $this->belongsToMany(Restaurant::class, 'restaurants');
    }
}
