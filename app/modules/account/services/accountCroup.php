<?php
/**
 * Created by PhpStorm.
 * User: tolla
 * Date: 10.04.2016
 * Time: 20:19
 */

class Account_Services_AccountGroup extends Core_Service_Abstract{

    /**
     * @var \Account_Models_AccountGroup
     */
    protected $modelGroup;

    /**
     * @var \Account_Models_AccountGroupMap
     */
    protected $modelGroupMap;

    /**
     * @var string
     */
    protected $_models = array('modelGroup'=>'Account_Models_AccountGroup','modelGroupMap'=>'Account_Models_AccountGroupMap');

    public function hasParentGroup($account_id){

        $select = $this->modelGroupMap->select();
        $select->Join($this->modelGroup->getNameTable(),$this->modelGroup->getNameTable().'.parent_id','=',$this->modelGroupMap->getNameTable().'.account_groupe_id');
        $select->where($this->modelGroupMap->getNameTable().'.account_id','=',$account_id);

        return !empty($select->count());
    }

}