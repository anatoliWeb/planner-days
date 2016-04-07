<?php
/**
 * Created by PhpStorm.
 * User: 1
 * Date: 04.09.2015
 * Time: 10:27
 */

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Account_Models_Account extends Core_Models_Abstract implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    /**
     * @var bool
     */
    public static $unguarded = true;

    /**
     * Note that you will need to place updated_at and created_at columns on your table by default
     * @var bool
     */
    public $timestamps = true;

    /**
     * name table
     * @var string
     */
    protected $table = 'account';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    /**
     * @param $login
     * @param $password
     * @return $this
     */
    public function checkAuthorization($login ,$password){

        return  self::select()
            ->where('password', $password)
            ->where('login', $login)
            ->where('active', '1')
            ->where('hash', '')
            ;
    }
}