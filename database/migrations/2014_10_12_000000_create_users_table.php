<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id("user_id");
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string("avatar", 500)->nullable();
            $table->integer("type")->default(1);
            $table->string("state")->nullable();
            $table->string("address", 500)->nullable();
            $table->integer("phone")->unique();
            $table->integer("phone2")->unique();
            $table->integer("statut")->default(1);
            $table->integer("onDuty")->nullable()->default(0);
            $table->integer("deliveryPrice")->nullable();
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
        Schema::dropIfExists('users');
    }
}
