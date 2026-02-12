<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $table = 'pengaduan';

    protected $primaryKey = 'id_pengaduan';

    protected $fillable = [
        'user_id',
        'kategori_id',
        'judul',
        'isi_laporan',
        'alamat',
        'alasan_penolakan',
        'foto',
        'status_pengaduan_id',
            'is_complain',
        'tanggal_komplain',
        'isi_komplain',
    ];

    protected $casts = [
    'tanggal_komplain' => 'datetime',
    'is_complain' => 'boolean',
];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id_kategori');
    }

    public function status()
    {
        return $this->belongsTo(StatusPengaduan::class, 'status_pengaduan_id', 'id_status_pengaduan');
    }

    public function tanggapan()
    {
        return $this->hasMany(Tanggapan::class, 'pengaduan_id', 'id_pengaduan');
    }

    public function lampiran()
    {
        return $this->hasMany(Lampiran::class, 'pengaduan_id', 'id_pengaduan');
    }

    public function riwayat()
    {
        return $this->hasMany(RiwayatPengaduan::class, 'pengaduan_id', 'id_pengaduan');
    }
}
