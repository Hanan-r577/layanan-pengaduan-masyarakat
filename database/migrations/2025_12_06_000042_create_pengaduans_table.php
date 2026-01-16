<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id('id_pengaduan');
            $table->foreignId('user_id')->constrained('users', 'id_user');
            $table->foreignId('kategori_id')->constrained('kategori', 'id_kategori');
            $table->string('judul');
            $table->text('isi_laporan');
            $table->text('alasan_penolakan')->nullable();
            $table->string('foto')->nullable();
            $table->foreignId('status_pengaduan_id')->constrained('status_pengaduan', 'id_status_pengaduan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduan');
    }
};
