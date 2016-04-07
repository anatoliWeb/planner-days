<?php
/**
 * Created by PhpStorm.
 * User: Tolla
 * Date: 06.04.2016
 * Time: 17:20
 */

abstract class Core_Service_Form_Validation_Abstract implements Core_Service_Form_Validation_Interface
{
    protected $_validationFields = array();

    protected $_extValidationFields = array();

    protected $_data;

    protected $_type;

    protected $_failed = array();

    protected $_messages = array();

    /**
     * @param $data
     */
    public function __construct($data)
    {
        $this->_setData($data);
    }

    /**
     * @param $data
     */
    protected function _setData($data)
    {
        $this->_data = $data;
    }

    /**
     * @return mixed
     */
    protected function _getData()
    {
        return $this->_data;
    }

    /**
     * @param $type
     * @return mixed|void
     */
    public function setType($type)
    {
        $this->_type = $type;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * save messages
     * @param $messages
     * @param bool $key
     */
    protected function _setMessages($messages, $key = false)
    {
        if($key){
            $this->_messages[$key] = $messages;
        }else{
            $this->_messages = $messages;
        }
    }

    /**
     * return messages
     * @param bool $key
     * @return array
     */
    public function getMessages($key = false)
    {
        if($key){
            return $this->_messages[$key];
        }
        return $this->_messages;
    }

    /**
     * @param $fields
     */
    protected function _setValidateFields($fields){
        $this->_validationFields = $fields;
    }

    /**
     * Return required fields for validation
     * @return array
     */
    protected function _getValidateFields()
    {
        return $this->_validationFields;
    }

    /**
     * Check if field has external validation
     * @param $key
     * @return bool
     */
    protected function _hasExtValidation($key)
    {
        return in_array($key,$this->_extValidationFields);
    }

    /**
     * Return service for external validation
     * @param $field
     * @return mixed
     */
    protected function _getServiceValidation($field)
    {
        return new $this->_extValidationFields[$field]();
    }

    /**
     * check validate data
     * @return bool
     */
    public function validate()
    {
        $isValid = true;
        $validation = Validator::make($this->_getData(), $this->_getValidateFields());
        if(!$validation->fails()){
            foreach($this->_getValidateFields() as $key => $field){
                if($this->_hasExtValidation($key)){
                    $validationService = $this->_getServiceValidation($key);
                    if(!$validationService->validate($this->_formData[$key])){
                        $isValid = false;
                        $this->_setMessages($validationService->getMessages(), $key);
                    }
                }
            }
        }else{
            $isValid = false;
            $this->_setMessages($validation->messages()->toArray());
        }

        return $isValid;
    }

    /**
     * return all validate data
     * @return array
     */
    public function getFailed(){
        return $this->_data;
    }
}