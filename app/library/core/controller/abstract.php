<?php
/**
 * Created by PhpStorm.
 * User: Tolla
 * Date: 06.04.2016
 * Time: 16:46
 */

class Core_Controller_Abstract extends Controller{
    /**
     * @var string name template
     */
    protected $_template = 'default';

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

    /**
     * @param $id
     * @param $active
     * @return \Illuminate\Http\JsonResponse
     */
    public function postActiveInactive($id, $active){
        $json = array();
        try{
            $this->service->activeInactive($id, $active == 'false');
            $json['success'] = true;
        }catch (Exception $e){
            $json['message'] = $e->getMessage();
            $json['success'] = false;
        }

        return Response::json($json);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function postDelete($id){
        $json = array();
        try{
            $this->service->deleteRow($id);
            $json['success'] = true;
        }catch (Exception $e){
            $json['message'] = $e->getMessage();
            $json['success'] = false;
        }

        return Response::json($json);
    }

    /**
     * @param $name
     */
    protected function setTemplate($name){
        $this->_template = $name;
    }

    /**
     * @return string
     */
    public function getTemplate(){
        return $this->_template;
    }

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if ( ! is_null($this->layout))
        {
            $this->layout = View::make($this->layout);
        }
    }
}