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
        Schema::create('offertes', function (Blueprint $table) {
            $table->id();
            $table->string('mainOfferteId')->nullable();
            $table->integer('customerId');
            $table->string('appType');
            $table->integer('auszugaddressId');
            $table->integer('auszugaddressId2')->nullable();
            $table->integer('auszugaddressId3')->nullable();
            $table->integer('einzugaddressId')->nullable();
            $table->integer('einzugaddressId2')->nullable();
            $table->integer('einzugaddressId3')->nullable();
            $table->integer('offerteUmzugId')->nullable();
            $table->integer('offerteEinpackId')->nullable();
            $table->integer('offerteAuspackId')->nullable();
            $table->integer('offerteReinigungId')->nullable();
            $table->integer('offerteReinigung2Id')->nullable();
            $table->integer('offerteEntsorgungId')->nullable();
            $table->integer('offerteTransportId')->nullable();
            $table->integer('offerteLagerungId')->nullable();
            $table->integer('offerteMaterialId')->nullable();
            $table->float('offerPrice', 8, 2)->nullable();
            $table->text('offerteNote')->nullable();
            $table->text('panelNote')->nullable();
            $table->integer('kostenInkl')->nullable();
            $table->integer('kostenExkl')->nullable();
            $table->integer('kostenFrei')->nullable();
            $table->string('contactPerson')->nullable();
            $table->string('offerteStatus')->nullable();
            $table->string('isCampaign')->nullable();
            $table->tinyInteger('isOfferVerified')->default(0);
            $table->integer('emailSent')->default(0);
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
        Schema::dropIfExists('offertes');
    }
};
