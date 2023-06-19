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
        Schema::create('receipt_reinigungs', function (Blueprint $table) {
            $table->id();
            $table->integer('customerId');
            $table->integer('offerId');
            $table->integer('receiptType')->default(1);
            $table->string('payType')->nullable();
            $table->string('status')->nullable();
            $table->string('customerGender')->nullable();
            $table->string('customerName')->nullable();
            $table->string('customerStreet')->nullable();
            $table->string('customerAddress')->nullable();
            $table->string('customerPhone')->nullable();
            $table->string('reinigungStreet')->nullable();
            $table->string('reinigungAddress')->nullable();
            $table->date('reinigungDate')->nullable();
            $table->time('reinigungTime')->nullable();
            $table->date('endDate')->nullable();
            $table->time('endTime')->nullable();
            $table->string('reinigungType')->nullable();
            $table->string('reinigungExtraText')->nullable();
            $table->string('extraReinigung')->nullable();
            $table->float('fixedPrice')->nullable();
            $table->integer('reinigungHours')->nullable();
            $table->integer('reinigungChf')->nullable();
            $table->float('reinigungPrice')->nullable();
            $table->integer('receiptExtraId')->nullable();
            $table->integer('receiptDiscountId')->nullable();
            $table->float('totalPrice')->nullable();
            $table->integer('withTax')->nullable();
            $table->integer('withoutTax')->nullable();
            $table->integer('freeTax')->nullable();
            $table->integer('inBar')->nullable();
            $table->integer('inRechnung')->nullable();
            $table->float('cashPrice')->nullable();
            $table->float('invoicePrice')->nullable();
            $table->float('expensePrice')->nullable();
            $table->string('signerName')->nullable();
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
        Schema::dropIfExists('receipt_reinigungs');
    }
};
