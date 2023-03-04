<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypesRestaurant extends Model
{
    use HasFactory;
    protected $table = 'Types_restaurant';

    protected $primaryKey = 'id_Types_restaurant';

    protected $fillable = [
        'type_Types_restaurant'
    ];
    protected $hidden = [
        'updated_at',
        'created_at'
    ];
    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class, 'Manager', 'id_Types_restaurant', 'id_Restaurant');
    }

    public function preferences()
    {
        return $this->belongsToMany(User::class, 'Preferences', 'id_Types_restaurant', 'id_Utilisateur');
    }
}
