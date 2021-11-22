<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi', 15);
            $table->foreignId('buku_id')->references('id')->on('buku')->onDelete('cascade');
            $table->foreignId('anggota_id')->references('id')->on('anggota')->onDelete('cascade');
            $table->dateTime('tgl_pinjam');
            $table->dateTime('tgl_kembali');
            $table->string('status', 8);
            $table->string('status_denda', 20);
            $table->integer('denda')->nullable();
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
        Schema::dropIfExists('transaksi');
    }
}
