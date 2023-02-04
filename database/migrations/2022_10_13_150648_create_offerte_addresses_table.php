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
        Schema::create('offerte_addresses', function (Blueprint $table) {
            $table->id();
            $table->integer('addressType');
            $table->string('street')->nullable();
            $table->string('postCode')->nullable();;
            $table->string('city')->nullable();;
            $table->string('country')->nullable();;
            $table->string('buildType')->nullable();
            $table->string('floor')->nullable();
            $table->string('lift')->nullable(); // 0 sa yok 1 se var
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
        Schema::dropIfExists('offerte_addresses');
    }
};
