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
            $table->integer('ma')->default(0);
            $table->integer('lkw')->default(0);
            $table->integer('anhanger')->default(0);
            $table->integer('chf')->default(0);
            $table->string('hour');
            $table->date('transportDate');
            $table->time('transportTime');
            $table->integer('arrivalReturn')->nullable();
            $table->string('extraCostText1')->nullable();
            $table->integer('extraCostValue1')->default(0);
            $table->string('extraCostText2')->nullable();
            $table->integer('extraCostValue2')->default(0);
            $table->string('extraCostText3')->nullable();
            $table->integer('extraCostValue3')->default(0);
            $table->string('extraCostText4')->nullable();
            $table->integer('extraCostValue4')->default(0);
            $table->string('extraCostText5')->nullable();
            $table->integer('extraCostValue5')->default(0);
            $table->string('extraCostText6')->nullable();
            $table->integer('extraCostValue6')->default(0);
            $table->string('extraCostText7')->nullable();
            $table->integer('extraCostValue7')->default(0);
            $table->string('totalPrice');
            $table->integer('discount')->default(0)->default(0);
            $table->integer('discountPercent')->nullable();
            $table->integer('compromiser')->default(0)->default(0);
            $table->string('extraDiscountText')->nullable();
            $table->integer('extraDiscountValue')->default(0);
            $table->string('extraDiscountText2')->nullable();
            $table->integer('extraDiscountValue2')->default(0);
            $table->string('defaultPrice');
            $table->integer('topCost');
            $table->integer('fixedPrice');
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
