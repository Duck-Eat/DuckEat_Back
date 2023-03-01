<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
    protected $table = 'Restaurant';

    protected $primaryKey = 'id_Restaurant';

    protected $fillable = [
        'image_Restaurant',
        'nom_Restaurant',
        'horaires_Restaurant',
        'CP_Restaurant',
        'adresse_Restaurant',
        'ville_Restaurant',
        'id_Utilisateur',
        'types_restaurant',
    ];
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
