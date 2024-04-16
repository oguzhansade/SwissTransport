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
        Schema::create('lagerung_services', function (Blueprint $table) {
            $table->id();
            $table->date('lagerungDate')->nullable();
            $table->time('lagerungTime')->nullable();
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
        Schema::dropIfExists('lagerung_services');
    }
};
