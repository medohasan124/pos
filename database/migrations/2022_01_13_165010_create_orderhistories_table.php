<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderhistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderhistories', function (Blueprint $table) {
           $table->id();
            $table->integer('user_id');
            $table->integer('client_id');
            $table->integer('item_id');
            $table->integer('order_id');
            $table->integer('item_count');
            $table->integer('price');
            $table->integer('active');
            $table->timestamps();

    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
    $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orderhistories');
    }
}
