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
        Schema::create('invoice_reinigungs', function (Blueprint $table) {
            $table->id();
            $table->date('reinigungDate');
            $table->string('reinigungType');
            $table->string('extraReinigung')->nullable();
            $table->string('reinigungRoom')->nullable();
            $table->integer('reinigungFixedPrice')->nullable();
            $table->integer('reinigungHours')->nullable();
            $table->integer('reinigungChf')->nullable();
            $table->integer('extra1')->nullable();
            $table->integer('extra2')->nullable();
            $table->integer('extra3')->nullable();
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
            $table->float('reinigungCost');
            $table->float('reinigungPaid1')->nullable();
            $table->float('reinigungPaid2')->nullable();
            $table->float('reinigungPaid3')->nullable();
            $table->float('reinigungTotalPrice');
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
        Schema::dropIfExists('invoice_reinigungs');
    }
};
