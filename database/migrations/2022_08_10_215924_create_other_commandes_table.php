<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_commandes', function (Blueprint $table) {
            $table->id();
            $table->text("message");
            $table->string("picture")->nullable();
            $table->foreignId("user_id")->references("user_id")->on("users")->onDelete("cascade");
            $table->foreignId("deliverer_id")->nullable()->references("user_id")->on("users")->onDelete("cascade");
            $table->boolean("taken")->default(0);
            $table->float("frais");
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
        Schema::dropIfExists('other_commandes');
    }
}
