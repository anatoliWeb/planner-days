<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAccountGroupMap extends Migration {

    /**
     * @var string
     */
    protected $tableName = "account_group_map";

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create($this->tableName, function(Blueprint $table)
        {
            $table->integer('account_groupe_id');
            $table->integer('account_id');
        });

        $this->createGroupByAccount();
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

    public function createGroupByAccount(){
        DB::table($this->tableName)->insert(
            array(
                'account_groupe_id'   =>  1,
                'account_id'        =>  1
            )
        );
    }

}
