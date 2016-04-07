<?php

$actionName = explode(chr(64),Route::current()->getActionName());
$controller = $actionName[0];
$method = $actionName[1];
?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">{{Config::get('app.nameSite')}}</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <?php $actionController = 'Account_IndexController';?>
        <li @if($controller == $actionController)class="active"@endif><a href="{{--action($actionController.'@index')--}}">{{Lang::get('lang.Account')}}</a></li>

        <?php $actionController = 'Question_IndexController';?>
        <li @if($controller == $actionController)class="active"@endif><a href="{{--action($actionController.'@index')--}}">{{Lang::get('lang.Question')}}</a></li>

        <?php $actionControllers =
            array(
             'Account_ConfigController' =>
                array('method' => 'index', 'name' => Lang::get('lang.Account'),'class'=>'hide'),
             'Question_ConfigController' =>
                array('method'=>'index', 'name' => Lang::get('lang.Question'),'class'=>'hide'),
             'Ifram_ConfigController' =>
                array('method' => 'index', 'name' => Lang::get('lang.Ifram'))
            );?>
        <li class="dropdown @if(!empty($actionControllers[$controller])) active @endif">
            <a href="{{--action('Account_ConfigController@index')--}}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{Lang::get('lang.configuration')}}<span class="caret"></span></a>
            <ul class="dropdown-menu">
                @foreach($actionControllers as $action=>$data)
                    <li class=" @if($controller == $action) active @endif @if(!empty($data['class'])){{$data['class']}}@endif" ><a href="{{--action($action.'@'.$data['method'])--}}">{{$data['name']}}</a></li>
                @endforeach
            </ul>
        </li>

        <?php

        $actionControllers =
            array(
             array('action'=>'Ifram_IndexController','method' => 'index', 'name' => Lang::get('lang.createOrEdit'),'class'=>''),
             array('action'=>'Ifram_StatisticController','method'=>'index', 'name' => Lang::get('lang.statistic'),'class'=>''),
             array('action'=>'Ifram_IndexController','method' => 'getReadListData', 'name' => Lang::get('lang.result'))
            );
        $active = false;
            foreach($actionControllers as $data){
                if($controller == $data['action'] && $method == $data['method']){
                    $active = true;
                }
            }
            ?>
        <li class="dropdown @if($active) active @endif">
            <a href="{{--action('Account_ConfigController@index')--}}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{Lang::get('lang.Ifram')}}<span class="caret"></span></a>
            <ul class="dropdown-menu">
                @foreach($actionControllers as $action=>$data)
                    <li class=" @if($controller == $data['action'] && $method == $data['method']) active @endif @if(!empty($data['class'])){{$data['class']}}@endif" ><a href="{{--action($data['action'].'@'.$data['method'])--}}">{{$data['name']}}</a></li>
                @endforeach
            </ul>
        </li>


        {{--<li class="dropdown">--}}
          {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>--}}
          {{--<ul class="dropdown-menu">--}}
            {{--<li><a href="#">Action</a></li>--}}
            {{--<li><a href="#">Another action</a></li>--}}
            {{--<li><a href="#">Something else here</a></li>--}}
            {{--<li role="separator" class="divider"></li>--}}
            {{--<li><a href="#">Separated link</a></li>--}}
            {{--<li role="separator" class="divider"></li>--}}
            {{--<li><a href="#">One more separated link</a></li>--}}
          {{--</ul>--}}
        {{--</li>--}}
      </ul>
      {{--<form class="navbar-form navbar-left" role="search">--}}
        {{--<div class="form-group">--}}
          {{--<input type="text" class="form-control" placeholder="Search">--}}
        {{--</div>--}}
        {{--<button type="submit" class="btn btn-default">Submit</button>--}}
      {{--</form>--}}
      <ul class="nav navbar-nav navbar-right">
        <li><a href="{{action('Account_IndexController@getLogout')}}">{{Lang::get('lang.Logout')}} <span class="glyphicon glyphicon-off" aria-hidden="true"></span></a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>