<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class datacovid extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datacovid', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('kota');
            $table->integer('jumlah');
            $table->timestamps();

            // $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('id_kategori')->references('id_kategori')->on('kategori')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datacovid');
    }
}
