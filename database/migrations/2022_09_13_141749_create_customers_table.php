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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->integer('customerType')->default(0);
            $table->string('gender')->nullable();
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('companyName')->nullable();
            $table->string('contactPerson')->nullable();
            $table->string('street');
            $table->string('postCode');
            $table->string('Ort');
            $table->string('country');
            $table->string('source1')->nullable();
            $table->string('source2')->nullable();
            $table->string('email');
            $table->string('phone');
            $table->string('mobile');
            $table->longText('note')->nullable();
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
        Schema::dropIfExists('customers');
    }
};
