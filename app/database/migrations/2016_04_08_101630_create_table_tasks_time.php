<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTasksTime extends Migration {

    /**
     * @var string
     */
    protected $tableName = "tasks_time";

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create($this->tableName, function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('account_id');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->string('title',255);
            $table->text('description');
            $table->integer('account_create_id');
            $table->integer('account_updated_id');
            $table->integer('tasks_type_id');
            $table->boolean('active')->default('0');
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
        Schema::drop($this->tableName);
	}

}
