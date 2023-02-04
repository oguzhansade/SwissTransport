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
        Schema::create('invoice_einpacks', function (Blueprint $table) {
            $table->id();
            $table->date('einpackDate');
            $table->integer('einpackHour');
            $table->integer('einpackChf');
            $table->integer('einpackHour2')->nullable();
            $table->integer('einpackChf2')->nullable();
            $table->integer('einpackRoadChf')->nullable();
            $table->integer('extra1')->nullable();
            $table->integer('extra2')->nullable();
            $table->string('extraText1')->nullable();
            $table->float('extraValue1')->nullable();
            $table->string('extraText2')->nullable();
            $table->float('extraValue2')->nullable();
            $table->float('discount')->nullable();
            $table->float('discount2')->nullable();
            $table->string('extraDiscountText1')->nullable();
            $table->float('extraDiscountValue1')->nullable();
            $table->string('extraDiscountText2')->nullable();
            $table->float('extraDiscountValue2')->nullable();
            $table->float('einpackCost');
            $table->float('einpackFixedCost')->nullable();
            $table->float('einpackPaid1')->nullable();
            $table->float('einpackPaid2')->nullable();
            $table->float('einpackPaid3')->nullable();
            $table->float('einpackTotalPrice');
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
        Schema::dropIfExists('invoice_einpacks');
    }
};
