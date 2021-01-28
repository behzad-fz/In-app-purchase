<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('uid');
            $table->string('appid');
            $table->string('product_id');
            $table->string('client_token_id');
            $table->string('os');
            $table->string('receipt');
            $table->dateTime('purchase_date');
            $table->dateTime('expiry_date');
            $table->tinyInteger('status')->default(1)->comment('0.canceled  1.active');
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
        Schema::dropIfExists('subscriptions');
    }
}
