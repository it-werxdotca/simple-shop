<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name",200);
            $table->enum("status",["In stock","Preorder","Order"]);
            $table->string("slug",300)->unique();
            $table->boolean("discount");
            $table->float("price",7,2);
            $table->float("discountPrice",7,2);
            $table->string("image",400);
            $table->boolean("freeShipping");
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
        Schema::dropIfExists('products');
    }
}
