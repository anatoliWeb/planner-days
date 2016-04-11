<?php
/**
 * Created by PhpStorm.
 * User: tolla
 * Date: 08.04.2016
 * Time: 12:13
 */

class Tasks_IndexController extends Core_Controller_Abstract
{
    /**
     * @var \Tasks_Services_TasksType
     */
    protected $serviceType;

    /**
     * @var \Tasks_Services_TasksTime
     */
    protected $serviceTime;

    /**
     * @var \Tasks_Services_Tasks
     */
    protected $service;


    protected $_services = array('serviceTime'=>'Tasks_Services_TasksTime','serviceType'=>'Tasks_Services_TasksType','service'=>'Tasks_Services_Tasks');

    public function index(){
        $view = View::make('tasks::script.default.index.index');
        $view->with('fullCalendar',true);
        return $view;
    }

    public function getEdit($id=0){
        $view = View::make('tasks::script.default.index.edit');
        $view->with('fullCalendar',true);
        $view->with('bootstrapDateTimePicker',true);
        return $view;
    }

    public function postEdit($id=0){
        $view = View::make('tasks::script.default.index.edit');
        $view->with('fullCalendar',true);
        return $view;
    }

    public function postEvents(){
        $accountId = Auth::user()->id;

        $json = array();
        try{
            $json = $this->serviceTime->allEvents($accountId);
        }catch (Exception $e){
            $json['succes'] = false;
            $json['message'] = $e->getMessage();
        }

        return Response::json($json);
    }

    public function getEventForm(){
        $data = Input::all();
        $json = array();
        try{
            $view = View::make('tasks::script.default.index.editForm');
            $view->with('allTypeEvent', $this->serviceType->allType(true));
            $view->with('data', $this->service->filterFormData($data));
            $json['template'] = $view->render();
            $json['success'] = true;
        }catch (Exception $e){
            $json['message'] = $e->getMessage();
            $json['success'] = false;
        }

        return Response::json($json);

    }

    public function postEventForm(){
        $data = Input::all();
        $json = array();

        /**
         * var /Tasks_Service_Form_Validation
         */
        $serviceValidation = new Tasks_Service_Form_Validation($data);
        $serviceValidation->fieldsEvent();
        try{

            if($serviceValidation->validate()){
                $json['data'] = $this->serviceTime->saveEvent($data);
                $json['success'] = true;
            }else{
                $json['message'] = $serviceValidation->getMessages();
                $json['success'] = false;
            }
        }catch (Exception $e){
            $json['message'] = $e->getMessage();
            $json['success'] = false;
        }
        return Response::json($json);
    }

    public function postEventAction(){
        $data = Input::all();
        $json = array();

        /**
         * var /Tasks_Service_Form_Validation
         */

        try{
            $json['data'] = $this->serviceTime->saveEvent($data);
            $json['success'] = true;
        }catch (Exception $e){
            $json['message'] = $e->getMessage();
            $json['success'] = false;
        }
        return Response::json($json);
    }

    public function postEventBlock(){
        $data = Input::all();
        $json = array();

        try{
            $rows = $this->serviceTime->eventById($data['id'], true);
//            dd($rows);
            $view = View::make('tasks::script.default.index.taskBlock');
            $view->with('rows', (array)$rows);
            $json['template'] = $view->render();
            $json['title'] = $rows->title;
            $json['success'] = true;
        }catch (Exception $e){
            $json['message'] = $e->getMessage();
            $json['success'] = false;
        }

        return Response::json($json);
    }

    public function postRemoveEvent(){
        $data = Input::all();
        try{
            $this->serviceTime->deleteEvent($data['id']);
            $json['success'] = true;
        }catch (Exception $e){
            $json['message'] = $e->getMessage();
            $json['success'] = false;
        }

        return Response::json($json);
    }
}