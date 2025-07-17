<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('kendalas', function (Blueprint $table) {
            
            $table->id();
            $table->string('kode_pendaftar')->nullable();
            $table->string('nama');
            $table->string('status_pendaftar')->nullable();
            $table->string('no_wa')->nullable();
            $table->foreignId('petugas_id')->references("id")->on("penggunas");
            $table->text('kendala');
            $table->string('tindak_lanjut')->nullable();
            $table->string('status');
            $table->date('tanggal_penanganan')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendalas');
    }
};
