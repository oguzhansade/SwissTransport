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
        Schema::create('offerte_entsorgungs', function (Blueprint $table) {
            $table->id();
            $table->integer('volume');
            $table->integer('volumeCHF');
            $table->integer('fixedCost')->nullable();
            $table->integer('m3');
            $table->integer('tariff')->nullable();
            $table->integer('ma');
            $table->integer('lkw');
            $table->integer('anhanger');
            $table->integer('chf');
            $table->integer('hour')->nullable();
            $table->date('entsorgungDate');
            $table->time('entsorgungTime');
            $table->integer('arrivalReturn');
            $table->integer('entsorgungExtra1')->nullable();
            $table->string('extraCostText1')->nullable();
            $table->integer('extraCostValue1')->nullable();
            $table->string('extraCostText2')->nullable();
            $table->integer('extraCostValue2')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('discountPercent')->nullable();
            $table->string('extraDiscountText')->nullable();
            $table->integer('extraDiscountPrice')->nullable();
            $table->integer('defaultPrice');
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
        Schema::dropIfExists('offerte_entsorgungs');
    }
};
