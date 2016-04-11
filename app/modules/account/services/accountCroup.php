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

    public function hasParentGroup($account_id = 0){

        if(empty($account_id)){
            $account_id = Auth::user()->id;
        }

        $select = $this->modelGroupMap->select();
        $select->Join($this->modelGroup->getNameTable(),$this->modelGroup->getNameTable().'.parent_id','=',$this->modelGroupMap->getNameTable().'.account_groupe_id');
        $select->where($this->modelGroupMap->getNameTable().'.account_id','=',$account_id);

        return !empty($select->count());
    }

    public function listGroupsIdsBy($rows, $_id, &$_rows){
        if(empty($rows[$_id])) return false;
        $_rows[] = $rows[$_id];
        $this->listGroupsIdsBy($rows, $rows[$_id], $_rows);

    }

    public function listGroupChildrenIds($account_id = 0){
        if(empty($account_id)){
            $account_id = Auth::user()->id;
        }

        $select = $this->modelGroupMap->select('account_groupe_id');
        $select->where('account_id','=',$account_id);
        $group_ids = $select->lists('account_groupe_id');

        $select = $this->modelGroup->select();
        $rows = $select->lists('id','parent_id');

        $list_group_id = array();

        foreach($group_ids as $group_id){
            $this->listGroupsIdsBy($rows, $group_id, $list_group_id);
        }

        $select = $this->modelGroupMap->select();
        $select->whereIn('account_groupe_id', $list_group_id);

        return $select->lists('account_id');
    }

}