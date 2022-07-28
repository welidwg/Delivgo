<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestRestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_restos', function (Blueprint $table) {
            $table->id();
            $table->foreignId("resto_id")->references("user_id")->on("users")->onDelete("cascade");
            $table->foreignId("deliverer_id")->nullable()->references("user_id")->on("users")->onDelete("cascade");
            $table->integer("statut")->nullable();
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
        Schema::dropIfExists('request_restos');
    }
}
