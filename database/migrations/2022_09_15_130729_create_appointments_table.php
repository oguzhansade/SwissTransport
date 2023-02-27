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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->integer('appType')->default(1);
            $table->integer('contactType')->nullable();
            $table->string('address')->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->string('calendarTitle')->nullable();
            $table->longText('calendarContent')->nullable();
            $table->integer('customerId')->nullable();
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
        Schema::dropIfExists('appointments');
    }
};
