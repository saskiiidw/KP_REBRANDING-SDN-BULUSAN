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
        Schema::create('kontak_pengaduan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->string('no_kontak');
            $table->enum('jenis', ['kontak', 'pengaduan'])->default('kontak');
            $table->string('subjek');
            $table->text('isi_pesan');
            $table->enum('status_penanganan', ['baru', 'diproses', 'selesai'])->default('baru');
            $table->foreignId('ditangani_oleh')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontak_pengaduan');
    }
};
