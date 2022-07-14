<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->references("user_id")->on("users")->onDelete("cascade");
            $table->foreignId("deliverer_id")->references("user_id")->on("users")->onDelete("cascade");
            $table->foreignId("commande_id")->references("id")->on("commandes")->onDelete("cascade");
            $table->string("fromLocation");
            $table->string("toLocation");
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
        Schema::dropIfExists('deliveries');
    }
}
