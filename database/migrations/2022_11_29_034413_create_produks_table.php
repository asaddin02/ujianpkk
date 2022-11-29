<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // membuat table produk yang berelasi dengan category
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('namaproduk');
            $table->string('foto');
            $table->double('harga', 15, 8);
            $table->string('descproduk');
            $table->string('penulis');
            $table->string('tampilkan')->default('aktif');
            $table->foreignId('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
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
        Schema::dropIfExists('produks');
    }
};
