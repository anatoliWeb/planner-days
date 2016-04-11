<?php
/**
 * Created by PhpStorm.
 * User: Tolla
 * Date: 06.04.2016
 * Time: 16:47
 */

class Core_Models_Abstract extends Eloquent{
    /**
    * name table
    * @var string
    */
    protected $table ;

    /**
     * @var bool
     */
    public static $unguarded = true;

    /**
     * Note that you will need to place updated_at and created_at columns on your table by default
     * @var bool
     */
    public $timestamps = false;

    public function __construct(){
        $this->_init();
    }

    protected function _init(){

    }

    public function getNameTable(){
        return $this->table;
    }

}