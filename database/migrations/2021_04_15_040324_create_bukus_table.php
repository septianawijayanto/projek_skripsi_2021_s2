<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBukusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 15);
            $table->text('gambar')->nullable();
            $table->foreignId('penerbit_id')->references('id')->on('penerbit')->onDelete('cascade');
            $table->foreignId('klasifikasi_id')->references('id')->on('klasifikasi')->onDelete('cascade');
            $table->string('judul_buku');
            $table->string('penulis', 30);
            $table->enum('kelas', ['Umum', 'VII', 'VIII', 'IX']);
            $table->string('tahun_terbit');
            $table->integer('jumlah');
            $table->integer('jml_dipinjam')->default(0);
            $table->integer('rusak')->default(0)->nullable();
            $table->integer('hilang')->default(0)->nullable();
            $table->string('tahun_pengadaan');
            $table->string('sumber_dana')->nullable();
            $table->integer('status')->default(1)->nullable();
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
        Schema::dropIfExists('buku');
    }
}
