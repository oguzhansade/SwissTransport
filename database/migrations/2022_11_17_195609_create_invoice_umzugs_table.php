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
        Schema::create('invoice_umzugs', function (Blueprint $table) {
            $table->id();
            $table->date('umzugDate');
            $table->integer('umzugHour');
            $table->integer('umzugChf');
            $table->integer('umzugHour2')->nullable();
            $table->integer('umzugChf2')->nullable();
            $table->integer('umzugRoadChf')->nullable();
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
            $table->integer('extra11')->nullable();
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
            $table->float('umzugCost');
            $table->float('umzugFixedCost')->nullable();
            $table->float('umzugPaid1')->nullable();
            $table->float('umzugPaid2')->nullable();
            $table->float('umzugPaid3')->nullable();
            $table->float('umzugTotalPrice');
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
        Schema::dropIfExists('invoice_umzugs');
    }
};
