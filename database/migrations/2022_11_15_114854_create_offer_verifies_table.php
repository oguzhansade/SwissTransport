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
        Schema::create('offer_verifies', function (Blueprint $table) {
            $table->id();
            $table->integer('offerId');
            $table->string('oToken');
            $table->timestamps();
        });

        Schema::table('offertes', function (Blueprint $table){
            $table->boolean('isOfferVerified')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offer_verifies');
    }
};
