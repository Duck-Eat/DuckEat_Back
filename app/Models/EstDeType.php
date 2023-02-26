<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstDeType extends Model
{
    use HasFactory;
    protected $table = 'etre';
    public $timestamps = false;

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'id_Restaurant');
    }

    public function typeRestaurant()
    {
        return $this->belongsTo(TypesRestaurant::class, 'id_Types_restaurant');
    }
}
