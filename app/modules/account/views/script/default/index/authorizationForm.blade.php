@extends('template.default.index')

@section('style')
   .authorization{
      margin: auto;
      width: 390px;
      display: block;
      height: 330px;
      border-radius: 3px
   }
   .alert-error{
        position: absolute;
        width: 358px;
            z-index: 99;
   }
@stop

@section('controller')
    <div class = 'authorization modal'>
        <div class="panel panel-primary">

            <div class="panel panel-heading">
                <h1 class="panel-title">{{Lang::get('lang.authorization')}}</h1>
            </div>
            <div class="panel-body">
                @include('template.default.messages.block')
                <fieldset>
                    {{ Form::open(array('action'=>'Account_IndexController@postAuthorization'))}}
                        <section class="authorization-block">
                            <div class="form-group">
                                {{ Form::label('login' ,Lang::get('lang.Login'))}}
                                {{ Form::text('login' ,(empty($data['login'])) ? null : $data['login'] ,['placeholder'=>Lang::get('lang.LoginExample'),'class'=>'inputbox form-control'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('password' ,Lang::get('lang.Password'))}}
                                {{ Form::password('password',['placeholder'=>Lang::get('lang.Password'),'class'=>'inputbox form-control'])}}
                            </div>
                            <div class="form-group">
                                {{Form::checkbox('remember','1')}} - {{ Form::label('label' ,Lang::get('lang.RememberMe'))}}
                            </div>
                            <div class="form-group">
                                {{ Form::submit(Lang::get('lang.Login'),['class'=>'btn btn-primary'])}} {{Lang::get('lang.or')}} <a href='{{action('Account_IndexController@getRegistration')}}'>{{Lang::get('lang.registration')}}</a>
                            </div>
                            {{--<div class="form-group">--}}
                                {{--<a href='{{action('Account_IndexController@getForgotPassword')}}'>{{Lang::get('lang.PasswordForgot')}}</a>--}}
                            {{--</div>--}}
                        </section>
                    {{ Form::close() }}
                </fieldset>
            </div>
        </div>
    </div>
@stop
