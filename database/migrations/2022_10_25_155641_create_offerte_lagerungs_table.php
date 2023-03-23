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
        Schema::create('offerte_lagerungs', function (Blueprint $table) {
            $table->id();
            $table->integer('tariff');
            $table->integer('chf');
            $table->string('volume')->nullable();
            $table->string('extraCostText1')->nullable();
            $table->integer('extraCostValue1')->nullable();
            $table->string('extraCostText2')->nullable();
            $table->integer('extraCostValue2')->nullable();
            $table->integer('discountPercent')->nullable();
            $table->string('discountText')->nullable();
            $table->integer('discountValue')->nullable();
            $table->string('costPrice')->nullable();
            $table->string('totalPrice')->nullable();
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
        Schema::dropIfExists('offerte_lagerungs');
    }
};
