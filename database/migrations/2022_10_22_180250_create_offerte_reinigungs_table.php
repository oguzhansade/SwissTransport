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
        Schema::create('offerte_reinigungs', function (Blueprint $table) {
            $table->id();
            $table->string('reinigungType');
            $table->string('extraReinigung')->nullable();
            $table->string('fixedTariff')->nullable();
            $table->integer('fixedTariffPrice')->nullable();
            $table->string('standartTariff')->nullable();
            $table->integer('ma')->nullable();
            $table->integer('chf')->nullable();
            $table->string('hours')->nullable();
            $table->integer('extraService1')->nullable();
            $table->integer('extraService2')->nullable();
            $table->date('startDate')->nullable();
            $table->time('startTime')->nullable();
            $table->date('endDate')->nullable();
            $table->time('endTime')->nullable();
            $table->integer('extra1')->nullable();
            $table->integer('extra2')->nullable();
            $table->integer('extra3')->nullable();
            $table->string('extraCostText1')->nullable();
            $table->integer('extraCostValue1')->nullable();
            $table->string('extraCostText2')->nullable();
            $table->integer('extraCostValue2')->nullable();
            $table->string('discountText')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('discountPercent')->nullable();
            $table->string('totalPrice')->nullable();
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
        Schema::dropIfExists('offerte_reinigungs');
    }
};
