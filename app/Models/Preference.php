<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preference extends Model {

    public function types(): BelongsToMany
    {
        return $this->belongsTo(Type::class);
    }
}
