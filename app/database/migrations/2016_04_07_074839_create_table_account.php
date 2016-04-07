<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAccount extends Migration {

    /**
     * @var string
     */
    protected $tableName = "account";

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
            $table->string('email',255)->unique();
            $table->string('login', 60)->unique();
            $table->string('password', 40);
            $table->boolean('active')->default('0');
            $table->string('hash', 64);
            $table->rememberToken();
            $table->timestamps();
		});

        $this->create_admin();
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
     * create user admin
     */
    private function create_admin(){
        $password = md5('admin'.Config::get('app.key').'admin');
        // create admin user
        DB::table($this->tableName)->insert(array(
            'id'        =>  1,
            'email'     =>  'admin@admin.com',
            'login'     =>  'admin',
            'password'  =>  $password,
            'active'    =>  true,
            'hash'      =>  ''
        ));
    }

}
