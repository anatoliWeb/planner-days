<?php
/**
 * Created by PhpStorm.
 * User: Tolla
 * Date: 09.04.2016
 * Time: 10:27
 */
class Tasks_Models_TasksTime extends Core_Models_Abstract{

    /**
     * Note that you will need to place updated_at and created_at columns on your table by default
     * @var bool
     */
    public $timestamps = true;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tasks_time';

}