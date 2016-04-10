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
        $view = View::make('account::script.default.index.index');
        $view->with('account', Auth::user());
        return $view;
    }

    public function getAuthorization(){
        $view = View::make('account::script.default.index.authorizationForm');
        $view->with('offBlockHead',1);

        return $view;
    }

    public function postAuthorization(){
        $data = Input::all();

        /**
         * var /Account_Service_Form_Validation
         */
        $serviceValidation = new Account_Service_Form_Validation($data);
        $serviceValidation->fieldsAuthorization();
        try{

            if($serviceValidation->validate()){
                $this->service->authorization($serviceValidation->getFailed());
            }

            return Redirect::to('/');
        }catch (Exception $e){
            $view = View::make('account::script.default.index.authorizationForm');
            $view->with('offBlockHead',1);
            $view->with('messages', array('errors'=>$e->getMessage()));
            return $view;
        }
    }

    public function getLogout(){
        Auth::logout();
        return Redirect::action('Account_IndexController@getAuthorization');
    }

    public function getRegistration(){
        $view = View::make('account::script.default.index.registrationForm');
        $view->with('offBlockHead',1);

        return $view;
    }

    public function postRegistration(){
        $data = Input::all();

        /**
         * var /Account_Service_Form_Validation
         */
        $serviceValidation = new Account_Service_Form_Validation($data);
        $serviceValidation->fieldRegistration();

        $view = View::make('account::script.default.index.registrationForm');
        $view->with('offBlockHead',1);
        $view->with('data', $data);
        try{

            if($serviceValidation->validate()){
                $this->service->registration($serviceValidation->getFailed());
            }else{

                $view->with('messages', array('errors'=>$serviceValidation->getMessages()));
                return $view;
            }

            Session::put('messages.info','Please confirm you email!');
            return Redirect::action('Account_IndexController@getAuthorization');

        }catch (Exception $e){
            DB::rollback();

            $view->with('messages', array('errors'=>$e->getMessage()));
            return $view;
        }
    }

    public function getForgotPassword(){
        $view = View::make('account::script.default.index.forgotPasswordForm');
        $view->with('offBlockHead',1);

        return $view;
    }

    public function postForgotPassword(){

    }

    public function getConfirmEmail($hash){
        $view = View::make('account::script.default.index.confirmEmailForm');
        $view->with('offBlockHead',1);
        $view->with('hash', $hash);
        return $view;
    }

    public function postConfirmEmail($hash){
        $data = Input::all();

        /**
         * var /Account_Service_Form_Validation
         */
        $serviceValidation = new Account_Service_Form_Validation($data);
        $serviceValidation->fieldConfirmEmail();

        $view = View::make('account::script.default.index.confirmEmailForm');
        $view->with('offBlockHead',1);
        $view->with('hash', $hash);

        try{

            if($serviceValidation->validate()){
                $this->service->confirmEmail($serviceValidation->getFailed());
            }else{

                $view->with('messages', array('errors'=>$serviceValidation->getMessages()));
                return $view;
            }

            Session::put('messages.info','Please enter login and password!');
            return Redirect::action('Account_IndexController@getAuthorization');

        }catch (Exception $e){

            $view->with('messages', array('errors'=>$e->getMessage()));
            return $view;
        }
    }

}
