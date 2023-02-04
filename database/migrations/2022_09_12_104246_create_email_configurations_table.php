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
        Schema::create('email_configurations', function (Blueprint $table) {
            $table->id();
            $table->integer('companyId');
            $table->string('host');
            $table->integer('port');
            $table->boolean('ssl')->default(0);
            $table->string('username');
            $table->string('password');
            $table->string('display_name');
            $table->string('reply_address');
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
        Schema::dropIfExists('email_configurations');
    }
};
