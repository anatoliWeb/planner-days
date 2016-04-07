<?php
/**
 * Created by PhpStorm.
 * User: 1
 * Date: 29.09.2015
 * Time: 10:03
 */

class Account_Service_Form_Validation extends Core_Service_Form_Validation_Abstract{

    public function fieldsAuthorization(){
        $this->_setValidateFields(array(
            'login' =>  'required|min:4',
            'password'  =>  'required|min:4'
        ));
    }

    public function fieldRegistration(){
        $this->_setValidateFields(array(
            'login' =>  'required|min:4|unique:account,login',
            'password'  =>  'required|min:4',
            'confirmPassword'  =>  'required|same:password|min:4',
            'email'             => 'required|email|min:6|unique:account,email'
        ));
    }

    public function fieldConfirmEmail(){
        $this->_setValidateFields(array(
            'login'  =>  'required|min:4',
            'hash'   =>  'required|min:30|max:34'
        ));
    }
}