<?php
/**
 * Created by PhpStorm.
 * User: tolla
 * Date: 10.04.2016
 * Time: 10:50
 */

class Statistic_IndexController extends Core_Controller_Abstract
{
    /**
     * @var \Statistic_Services_Statistic
     */
    protected $service;

    /**
     * @var \Tasks_Services_TasksType
     */
    protected $serviceTasksType;

    protected $_services = array('service'=>'Statistic_Services_Statistic', 'serviceTasksType'=>'Tasks_Services_TasksType');

    public function index(){
        $data = $data = Input::all();
        $data['account_id'] = Auth::user()->id;
        $rows = $this->service->detalRow($data);
        $taskType = $this->serviceTasksType->allIdByData();
        $view = View::make('statistic::script.default.index.index');
        $view->with('data',$rows);
        $view->with('taskType', $taskType);
        return $view;
    }
}