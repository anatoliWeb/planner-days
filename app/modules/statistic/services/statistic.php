<?php
/**
 * Created by PhpStorm.
 * User: 1
 * Date: 04.09.2015
 * Time: 10:32
*/

class Statistic_Services_Statistic extends Core_Service_Abstract
{
    /**
     * @var \Tasks_Models_TasksTime
     */
    protected $modelTasksTime;

    /**
     * @var \Tasks_Models_TasksType
     */
    protected $modelTasksType;

    /**
     * @var string
     */
    protected $_models = array('modelTasksTime'=>'Tasks_Models_TasksTime', 'modelTasksType'=>'Tasks_Models_TasksType');

    public function detalRow($data){

        $account_id = $data['account_id'];
        // total
        $select = $this->modelTasksTime->select(DB::raw('SUM(hover) as sum_hover, tasks_type_id'));
        $select->groupBy('tasks_type_id');
        $select->orderBy('tasks_type_id');
        $select->where('account_id','=',$account_id);
        $rows= $select->get();
        $rowsTotal = array();
        foreach($rows as $row){
            $rowsTotal[$row->tasks_type_id] = $row;
        }

        // used
        $select = $this->modelTasksTime->select(DB::raw('SUM(hover) as sum_hover, tasks_type_id'));
        $select->groupBy('tasks_type_id');
        $select->orderBy('tasks_type_id');
        $select->where('account_id','=',$account_id);
        $select->where('end',"<",date("Y-m-d H:i:s"));
        $rows = $select->get();
        foreach($rows as $row){
            $rowsUsed[$row->tasks_type_id] = $row;
        }

        $rows = array();
        foreach($rowsTotal as $key=>$row){

            $usedHover = empty($rowsUsed[$key])?0:$rowsUsed[$key]->sum_hover;

            $rows[$row->tasks_type_id] = array(
              'total'   =>  $row->sum_hover,
              'used'    =>  $usedHover,
              'left'    =>  $row->sum_hover - $usedHover
            );
        }

        return $rows;
    }

    public function detalRows($data){

        $account_id = $data['account_id'];

        // total
        $select = $this->modelTasksTime->select(DB::raw('SUM(hover) as sum_hover, tasks_type_id, account_Id'));
        $select->groupBy('tasks_type_id');
        $select->groupBy('account_id');
        $select->orderBy('tasks_type_id');
        $select->where('account_id','!=',$account_id);
        $rows= $select->get();
        $rowsTotal = array();
        foreach($rows as $row){
            $rowsTotal[$row->account_Id][$row->tasks_type_id] = $row;
        }

        // used
        $select = $this->modelTasksTime->select(DB::raw('SUM(hover) as sum_hover, tasks_type_id, account_Id'));
        $select->groupBy('tasks_type_id');
        $select->groupBy('account_id');
        $select->orderBy('tasks_type_id');
        $select->where('account_id','!=',$account_id);
        $select->where('end',"<",date("Y-m-d H:i:s"));
        $rows = $select->get();
        foreach($rows as $row){
            $rowsUsed[$row->account_Id][$row->tasks_type_id] = $row;
        }

        $rows = array();
        foreach($rowsTotal as $accountId=>$_rows){
            foreach($_rows as $key=>$row){
                $usedHover = empty($rowsUsed[$accountId][$key])?0:$rowsUsed[$accountId][$key]->sum_hover;

                $rows[$accountId][$row->tasks_type_id] = array(
                    'total'   =>  $row->sum_hover,
                    'used'    =>  $usedHover,
                    'left'    =>  $row->sum_hover - $usedHover
                );
            }
        }

        return $rows;
    }
}