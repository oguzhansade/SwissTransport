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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('street');
            $table->integer('post_code');
            $table->string('city');
            $table->string('phone');
            $table->string('mobile');
            $table->string('contact_person');
            $table->string('email');
            $table->string('google-email')->nullable();
            $table->string('website');
            $table->string('crmPrimaryColor')->default('#2A6698');
            $table->string('crmSecondaryColor')->default('#C8DFF3');
            $table->string('pdfPrimaryColor')->default('#D10D0C');
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
        Schema::dropIfExists('companies');
    }
};
