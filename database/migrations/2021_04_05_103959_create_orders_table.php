<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable();
            $table->unsignedBigInteger('action_user')->nullable();
            $table->foreign('action_user')
                ->references('id')->on('users')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->text('shipping_details')->nullable();
            $table->text('cart_details')->nullable();
            $table->string('payment_method');
            $table->double('total')->default(0.00);
            $table->string('transaction_id')->nullable();
            $table->enum('status', ['pending', 'approved', 'delivered', 'canceled'])->default('pending');
            $table->enum('tran_status', ['pending', 'processing', 'failed', 'canceled'])->default('pending');
            $table->string('currency', 20)->default('BDT');
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
        Schema::dropIfExists('orders');
    }
}
