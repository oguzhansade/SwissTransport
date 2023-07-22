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
        Schema::create('customer_forms', function (Blueprint $table) {
            $table->id();
            $table->string('customerName')->nullable();
            $table->string('mail')->nullable();
            $table->string('phone')->nullable();
            $table->string('firma')->nullable();
            $table->string('vonStreet')->nullable();
            $table->string('vonPlz')->nullable();
            $table->string('zimmer')->nullable();
            $table->string('nachStreet')->nullable();
            $table->string('nachPlz')->nullable();
            $table->date('umzugDate')->nullable();
            $table->string('vonEtage')->nullable();
            $table->string('nachEtage')->nullable();
            $table->string('vonLift')->nullable();
            $table->string('nachLift')->nullable();
            $table->string('extraService')->nullable();
            $table->text('bemerkung')->nullable();
            $table->string('type')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('customer_forms');
    }
};
