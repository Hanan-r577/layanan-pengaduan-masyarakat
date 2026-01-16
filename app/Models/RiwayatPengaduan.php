<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatPengaduan extends Model
{
    protected $table = 'riwayat_pengaduan';

    protected $fillable = [
        'pengaduan_id',
        'status',
        'keterangan',
    ];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'pengaduan_id', 'id_pengaduan');
    }
}
