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
        Schema::create('offerte_baskets', function (Blueprint $table) {
            $table->id();
            $table->integer('productId');
            $table->integer('buyType')->nullable();
            $table->float('productPrice')->default(0);
            $table->integer('quantity')->nullable();
            $table->float('totalPrice')->nullable();
            $table->integer('materialId')->nullable();
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
        Schema::dropIfExists('offerte_baskets');
    }
};
