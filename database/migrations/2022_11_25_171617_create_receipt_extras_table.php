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
        Schema::create('receipt_extras', function (Blueprint $table) {
            $table->id();
            $table->string('extra1Text')->nullable();
            $table->integer('extra1')->nullable();
            $table->string('extra2Text')->nullable();
            $table->integer('extra2')->nullable();
            $table->string('extra3Text')->nullable();
            $table->integer('extra3')->nullable();
            $table->string('extra4Text')->nullable();
            $table->integer('extra4')->nullable();
            $table->string('extra5Text')->nullable();
            $table->integer('extra5')->nullable();
            $table->string('extra6Text')->nullable();
            $table->integer('extra6')->nullable();
            $table->string('extra7Text')->nullable();
            $table->integer('extra7')->nullable();
            $table->string('extra8Text')->nullable();
            $table->integer('extra8')->nullable();
            $table->string('extra9Text')->nullable();
            $table->integer('extra9')->nullable();
            $table->string('extra10Text')->nullable();
            $table->integer('extra10')->nullable();
            $table->string('extra11Text')->nullable();
            $table->integer('extra11')->nullable();
            $table->string('extra12Text')->nullable();
            $table->integer('extra12')->nullable();
            $table->string('extra13Text')->nullable();
            $table->integer('extra13')->nullable();
            $table->string('extra14Text')->nullable();
            $table->integer('extra14')->nullable();
            $table->string('extra15Text')->nullable();
            $table->integer('extra15')->nullable();
            $table->string('extra16Text')->nullable();
            $table->integer('extra16')->nullable();
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
        Schema::dropIfExists('receipt_extras');
    }
};
