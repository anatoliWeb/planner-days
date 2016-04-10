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
        }else{
            throw new Exception('error login or password');
        }
    }

    public function _password($login, $password){
        return md5($login.Config::get('app.key').$password);
    }

    public function registration($data){
        DB::beginTransaction();
        $dataModel = array(
            'login'     =>  $data['login'],
            'password'  => $this->_password($data['login'], $data['password']),
            'email'     => $data['email'],
            'active'    =>  1,
            'hash'      =>  md5(microtime())
        );

        $model = $this->model;
        $modelId = $model->insertGetId($dataModel);

        $rows = $model->find($modelId);

        $this->sendConfirmEmail($rows);

        DB::commit();
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
                $dataModel['created_at'] =  date("Y-m-d H:i:s");
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

    public function confirmEmail($data){
        $model = $this->model->select();
        $model->where('login','=',$data['login']);
        $model->where('hash','=',$data['hash']);
        if($model->count()){
            $rowModel = $model->first();
            $rowModel->update(array(
                'hash'  =>  '',
                'created_at' => date('Y-m-d H:m:s')
            ));
        }else{
            throw new Exception('error login or url');
        }
    }

    public function sendConfirmEmail($data){

        $data_email=[
            'hash'         =>  $data->hash
        ];

        Mail::send('account::emails.confirmEmail', $data_email , function ($m) use ($data) {
            $m->to($data->email, $data->login)->subject(Lang::get('lang.confirmEmail'));
        });
    }

    public function allIdByData(){
        $select = $this->model->select();
        $rows = $select->get();

        $_rows = array();
        foreach($rows as $row){
            $_rows[$row->id] = $row;
        }

        return $_rows;
    }
}