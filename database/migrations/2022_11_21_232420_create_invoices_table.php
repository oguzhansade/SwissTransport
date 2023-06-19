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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('customerId');
            $table->integer('payCondition')->nullable();
            $table->string('street')->nullable();
            $table->string('ort')->nullable();
            $table->string('plz')->nullable();
            $table->string('land')->nullable();
            $table->dateTime('expiryDate')->nullable();
            $table->integer('umzugId')->nullable();
            $table->integer('einpackId')->nullable();
            $table->integer('auspackId')->nullable();
            $table->integer('reinigungId')->nullable();
            $table->integer('reinigung2Id')->nullable();
            $table->integer('entsorgungId')->nullable();
            $table->integer('transportId')->nullable();
            $table->integer('lagerungId')->nullable();
            $table->integer('materialId')->nullable();
            $table->integer('warningPrice')->nullable();
            $table->float('totalPrice')->nullable();
            $table->integer('withTax')->nullable();
            $table->integer('withoutTax')->nullable();
            $table->integer('freeTax')->nullable();
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
        Schema::dropIfExists('invoices');
    }
};
