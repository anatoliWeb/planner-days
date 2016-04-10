<?php
/**
 * Created by PhpStorm.
 * User: tolla
 * Date: 09.04.2016
 * Time: 17:49
 */

class Tasks_Services_Tasks extends Core_Service_Abstract
{
    public function filterFormData($data){
        $rows = array();
        if(!empty($data['id'])){
            $serviceTasksTime = new Tasks_Services_TasksTime();
            return (array)$serviceTasksTime->eventById($data['id'], true, "m/d/Y g:i a");
        }

        if(!empty($data['start'])){
            $rows['start'] = $data['start'];
        }
        if(!empty($data['end'])){
            $rows['end'] = $data['end'];
        }

        return $rows;
    }
}