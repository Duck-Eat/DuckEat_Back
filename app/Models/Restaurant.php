<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
    protected $table = 'Restaurant';

    protected $primaryKey = 'id_Restaurant';

    public function user()
    {
        return $this->belongsTo(User::class, 'id_Utilisateur');
    }

    public function types()
    {
        return $this->belongsToMany(TypesRestaurant::class, 'Manager', 'id_Restaurant', 'id_Types_restaurant');
    }

    public function notes()
    {
        return $this->hasMany(Note::class, 'id_Restaurant');
    }
}