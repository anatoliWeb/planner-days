<?php
/**
 * Created by PhpStorm.
 * User: tolla
 * Date: 09.04.2016
 * Time: 12:23
 */

class Tasks_Services_TasksTime extends Core_Service_Abstract
{

    /**
     * @var \Tasks_Models_TasksTime
     */
    protected $model;

    /**
     * @var string
     */
    protected $_models = 'Tasks_Models_TasksTime';
    
    public function allEvents($accountId){
        $select = $this->model->select();
        $select->where('account_id','=',$accountId);
        $_rows = array();
        if($select->count()){
            $rows = $select->get();
            foreach($rows as $row){
                //object that FullCalendar
                $object = new stdClass();
                /**
                 * String/Integer. Optional
                 * Uniquely identifies the given event. Different instances of repeating events should all have the same id.
                 */
                $object->id = $row->id;

                /**
                 * String. Required.
                 * The text on an event's element
                 */
                $object->title = $row->title;

                /**
                 * true or false. Optional.
                 * Whether an event occurs at a specific time-of-day. This property affects whether an event's time is shown. Also, in the agenda views, determines if it is displayed in the "all-day" section.
                 * If this value is not explicitly specified, allDayDefault will be used if it is defined.
                 * If all else fails, FullCalendar will try to guess. If either the start or end value has a "T" as part of the ISO8601 date string, allDay will become false. Otherwise, it will be true.
                 * Don't include quotes around your true/false. This value is a boolean, not a string!
                 */
                $object->allDay = false;

                /**
                 * The date/time an event begins. Required.
                 * A Moment-ish input, like an ISO8601 string. Throughout the API this will become a real Moment object.
                 */
                $object->start = $row->start;

                /**
                 * The exclusive date/time an event ends. Optional.
                 * A Moment-ish input, like an ISO8601 string. Throughout the API this will become a real Moment object.
                 * It is the moment immediately after the event has ended. For example, if the last full day of an event is Thursday, the exclusive end of the event will be 00:00:00 on Friday!
                 */
                $object->end = $row->end;

                /**
                 * String. Optional.
                 * A URL that will be visited when this event is clicked by the user. For more information on controlling this behavior, see the eventClick callback.
                 */
//                $object->url = '';

                /**
                 * String/Array. Optional.
                 * A CSS class (or array of classes) that will be attached to this event's element.
                 */
//                $object->className = '';

                /**
                 * Sets an event's background and border color just like the calendar-wide eventColor option
                 */
                $object->color = $row->tasks_type_id == 1 ? '#291852' : '#44673A';

                /**
                 * Sets an event's text color just like the calendar-wide eventTextColor option.
                 */
//                $object->textColor = '';

                $_rows[] = $object;
            }

        }

        return $_rows;
    }

    public function eventById($id, $description = false, $formatTime = "Y-m-d H:i:s"){
        $row = $this->model->find($id);

        $object = new stdClass();
        $object->id = $row->id;

        /**
         * String. Required.
         * The text on an event's element
         */
        $object->title = $row->title;

        /**
         * true or false. Optional.
         * Whether an event occurs at a specific time-of-day. This property affects whether an event's time is shown. Also, in the agenda views, determines if it is displayed in the "all-day" section.
         * If this value is not explicitly specified, allDayDefault will be used if it is defined.
         * If all else fails, FullCalendar will try to guess. If either the start or end value has a "T" as part of the ISO8601 date string, allDay will become false. Otherwise, it will be true.
         * Don't include quotes around your true/false. This value is a boolean, not a string!
         */
        $object->allDay = false;

        /**
         * The date/time an event begins. Required.
         * A Moment-ish input, like an ISO8601 string. Throughout the API this will become a real Moment object.
         */
        $object->start = date($formatTime,strtotime($row->start));

        /**
         * The exclusive date/time an event ends. Optional.
         * A Moment-ish input, like an ISO8601 string. Throughout the API this will become a real Moment object.
         * It is the moment immediately after the event has ended. For example, if the last full day of an event is Thursday, the exclusive end of the event will be 00:00:00 on Friday!
         */
        $object->end = date($formatTime,strtotime($row->end));

        /**
         * String. Optional.
         * A URL that will be visited when this event is clicked by the user. For more information on controlling this behavior, see the eventClick callback.
         */
//                $object->url = '';

        /**
         * String/Array. Optional.
         * A CSS class (or array of classes) that will be attached to this event's element.
         */
//                $object->className = '';

        /**
         * Sets an event's background and border color just like the calendar-wide eventColor option
         */
                $object->color =  $row->tasks_type_id == 1 ? '#291852' : '#44673A';

        /**
         * Sets an event's text color just like the calendar-wide eventTextColor option.
         */
//                $object->textColor = '';

        $object->tasks_type_id = $row->tasks_type_id;

        if($description){
            $object->description = $row->description;

        }

        return $object;
    }

    public function saveEvent($data){

        if((empty($data['start']) && empty($data['end']))){
            return false;
        }

        $dataModel = array(
            'account_updated_id'    =>  Auth::user()->id,
            'active'                =>  '1',
        );

        if(isset($data['start']))$dataModel['start'] = date("Y-m-d H:i:s",strtotime($data['start']));
        if(isset($data['end']))$dataModel['end'] = date("Y-m-d H:i:s",strtotime($data['end']));
        if(isset($data['title']))$dataModel['title'] = $data['title'];
        if(isset($data['description']))$dataModel['description'] = $data['description'];
        if(isset($data['tasks_type_id']))$dataModel['tasks_type_id'] = $data['tasks_type_id'];

        // howers
        $d0 = new DateTime($dataModel['end']);
        $d1 = new DateTime($dataModel['start']);
        $hover = ($d0->getTimestamp()-$d1->getTimestamp())/(60*60);
        $dataModel['hover'] = ($hover<0)?0:$hover;

        $model = $this->model->select();
        $model->where('id','=',$data['id']);
        if($model->count()){
            // update data
            $rowModel = $model->first();

            $rowModel->update($dataModel);
        }else{
            // create date
            $dataModel['account_id'] =  Auth::user()->id;
            $dataModel['account_create_id'] =  Auth::user()->id;
            $dataModel['created_at'] =  date("Y-m-d H:i:s");
            $data['id'] = $model->insertGetId($dataModel);
        }

        $dataEvent = $this->eventById($data['id']);

        return $dataEvent;
    }

    public function deleteEvent($id){
        $model = $this->model->find($id);
        return $model->delete($id);
    }
}