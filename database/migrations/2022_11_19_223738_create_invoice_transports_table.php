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
        Schema::create('invoice_transports', function (Blueprint $table) {
            $table->id();
            $table->string('pdfText')->nullable();
            $table->date('transportDate')->nullable();
            $table->integer('transportFixedTariff')->nullable();
            $table->integer('transportHours')->nullable();
            $table->integer('transportChf')->nullable();
            $table->integer('transportHours2')->nullable();
            $table->integer('transportChf2')->nullable();
            $table->integer('transportRoadChf')->nullable();
            $table->string('extraText1')->nullable();
            $table->float('extraValue1')->nullable();
            $table->string('extraText2')->nullable();
            $table->float('extraValue2')->nullable();
            $table->string('extraText3')->nullable();
            $table->float('extraValue3')->nullable();
            $table->string('extraText4')->nullable();
            $table->float('extraValue4')->nullable();
            $table->string('extraText5')->nullable();
            $table->float('extraValue5')->nullable();
            $table->string('extraText6')->nullable();
            $table->float('extraValue6')->nullable();
            $table->string('extraText7')->nullable();
            $table->float('extraValue7')->nullable();
            $table->float('discount')->nullable();
            $table->float('discount2')->nullable();
            $table->string('extraDiscountText1')->nullable();
            $table->float('extraDiscountValue1')->nullable();
            $table->string('extraDiscountText2')->nullable();
            $table->float('extraDiscountValue2')->nullable();
            $table->float('transportCost')->nullable();
            $table->float('transportFixedCost')->nullable();
            $table->float('transportPaid1')->nullable();
            $table->float('transportPaid2')->nullable();
            $table->float('transportPaid3')->nullable();
            $table->float('transportTotalPrice')->nullable();
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
        Schema::dropIfExists('invoice_transports');
    }
};
