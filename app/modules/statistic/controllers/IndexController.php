<?php
/**
 * Created by PhpStorm.
 * User: tolla
 * Date: 10.04.2016
 * Time: 10:50
 */

class Statistic_IndexController extends Core_Controller_Abstract
{
    public function index(){
        $view = View::make('tasks::script.default.index.index');
        $view->with('fullCalendar',true);
        return $view;
    }
}