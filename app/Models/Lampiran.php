<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lampiran extends Model
{
    protected $table = 'lampiran';
    protected $primaryKey = 'id_lampiran';

    protected $fillable = [
        'pengaduan_id',
        'nama_file',    // nama asli file
        'tipe_file',    // foto, pdf, video
        'path_file',     // lokasi file
    ];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'pengaduan_id', 'id_pengaduan');
    }
}
