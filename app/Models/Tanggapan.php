<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    protected $table = 'tanggapan';
    protected $primaryKey = 'id_tanggapan';

    protected $fillable = [
        'pengaduan_id',
        'user_id',
        'tanggapan'
    ];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'pengaduan_id', 'id_pengaduan');
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }
}
