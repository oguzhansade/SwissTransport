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
        Schema::create('invoice_materials', function (Blueprint $table) {
            $table->id();
            $table->integer('discount')->nullable();
            $table->integer('discountPercent')->nullable();
            $table->string('customDiscountText')->nullable();
            $table->integer('customDiscountValue')->nullable();
            $table->integer('deliverPrice')->nullable();
            $table->integer('recievePrice')->nullable();
            $table->float('totalPrice')->nullable();
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
        Schema::dropIfExists('invoice_materials');
    }
};
