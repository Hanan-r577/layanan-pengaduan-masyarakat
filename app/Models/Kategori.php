<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';

    protected $fillable = [
        'nama_kategori',
    ];
    
    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'kategori_id', 'id_kategori');
    }
}
