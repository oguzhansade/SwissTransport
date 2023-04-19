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
        Schema::create('invoice_entsorgungs', function (Blueprint $table) {
            $table->id();
            $table->date('entsorgungDate')->nullable();
            $table->integer('entsorgungVolume')->nullable();
            $table->integer('entsorgungFixedChf')->nullable();
            $table->integer('entsorgungFixedChfCost')->nullable();
            $table->integer('entsorgungHours')->nullable();
            $table->integer('entsorgungChf')->nullable();
            $table->integer('entsorgungRoadChf')->nullable();
            $table->integer('extra1')->nullable();
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
            $table->float('entsorgungCost')->nullable();
            $table->float('entsorgungFixedCost')->nullable();
            $table->float('entsorgungPaid1')->nullable();
            $table->float('entsorgungPaid2')->nullable();
            $table->float('entsorgungTotalPrice')->nullable();
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
        Schema::dropIfExists('invoice_entsorgungs');
    }
};
