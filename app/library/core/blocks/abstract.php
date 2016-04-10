<?php
/**
 * Created by PhpStorm.
 * User: Tolla
 * Date: 06.04.2016
 * Time: 16:46
 */

class Core_Blocks_Abstract{

    public function __construct(){
        $this->_init();
    }

    protected function _init(){

        // init service
        if(!empty($this->_services)){
            if(is_array($this->_services)){
                //    protected $_services = array('service'=>'name service','serviceName'=>'name service name');
                foreach($this->_services as $variable=>$nameService){
                    $this->$variable = new $nameService();
                }
            }else{
                //    protected $_services = 'name service';
                $this->service = new $this->_services();
            }
        }
    }
}