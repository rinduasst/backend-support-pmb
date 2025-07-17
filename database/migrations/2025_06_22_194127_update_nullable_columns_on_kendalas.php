<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kendalas', function (Blueprint $table) {
            $table->string('nama')->nullable()->change();
            $table->text('kendala')->nullable()->change();
            $table->unsignedBigInteger('petugas_id')->nullable()->change();

            // Tambah foreign key constraint ulang (karena harus di-drop dulu)
            $table->dropForeign(['petugas_id']);
            $table->foreign('petugas_id')
                  ->references('id')
                  ->on('penggunas')
                  ->nullOnDelete(); // kalau pengguna dihapus, petugas_id diset null
        });
    }

    public function down(): void
    {
        Schema::table('kendalas', function (Blueprint $table) {
            $table->dropForeign(['petugas_id']);
            $table->string('nama')->nullable(false)->change();
            $table->text('kendala')->nullable(false)->change();
            $table->unsignedBigInteger('petugas_id')->nullable(false)->change();
            $table->foreign('petugas_id')->references('id')->on('penggunas');
        });
    }
};
