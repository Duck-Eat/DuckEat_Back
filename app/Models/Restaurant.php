<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'user_id', 'hours', 'postal_code', 'address', 'city', 'image'
    ];

    protected $hidden = [
        'id', 'created_at', 'updated_at'
    ];

    protected $casts = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function types(): BelongsToMany
    {
        return $this->belongsToMany(Type::class, 'restaurants_types', 'restaurant_id', 'type_id');
    }

    public function notes(): BelongsToMany
    {
        return $this->belongsToMany(Note::class, 'notes', 'restaurant_id', 'user_id');
    }
}
