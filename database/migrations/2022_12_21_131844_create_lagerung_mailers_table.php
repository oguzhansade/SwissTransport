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
        Schema::create('lagerung_mailers', function (Blueprint $table) {
            $table->id();
            $table->integer('customerId')->nullable();
            $table->integer('invoiceId')->nullable();
            $table->integer('lagerungId')->nullable();
            $table->date('startDate')->nullable();
            $table->time('startTime')->nullable();
            $table->date('endDate')->nullable();
            $table->time('endTime')->nullable();
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
        Schema::dropIfExists('lagerung_mailers');
    }
};
