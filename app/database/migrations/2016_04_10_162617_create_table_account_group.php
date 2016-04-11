<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAccountGroup extends Migration {

    /**
     * @var string
     */
    protected $tableName = "account_group";

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
            $table->string('title',255)->unique();
            $table->boolean('active')->default('0');
            $table->timestamps();
        });
        $this->createListGroup();
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

    /**
     * create rows
     */
    protected function createListGroup(){
        $created_at = date("Y-m-d H:i:s");
        DB::table($this->tableName)->insert(
            array(
                array(
                    'id'            =>  1,
                    'parent_id'     =>  0,
                    'title'         =>  'superAdmin',
                    'active'        =>  true,
                    'created_at'    =>  $created_at
                ),
                array(
                    'id'            =>  2,
                    'parent_id'     =>  1,
                    'title'         =>  'Admin',
                    'active'        =>  true,
                    'created_at'    =>  $created_at
                ),
                array(
                    'id'            =>  3,
                    'parent_id'     =>  2,
                    'title'         =>  'Director',
                    'active'        =>  true,
                    'created_at'    =>  $created_at
                ),
                array(
                    'id'            =>  4,
                    'parent_id'     =>  3,
                    'title'         =>  'User',
                    'active'        =>  true,
                    'created_at'    =>  $created_at
                )
            )
        );
    }

}
