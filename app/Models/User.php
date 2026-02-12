<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $primaryKey = 'id_user'; // ⬅️ WAJIB

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'telp',
        'level',
    ];

    public function chatMessages()
    {
        return $this->hasMany(ChatMessage::class, 'user_id');
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
