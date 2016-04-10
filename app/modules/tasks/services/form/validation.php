<?php
/**
 * Created by PhpStorm.
 * User: 1
 * Date: 29.09.2015
 * Time: 10:03
 */

class Tasks_Service_Form_Validation extends Core_Service_Form_Validation_Abstract{

    public function fieldsEvent(){
        $this->_setValidateFields(array(
            'id' =>  'required|integer',
            'type' =>  'required',
//            'start' =>  'required',
//            'end'  =>  'required'
        ));
    }
}