<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestoConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resto_configs', function (Blueprint $table) {
            $table->id();
            $table->foreignId("resto_id")->references("user_id")->on("users")->onDelete("cascade");
            $table->integer("perSupp");
            $table->integer("perTopp");
            $table->integer("perSauce");
            $table->integer("perDrink");
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
        Schema::dropIfExists('resto_configs');
    }
}
