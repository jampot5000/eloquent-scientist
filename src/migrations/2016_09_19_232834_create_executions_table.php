<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExecutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('executions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('experiment_id')->unsigned();
            $table->integer('execution_id')->unsigned()->nullable();
            $table->string('name');
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->float('start_memory');
            $table->float('end_memory');
            $table->longText('result');
            $table->boolean('match')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('executions');
    }
}
