<?php
/**
 * Created by PhpStorm.
 * User: Tolla
 * Date: 06.04.2016
 * Time: 17:20
 */
interface Core_Service_Form_Validation_Interface
{
    /**
     * Validate data
     * @return bool
     */
    public function validate();

    /**
     * @param $type
     * @return mixed
     */
    public function setType($type);

}