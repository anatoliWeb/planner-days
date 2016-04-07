<?php
/**
 * Created by PhpStorm.
 * User: 1
 * Date: 04.09.2015
 * Time: 10:32
*/

class Account_Services_Account extends Core_Service_Abstract{

    /**
     * @var \AccountModelsAccount
     */
    protected $model;

    /**
     * @var string
     */
    protected $_models = 'Account_Models_Account';


    public function authorization($data){

        // check
        $password = self::_password($data['login'] ,$data['password']);
        $modelCheckAuthorization = $this->model->checkAuthorization($data['login'] ,$password);
        if($modelCheckAuthorization->count()){
            $rows = $modelCheckAuthorization->firstOrFail();
            Auth::login($rows, !empty($data['remember']));
//            $modelAccountActivity = new Account_models_AccountActivity();
//            $modelAccountActivity->createAction($rows->getAttribute('id'));
        }
    }

    public function _password($login, $password){
        return md5($login.Config::get('app.key').$password);
    }

    public function getAll(){
        $select = $this->model->select();

        $rows = $select->get();
        return $rows;
    }

    public function updateRow($data){
        $user = empty($data['user']) ? array() : $data['user'];
        // validation
        var_dump($data);

        try {
            DB::beginTransaction();

            $dataModel = array(
                'firstName' =>  $user['firstName'],
                'lastName'  =>  $user['lastName'],
                'login'     =>  $user['login'],
                'email'     =>  $user['email']
            );
            if(!empty($user['password'])){
                $dataModel['password'] = $this->_password($user['login'],$user['password']);
            }

            $model = $this->model->select();
            $model->where('id','=',$user['id']);
            if($model->count()){
                // update data
                $rowModel = $model->first();
                $rowModel->update($dataModel);
                $modelId = $user['id'];
            }else{
                // create date
                $modelId = $model->insertGetId($dataModel);
            }

            $data = $model->find($modelId);

            DB::commit();
        }catch (Exception $e){
            DB::rollback();
            var_dump(__FILE__.': '.__LINE__);

            dd($e->getMessage());

        }

        return array($modelId, $data);

    }
}