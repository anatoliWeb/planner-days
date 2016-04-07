<?php
/**
 * Created by PhpStorm.
 * User: 1
 * Date: 03.09.2015
 * Time: 16:22
 */

class Account_IndexController extends Core_Controller_Abstract{
    /**
     * @var \Account_Services_Account
     */
    protected $service;

    protected $_services = 'Account_Services_Account';

    public function index(){

        $rows = $this->service->getAll();


        $view = View::make('account::script.default.index.index');
        $view->with('rows',$rows);
        $view->with('account', Auth::user());
        return $view;
    }

    public function getAuthorization(){

        if(Auth::check()){
            return Redirect::to('/');
        }

        $view = View::make('account::script.default.index.authorizationForm');
        $view->with('offBlockHead',1);

        return $view;
    }

    public function postAuthorization(){
        if(Auth::check()){
            return Redirect::to('/');
        }
        $data = Input::all();

        /**
         * var /Account_Service_Form_Validation
         */
        $serviceValidation = new Account_Service_Form_Validation($data);
        $serviceValidation->fieldsAutorisation();
        try{

            if($serviceValidation->validate()){
                $this->service->authorization($serviceValidation->getFailed());
            }

            return Redirect::to('/');
        }catch (Exception $e){
            var_dump($e->getMessage());
        }
        var_dump($data);
        die;
    }

    public function getLogout(){
        Auth::logout();
        return Redirect::to('/');
    }
}
