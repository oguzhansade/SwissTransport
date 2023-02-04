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
        Schema::create('receipt_discounts', function (Blueprint $table) {
            $table->id();
            $table->string('discount1Text')->nullable();
            $table->integer('discount1')->nullable();
            $table->string('discount2Text')->nullable();
            $table->integer('discount2')->nullable();
            $table->string('discount3Text')->nullable();
            $table->integer('discount3')->nullable();
            $table->string('discount4Text')->nullable();
            $table->integer('discount4')->nullable();
            $table->string('discount5Text')->nullable();
            $table->integer('discount5')->nullable();
            $table->string('discount6Text')->nullable();
            $table->integer('discount6')->nullable();
            $table->string('discount7Text')->nullable();
            $table->integer('discount7')->nullable();
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
        Schema::dropIfExists('receipt_discounts');
    }
};
