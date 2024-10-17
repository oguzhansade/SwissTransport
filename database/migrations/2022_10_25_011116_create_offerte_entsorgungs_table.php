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
            $table->integer('volume')->nullable();
            $table->integer('volumeCHF')->nullable();
            $table->integer('fixedCost')->nullable();
            $table->string('m3')->nullable();
            $table->integer('tariff')->nullable();
            $table->integer('ma')->nullable();
            $table->integer('lkw')->nullable();
            $table->integer('anhanger')->nullable();
            $table->integer('chf')->nullable();
            $table->integer('hour')->nullable();
            $table->date('entsorgungDate')->nullable();
            $table->time('entsorgungTime')->nullable();
            $table->integer('arrivalReturn')->nullable();
            $table->integer('entsorgungExtra1')->nullable();
            $table->string('extraCostText1')->nullable();
            $table->integer('extraCostValue1')->nullable();
            $table->string('extraCostText2')->nullable();
            $table->integer('extraCostValue2')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('discountPercent')->nullable();
            $table->string('extraDiscountText')->nullable();
            $table->integer('extraDiscountPrice')->nullable();
            $table->string('costPrice')->nullable();
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
        Schema::dropIfExists('offerte_entsorgungs');
    }
};
