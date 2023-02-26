<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $table = 'Note';

    public function user()
    {
        return $this->belongsTo(User::class, 'id_Utilisateur');
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'id_Restaurant');
    }
}
