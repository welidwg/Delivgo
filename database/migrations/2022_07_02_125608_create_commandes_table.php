<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId("product_id")->references("product_id")->on("products")->onDelete("cascade");
            $table->string("garnitures")->nullable();
            $table->string("sauces")->nullable();
            $table->string("supplements")->nullable();
            $table->string("drinks")->nullable();
            $table->integer("quantity");
            $table->float("total");
            $table->integer("statut");
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
        Schema::dropIfExists('commandes');
    }
}
