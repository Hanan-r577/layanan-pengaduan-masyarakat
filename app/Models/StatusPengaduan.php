<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusPengaduan extends Model
{
    protected $table = 'status_pengaduan';
    protected $primaryKey = 'id_status_pengaduan';

    protected $fillable = [
        'status',   // contoh: 'menunggu', 'proses', 'selesai'
    ];

    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'status_pengaduan_id', 'id_status_pengaduan');
    }
}
