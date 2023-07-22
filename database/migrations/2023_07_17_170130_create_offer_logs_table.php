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
        Schema::create('offer_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('offerId')->nullable();
            $table->string('serviceType')->nullable();
            $table->string('inputName')->nullable();
            $table->string('oldValue')->nullable();
            $table->string('newValue')->nullable();
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
        Schema::dropIfExists('offer_logs');
    }
};
