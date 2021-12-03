<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{

    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id(); //ID
            $table->string('body'); //BODY
            $table->timestamps('created_at'); //CREATED_AT
            $table->timestamps('updated_at'); //UPDATED_AT
            $table->boolean('completed'); //COMPLETED
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
