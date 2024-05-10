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
        Schema::create('pengajuan_t', function (Blueprint $table) {
            $table->increments('id_pengajuan');
            $table->char('id', 3)->index('id');
            $table->date('tanggalPengajuan');
            $table->string('namaPengajuan')->nullable();
            $table->string('deskripsiPengajuan')->nullable();
            $table->string('filePengajuan')->nullable();
            $table->boolean('d_verified')->default(false);
            $table->boolean('f_verified')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_t');
    }
};
