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
        Schema::create('worker_baskets', function (Blueprint $table) {
            $table->id();
            $table->integer('offerteId');
            $table->integer('taskId');
            $table->integer('workerId');
            $table->integer('userId');
            $table->string('workerName')->nullable();
            $table->integer('workerPrice');
            $table->integer('workHour');
            $table->integer('workerHour')->nullable();
            $table->date('taskDate');
            $table->time('taskTime');
            $table->integer('totalPrice');
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
        Schema::dropIfExists('worker_baskets');
    }
};
