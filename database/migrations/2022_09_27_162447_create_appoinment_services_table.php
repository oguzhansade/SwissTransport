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
        Schema::create('appoinment_services', function (Blueprint $table) {
            $table->id();
            $table->integer('offerId')->nullable();
            $table->integer('appType')->default(2);
            $table->boolean('paymentType');// 0 ise Bar 1 ise Invoice 
            $table->string('address');
            $table->string('calendarTitle');
            $table->string('calendarContent');
            $table->integer('customerId');
            $table->integer('umzugId')->nullable();
            $table->integer('umzug2Id')->nullable();
            $table->integer('umzug3Id')->nullable();
            $table->integer('einpackId')->nullable();
            $table->integer('auspackId')->nullable();
            $table->integer('reinigungId')->nullable();
            $table->integer('reinigung2Id')->nullable();
            $table->integer('entsorgungId')->nullable();
            $table->integer('transportId')->nullable();
            $table->integer('lagerungId')->nullable();
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
        Schema::dropIfExists('appoinment_services');
    }
};
