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
            $table->id("product_id");
            $table->string("label");
            $table->foreignId("resto_id")->references("user_id")->on("users")->onDelete("cascade");
            $table->text("description")->nullable();
            $table->float("price");
            $table->string("picture");
            $table->boolean("have_supplement");
            $table->boolean("have_toppings");
            $table->boolean("have_sauces");
            $table->boolean("have_drinks");
            $table->integer("statut")->default(1);
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
