<?php
/**
 * Created by PhpStorm.
 * User: tolla
 * Date: 09.04.2016
 * Time: 12:24
 */
class Tasks_Services_TasksType extends Core_Service_Abstract
{

    /**
     * @var \Tasks_Models_TasksType
     */
    protected $model;

    /**
     * @var string
     */
    protected $_models = 'Tasks_Models_TasksType';

    public function allType($selectArray = false, $active = true){

        $select = $this->model->select();
        if($active){
            $select->where('active','=','1');
        }
        $select->orderBy('order');

        if(!$select->count()){
            return array();
        }

        $rows = $select->get();

        if($selectArray){
            $_rows = array();
            foreach($rows as $row){
                $_rows[$row->id] = $row->title;
            }
            return $_rows;
        }else{
            return $rows;
        }
    }


}