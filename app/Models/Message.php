<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $table = 'Messages';

    protected $primaryKey = 'id_Messages';

    public function sender()
    {
        return $this->belongsTo(User::class, 'id_Utilisateur');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'id_Utilisateur_recoit');
    }
}
