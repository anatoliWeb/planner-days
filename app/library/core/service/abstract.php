<?php
/**
 * Created by PhpStorm.
 * User: Tolla
 * Date: 06.04.2016
 * Time: 16:48
 */

class Core_Service_Abstract{
    /**
     *
     */
    public function __construct(){
        $this->_init();
    }

    /**
     *
     */
    protected function _init(){
        // init models
        if(!empty($this->_models)){
            if(is_array($this->_models)){
                //    protected $_models = array('model'=>'name model','modelName'=>'name model name',);
                foreach($this->_models as $variable=>$nameModels){
                    $this->$variable = new $nameModels();
                }
            }else{
                //    protected $_models = 'name model';
                $this->model = new $this->_models();
            }
        }
        // init service
        if(!empty($this->_services)){
            if(is_array($this->_services)){
                //    protected $_services = array('service'=>'name service','serviceName'=>'name service name');
                foreach($this->_services as $variable=>$nameService){
                    $this->$variable = new $nameService();
                }
            }else{
                //    protected $_services = 'name service';
                $this->servoce = new $this->_services();
            }
        }
    }

    /**
     * @param $id
     * @param string $model
     * @return bool
     */
    public function getDataById($id, $model = 'model'){
        $select = $this->$model->select();

        if(is_array($id)){
            $select->whereIn('id', $id);
            return $select->get();
        }else{
            $select->where('id','=',$id);
            if($select->count()){
                return $select->first();
            }
        }

        return false;
    }

    /**
     * @param $id
     * @param $active
     * @param string $model
     */
    public function activeInactive($id, $active, $model = 'model'){
        $select = $this->$model->find($id);
        $select->active = empty($active);
        $select->save();
    }

    /**
     * @param $id
     * @param string $model
     */
    public function deleteRow($id, $model = 'model')
    {
        DB::beginTransaction();

        $select = DB::table($this->$model->table);
        $select->where('id', '=', $id);
        $select->delete();

        DB::commit();
    }
}