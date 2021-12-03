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
            $table->rememberToken();
            $table->timestamps('created_at'); //CREATED_AT
            $table->timestamps('updated_at'); //UPDATED_AT
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
