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
        Schema::create('receipt_umzugs', function (Blueprint $table) {
            $table->id();
            $table->integer('customerId');
            $table->integer('offerId');
            $table->integer('receiptType')->default(0);
            $table->string('payType')->nullable();
            $table->string('status')->nullable();
            $table->string('customerGender')->nullable();
            $table->string('customerName')->nullable();
            $table->string('customerStreet')->nullable();
            $table->string('customerAddress')->nullable();
            $table->string('customerPhone')->nullable();
            $table->string('customerMail')->nullable();
            $table->integer('auszugId1')->nullable();
            $table->integer('auszugId2')->nullable();
            $table->integer('auszugId3')->nullable();
            $table->integer('einzugId1')->nullable();
            $table->integer('einzugId2')->nullable();
            $table->integer('einzugId3')->nullable();
            $table->integer('receiptExtraId')->nullable();
            $table->integer('receiptDiscountId')->nullable();
            $table->date('orderDate')->nullable();
            $table->time('orderTime')->nullable();
            $table->integer('umzugHour')->nullable();
            $table->integer('umzugChf')->nullable();
            $table->integer('umzugTotalChf')->nullable();
            $table->integer('umzugCharge')->nullable();
            $table->integer('umzugArrivalGas')->nullable();
            $table->integer('umzugReturnGas')->nullable();
            $table->float('materialPrice')->nullable();
            $table->integer('entsorgungVolume')->nullable();
            $table->integer('entsorgungChf')->nullable();
            $table->float('entsorgungTotalChf')->nullable();
            $table->float('entsorgungFixedChf')->nullable();
            $table->float('fixedPrice')->nullable();
            $table->float('topPrice')->nullable();
            $table->float('totalPrice')->nullable();
            $table->integer('withTax')->nullable();
            $table->integer('withoutTax')->nullable();
            $table->integer('freeTax')->nullable();
            $table->integer('inBar')->nullable();
            $table->integer('inRechnung')->nullable();
            $table->integer('inTwint')->nullable();
            $table->float('cashPrice')->nullable();
            $table->float('invoicePrice')->nullable();
            $table->float('twintPrice')->nullable();
            $table->float('expensePrice')->nullable();
            $table->string('signerName')->nullable();
            $table->longText('signature')->nullable();
            $table->integer('docTaken')->default(0);
            $table->integer('bexioId')->nullable();
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
        Schema::dropIfExists('receipt_umzugs');
    }
};
