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
/**
     * @var \Account_Services_AccountGroup
     */
    protected $serviceAccountGroup;


    protected $_services = array('service'=>'Statistic_Services_Statistic', 'serviceTasksType'=>'Tasks_Services_TasksType','serviceAccount'=>'Account_Services_Account','serviceAccountGroup'=>'Account_Services_AccountGroup');

    public function index(){
//          empty page
//        $view = View::make('core::script.default.index.homePage');
//        return $view;

        $data = $data = Input::all();
        $account_id = Auth::user()->id;
        $data['account_id'] =$account_id;

        $taskType = $this->serviceTasksType->allIdByData();

        if($this->serviceAccountGroup->hasParentGroup($account_id)) {
            $rows = $this->service->detalRows($data);
            $accountData = $this->serviceAccount->allIdByData();
            $view = View::make('statistic::script.default.index.allAccount');
            $view->with('accountData', $accountData);
        }else{
            $rows = $this->service->detalRow($data);
            $view = View::make('statistic::script.default.index.index');
        }

        $view->with('taskType', $taskType);
        $view->with('data',$rows);
        return $view;

    }
}