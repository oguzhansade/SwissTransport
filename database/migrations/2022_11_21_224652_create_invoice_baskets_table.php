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
        Schema::create('invoice_baskets', function (Blueprint $table) {
            $table->id();
            $table->integer('productId');
            $table->integer('buyType');
            $table->float('productPrice')->default(0);
            $table->integer('quantity');
            $table->float('totalPrice');
            $table->integer('materialId');
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
        Schema::dropIfExists('invoice_baskets');
    }
};
