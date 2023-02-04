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
        Schema::create('offerte_umzugs', function (Blueprint $table) {
            $table->id();
            $table->string('tariff');
            $table->integer('ma');
            $table->integer('lkw');
            $table->integer('anhanger');
            $table->integer('chf');
            $table->date('moveDate');
            $table->time('moveTime');
            $table->date('moveDate2');
            $table->integer('arrivalReturn')->nullable(); // Benzin gideri
            $table->integer('montage')->nullable();
            $table->string('moveHours'); //İkili Olucak Front end kısmını araştır.
            $table->integer('extra')->nullable();
            $table->integer('extra1')->nullable();
            $table->integer('extra2')->nullable();
            $table->integer('extra3')->nullable();
            $table->integer('extra4')->nullable();
            $table->integer('extra5')->nullable();
            $table->integer('extra6')->nullable();
            $table->integer('extra7')->nullable();
            $table->integer('extra8')->nullable();
            $table->integer('extra9')->nullable();
            $table->integer('extra10')->nullable();
            $table->string('customCostName1')->nullable();
            $table->integer('customCostPrice1')->nullable();
            $table->string('customCostName2')->nullable();
            $table->integer('customCostPrice2')->nullable();
            $table->string('costPrice');
            $table->integer('discount')->nullable();
            $table->integer('discountPercent')->nullable();
            $table->integer('compromiser')->nullable();
            $table->string('extraCostName')->nullable();
            $table->integer('extraCostPrice')->nullable();
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
        Schema::dropIfExists('offerte_umzugs');
    }
};
