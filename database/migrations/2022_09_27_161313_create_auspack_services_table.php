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
        Schema::create('auspack_services', function (Blueprint $table) {
            $table->id();
            $table->date('auspackDate')->nullable();
            $table->time('auspackTime')->nullable();
            $table->string('workHours')->nullable();
            $table->integer('ma')->nullable(); // Kamyon Sayısı
            $table->integer('lkw')->nullable(); // İşçi Sayısı
            $table->integer('anhanger')->nullable(); // Römork Sayısı
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
        Schema::dropIfExists('auspack_services');
    }
};
