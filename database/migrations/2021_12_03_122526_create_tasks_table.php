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
            $table->integer('user_id')->nullable();
            $table->string('body')->nullable(); //BODY
            $table->timestamp('created_at')->nullable(); //CREATED_AT
            $table->timestamp('updated_at')->nullable(); //UPDATED_AT
            $table->boolean('completed')->nullable(); //COMPLETED
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
