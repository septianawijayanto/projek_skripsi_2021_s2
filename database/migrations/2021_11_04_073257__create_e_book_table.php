<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_book', function (Blueprint $table) {
            $table->id();
            $table->string('judul_buku');
            $table->string('file');
            $table->enum('kelas', ['Umum', 'VII', 'VIII', 'IX']);
            $table->string('penulis', 30);
            $table->foreignId('penerbit_id')->references('id')->on('penerbit')->onDelete('cascade');
            $table->foreignId('klasifikasi_id')->references('id')->on('klasifikasi')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('e_book');
    }
}
