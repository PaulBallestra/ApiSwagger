<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); //ID
            $table->string('name'); //NOM
            $table->string('email')->unique(); //EMAIL
            $table->string('password'); //PASSWORD
            $table->timestamp('created_at')->nullable(); //CREATED_AT
            $table->timestamp('updated_at')->nullable(); //UPDATED_AT
            $table->rememberToken();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
