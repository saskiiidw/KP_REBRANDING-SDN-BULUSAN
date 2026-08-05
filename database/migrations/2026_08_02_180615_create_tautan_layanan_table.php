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
        Schema::create('tautan_layanan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_layanan');
            $table->string('url');
            $table->string('ikon');
            $table->integer('urutan')->default(0);
            $table->boolean('is_eksternal')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tautan_layanan');
    }
};
