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
        Schema::create('profil_sekolah', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sekolah');
            $table->string('npsn');
            $table->string('nss');
            $table->string('akreditasi');
            $table->text('alamat');
            $table->string('email');
            $table->string('telepon');
            $table->json('jam_kerja');
            $table->string('nama_kepsek');
            $table->string('nip_kepsek');
            $table->text('sambutan_kepsek');
            $table->string('foto_kepsek')->nullable();
            $table->text('visi');
            $table->text('misi');
            $table->text('sejarah')->nullable();
            $table->string('struktur_organisasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_sekolah');
    }
};
