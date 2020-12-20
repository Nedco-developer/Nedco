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
            $table->text('client_id');
            $table->text('status');
            $table->text('SenderNumber');
            $table->text('SenderName');
            $table->text('RecipientNumber');
            $table->text('RecipientName');
            $table->text('city');
            $table->text('locations');
            $table->text('districts');
            $table->text('RecipientAddress');
            $table->double('itemPrice', 8, 2);
            $table->double('deliveryPrice', 8, 2);
            $table->double('totalPrice', 8, 2);
            $table->text('notes');
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
