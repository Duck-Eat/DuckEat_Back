<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    use HasFactory;
    protected $table = 'Manager';

    public $incrementing = false;

    public function type()
    {
        return $this->belongsTo(TypesRestaurant::class, 'id_Types_restaurant');
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'id_Restaurant');
    }
}
