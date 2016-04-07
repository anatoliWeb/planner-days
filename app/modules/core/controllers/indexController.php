<?php
/**
 * Created by PhpStorm.
 * User: Tolla
 * Date: 06.04.2015
 * Time: 17:15
 */

class Core_IndexController extends Core_Controller_Abstract{

    public function index(){

//        die(gethostname());die;
        $view = View::make('core::script.default.index.homePage');
        return $view;
    }
}