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
        Schema::create('reinigung_services', function (Blueprint $table) {
            $table->id();
            $table->date('reinigungStartDate')->nullable();
            $table->time('reinigungStartTime')->nullable();
            $table->date('reinigungEndDate')->nullable();
            $table->time('reinigungEndTime')->nullable();
            $table->string('calendarTitle')->nullable();
            $table->longText('calendarComment')->nullable();
            $table->string('calendarLocation')->nullable();
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
        Schema::dropIfExists('reinigung_services');
    }
};
