<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSekolahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('sekolah', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('nama_sekolah');
        //     $table->string('logo_sekolah')->nullable();
        //     $table->string('logo_kab')->nullable();
        //     $table->string('logo')->nullable();
        //     $table->text('alamat');
        //     $table->string('kode_pos', 6);
        //     $table->text('desa');
        //     $table->text('kecamatan');
        //     $table->text('kabupaten');
        //     $table->text('provinsi');
        //     $table->string('email');
        //     $table->string('website');
        //     $table->string('no_telp');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sekolah');
    }
}
