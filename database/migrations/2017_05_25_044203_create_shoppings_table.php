<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShoppingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shoppings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('payment_id');
            $table->integer('product_id');
            $table->integer('user_id');
            $table->string('title', 100);
            $table->integer('quantity');
            $table->enum('deliver', array('pending','processed','delivered','canceled','returned'));
            $table->enum('payment', array('pending','processed','payed','canceled','returned'));
            $table->decimal('amount', 5, 2);
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
        Schema::dropIfExists('shoppings');
    }
}
