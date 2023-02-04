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
        Schema::create('invoice_auspacks', function (Blueprint $table) {
            $table->id();
            $table->date('auspackDate');
            $table->integer('auspackHour');
            $table->integer('auspackChf');
            $table->integer('auspackHour2')->nullable();
            $table->integer('auspackChf2')->nullable();
            $table->integer('auspackRoadChf')->nullable();
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
            $table->float('auspackCost');
            $table->float('auspackFixedCost')->nullable();
            $table->float('auspackPaid1')->nullable();
            $table->float('auspackPaid2')->nullable();
            $table->float('auspackPaid3')->nullable();
            $table->float('auspackTotalPrice');
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
        Schema::dropIfExists('invoice_auspacks');
    }
};
