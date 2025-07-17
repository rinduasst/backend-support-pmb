<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterNoTelpNullableOnPenggunasTable extends Migration
{
    public function up()
    {
        Schema::table('penggunas', function (Blueprint $table) {
            $table->string('no_telp')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('penggunas', function (Blueprint $table) {
            $table->string('no_telp')->nullable(false)->change();
        });
    }
}
