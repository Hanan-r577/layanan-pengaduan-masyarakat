<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatSession extends Model
{
    protected $table = 'chat_sessions';

    protected $fillable = [
        'user_id',
        'nama',
        'email',
        'no_hp',
        'topik',
        'status',
    ];

    /* ================= RELATIONS ================= */

    // 1 session -> banyak pesan
    public function messages()
    {
        return $this->hasMany(ChatMessage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
