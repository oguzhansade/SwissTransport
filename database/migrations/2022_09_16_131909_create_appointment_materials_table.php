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
        Schema::create('appointment_materials', function (Blueprint $table) {
            $table->id();
            $table->integer('appType')->default(3);
            $table->integer('deliverable'); //0 sa Ambalaj Malzemesi 1 se Kale Stüdyosu
            $table->integer('deliveryType')->nullable();//0 sa teslimat 1 se almak
            $table->date('meetingDate')->nullable();
            $table->time('meetingHour1')->nullable();
            $table->time('meetingHour2')->nullable();
            $table->string('address')->nullable();
            $table->string('calendarTitle')->nullable();
            $table->string('calendarContent')->nullable();
            $table->integer('customerId');
            $table->boolean('expired')->default(0);// 0 ise Sorun Yok 1 ise Abholung Yapılmamış ve Gerekli 
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
        Schema::dropIfExists('appointment_materials');
    }
};
