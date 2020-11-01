<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('invoice');
            $table->integer('user_id')->nullable();
            $table->double('user_lat')->nullable();
            $table->double('user_lng')->nullable();
            $table->string('user_address_name')->nullable();
            $table->longText('user_address_detail')->nullable();
            $table->string('user_subdistrict')->nullable();
            $table->string('user_postal_code')->nullable();
            $table->longText('user_note')->nullable();
            $table->longText('order_note')->nullable();
            $table->double('order_subtotal');
            $table->integer('order_payment_type')->default(0);
            $table->integer('order_payment_method')->nullable();
            $table->boolean('order_self_pickup')->default(false);
            $table->boolean('order_scheduled')->nullable();
            $table->string('order_scheduled_date')->nullable();
            $table->double('order_delivery_fee')->default(0);
            $table->string('order_created')->nullable();
            $table->string('order_accepted')->nullable();
            $table->string('order_processed')->nullable();
            $table->string('order_waiting')->nullable();
            $table->string('order_delivered')->nullable();
            $table->string('order_completed')->nullable();
            $table->integer('order_status')->default(0)->comment("0 = placed, 1 = accepted, 2 = processed, 3 = waiting, 4 = delivered, 5 = completed, 6 = canceled");
            $table->softDeletes();
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
        Schema::dropIfExists('transactions');
    }
}
