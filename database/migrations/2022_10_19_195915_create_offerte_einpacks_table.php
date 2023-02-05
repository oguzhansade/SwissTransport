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
        Schema::create('offerte_einpacks', function (Blueprint $table) {
            $table->id();
            $table->string('tariff');
            $table->integer('ma');
            $table->integer('chf');
            $table->date('einpackDate')->nullable();
            $table->time('einpackTime')->nullable();
            $table->integer('arrivalReturn')->nullable(); // Benzin gideri
            $table->string('moveHours'); //İkili Olucak Front end kısmını araştır.
            $table->integer('extra')->nullable();
            $table->integer('extra1')->nullable();
            $table->string('customCostName1')->nullable();
            $table->integer('customCostPrice1')->nullable();
            $table->string('customCostName2')->nullable();
            $table->integer('customCostPrice2')->nullable();
            $table->string('costPrice')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('discountPercent')->nullable();
            $table->integer('compromiser')->nullable();
            $table->string('extraCostName')->nullable();
            $table->integer('extraCostPrice')->nullable();
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
        Schema::dropIfExists('offerte_einpacks');
    }
};
