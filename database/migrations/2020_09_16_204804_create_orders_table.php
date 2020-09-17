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
            $table->integer("user_id")->nullable();
            $table->string("billing_name",150);
            $table->string("billing_email",100);
            $table->string("billing_phone",20);
            $table->string("billing_zip",10);
            $table->string("billing_city",50);
            $table->string("billing_address",200);
            $table->string("shipping_name",150)->nullable();
            $table->string("shipping_email",100)->nullable();
            $table->string("shipping_phone",20)->nullable();
            $table->string("shipping_zip",10)->nullable();
            $table->string("shipping_city",50)->nullable();
            $table->string("shipping_address",200)->nullable();
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
