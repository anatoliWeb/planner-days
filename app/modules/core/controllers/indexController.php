<?php
/**
 * Created by PhpStorm.
 * User: Tolla
 * Date: 06.04.2015
 * Time: 17:15
 */

class Core_IndexController extends Core_Controller_Abstract{
    /**
     * @var \Statistic_Services_Statistic
     */
    protected $service;

    /**
     * @var \Tasks_Services_TasksType
     */
    protected $serviceTasksType;

    /**
     * @var \Account_Services_Account
     */
    protected $serviceAccount;


    protected $_services = array('service'=>'Statistic_Services_Statistic', 'serviceTasksType'=>'Tasks_Services_TasksType','serviceAccount'=>'Account_Services_Account');

    public function index(){
//          empty page
//        $view = View::make('core::script.default.index.homePage');
//        return $view;
        $data = $data = Input::all();
        $account_id = Auth::user()->id;
        $data['account_id'] =$account_id;

        if($account_id == 1 ) {
            $rows = $this->service->detalRows($data);
            $taskType = $this->serviceTasksType->allIdByData();
            $accountData = $this->serviceAccount->allIdByData();
            $view = View::make('statistic::script.default.index.allAccount');
            $view->with('data',$rows);
            $view->with('accountData', $accountData);
            $view->with('taskType', $taskType);
            return $view;
        }else{

            $rows = $this->service->detalRow($data);
            $taskType = $this->serviceTasksType->allIdByData();
            $view = View::make('statistic::script.default.index.index');
            $view->with('data',$rows);
            $view->with('taskType', $taskType);
            return $view;
        }


    }
}