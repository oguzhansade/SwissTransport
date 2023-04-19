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
        Schema::create('invoice_lagerungs', function (Blueprint $table) {
            $table->id();
            $table->date('lagerungStartDate')->nullable();
            $table->date('lagerungEndDate')->nullable();
            $table->integer('lagerungVolume')->nullable();
            $table->integer('lagerungChf')->nullable();
            $table->string('extraText1')->nullable();
            $table->float('extraValue1')->nullable();
            $table->string('extraText2')->nullable();
            $table->float('extraValue2')->nullable();
            $table->float('discount')->nullable();
            $table->float('discount2')->nullable();
            $table->integer('discountPercent')->nullable();
            $table->string('extraDiscountText1')->nullable();
            $table->float('extraDiscountValue1')->nullable();
            $table->string('extraDiscountText2')->nullable();
            $table->float('extraDiscountValue2')->nullable();
            $table->float('lagerungCost')->nullable();
            $table->float('lagerungFixedCost')->nullable();
            $table->float('lagerungPaid1')->nullable();
            $table->float('lagerungPaid2')->nullable();
            $table->float('lagerungTotalPrice')->nullable();
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
        Schema::dropIfExists('invoice_lagerungs');
    }
};
