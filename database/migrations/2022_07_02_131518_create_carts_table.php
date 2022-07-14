<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId("resto_id")->references("user_id")->on("users")->onDelete("cascade");
            $table->foreignId("user_id")->references("user_id")->on("users")->onDelete("cascade");
            $table->foreignId("product_id")->references("product_id")->on("products")->onDelete("cascade");
            $table->integer("quantity");
            $table->float("total");

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
        Schema::dropIfExists('carts');
    }
}
