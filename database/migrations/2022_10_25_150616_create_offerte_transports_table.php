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
        Schema::create('offerte_transports', function (Blueprint $table) {
            $table->id();
            $table->string('pdfText')->nullable();
            $table->integer('fixedChf')->nullable();
            $table->integer('tariff')->nullable();
            $table->integer('ma')->nullable();
            $table->integer('lkw')->nullable();
            $table->integer('anhanger')->nullable();
            $table->integer('chf')->nullable();
            $table->string('hour')->nullable();
            $table->date('transportDate')->nullable();
            $table->time('transportTime')->nullable();
            $table->integer('arrivalGas')->nullable();
            $table->integer('returnGas')->nullable();
            $table->string('extraCostText1')->nullable();
            $table->integer('extraCostValue1')->nullable();
            $table->string('extraCostText2')->nullable();
            $table->integer('extraCostValue2')->nullable();
            $table->string('extraCostText3')->nullable();
            $table->integer('extraCostValue3')->nullable();
            $table->string('extraCostText4')->nullable();
            $table->integer('extraCostValue4')->nullable();
            $table->string('extraCostText5')->nullable();
            $table->integer('extraCostValue5')->nullable();
            $table->string('extraCostText6')->nullable();
            $table->integer('extraCostValue6')->nullable();
            $table->string('extraCostText7')->nullable();
            $table->integer('extraCostValue7')->nullable();
            $table->string('totalPrice')->nullable();
            $table->integer('discount')->default(0)->nullable();
            $table->integer('discountPercent')->nullable();
            $table->integer('compromiser')->default(0)->nullable();
            $table->string('extraDiscountText')->nullable();
            $table->integer('extraDiscountValue')->default(0)->nullable();;
            $table->string('extraDiscountText2')->nullable();
            $table->integer('extraDiscountValue2')->default(0)->nullable();;
            $table->string('defaultPrice')->nullable();
            $table->integer('topCost')->nullable();
            $table->integer('fixedPrice')->nullable();
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
        Schema::dropIfExists('offerte_transports');
    }
};
