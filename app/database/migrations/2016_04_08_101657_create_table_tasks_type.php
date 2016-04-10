<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTasksType extends Migration {

    /**
     * @var string
     */
    protected $tableName = "task_type";

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
            $table->integer('parent_id');
            $table->string('title',255);
            $table->text('description');
            $table->integer('account_create_id');
            $table->integer('account_updated_id');
            $table->integer('order');
            $table->boolean('active')->default('0');
            $table->timestamps();
        });
        $this->type_tasks();
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

    protected function type_tasks(){
        DB::table($this->tableName)->insert(array(
            array(
                'parent_id'             =>  '0',
                'title'                 =>  'work hours',
                'account_create_id'     =>  '1',
                'account_updated_id'    =>  '1',
                'active'                =>  true,
                'order'                 =>  '1',
                'created_at'            =>  date('Y-m-d H:m:s'),
                'updated_at'            =>  date('Y-m-d H:m:s')
            ),
            array(
                'parent_id'             =>  '0',
                'title'                 =>  'holidays',
                'account_create_id'     =>  '1',
                'account_updated_id'    =>  '1',
                'active'                =>  true,
                'order'                 =>  '2',
                'created_at'            =>  date('Y-m-d H:m:s'),
                'updated_at'            =>  date('Y-m-d H:m:s')
            )
        ));
    }
}
