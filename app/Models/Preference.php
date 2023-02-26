<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    use HasFactory;
    protected $table = 'Preferences';

    public $incrementing = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_Utilisateur');
    }

    public function type()
    {
        return $this->belongsTo(TypesRestaurant::class, 'id_Types_restaurant');
    }
}
