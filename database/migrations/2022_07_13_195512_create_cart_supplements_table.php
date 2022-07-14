<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartSupplementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_supplements', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->references("user_id")->on("users")->onDelete("cascade");
            $table->foreignId("resto_id")->references("user_id")->on("users")->onDelete("cascade");
            $table->foreignId("product_id")->references("product_id")->on("products")->onDelete("cascade");
            $table->foreignId("supp_id")->references("id")->on("supplements")->onDelete("cascade");
            $table->string("reference");
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
        Schema::dropIfExists('cart_supplements');
    }
}
