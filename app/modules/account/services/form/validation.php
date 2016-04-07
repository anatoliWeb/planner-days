<?php
/**
 * Created by PhpStorm.
 * User: 1
 * Date: 29.09.2015
 * Time: 10:03
 */

class Account_Service_Form_Validation extends Core_Service_Form_Validation_Abstract{

    public function fieldsAutorisation(){
        $this->_setValidateFields(array(
            'login' =>  'required|min:4',
            'password'  =>  'required|min:4'
        ));
    }

}