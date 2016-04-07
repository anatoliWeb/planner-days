@extends('template.default.index')

@section('style')
    .registration{
      margin: auto;
      width: 390px;
      display: block;
      height: 380px;
      border-radius: 3px
   }

    .alert-error{
        position: absolute;
        width: 358px;
        z-index: 99;
   }
@stop

@section('controller')
    <div class = 'registration modal'>
        <div class="panel panel-primary">

            <div class="panel panel-heading">
                <h1 class="panel-title">{{Lang::get('lang.registration')}}</h1>
            </div>

            <div class="panel-body">
                @include('template.default.messages.block')
                <fieldset>
                    {{ Form::open(array('action'=>'Account_IndexController@postRegistration'))}}
                        <section class="registration-block">

                            <div class="row form-group">
                                   <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                       {{ Form::label('login' ,Lang::get('lang.Login'))}}
                                   </div>
                                   <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                        {{ Form::text('login' ,(empty($data['login'])) ? null : $data['login'] ,array('placeholder'=>Lang::get('lang.LoginExample'),'class'=>'inputbox form-control', 'required'=>'required'))}}
                                   </div>
                            </div>

                            <div class="row form-group">
                                   <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                       {{ Form::label('password' ,Lang::get('lang.password'))}}
                                   </div>
                                   <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                        {{ Form::password('password' ,array('placeholder'=>Lang::get('lang.password'),'class'=>'inputbox form-control', 'required'=>'required'))}}
                                   </div>
                            </div>

                            <div class="row form-group">
                                   <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                       {{ Form::label('confirmPassword' ,Lang::get('lang.confirmPassword'))}}
                                   </div>
                                   <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                        {{ Form::password('confirmPassword' ,array('placeholder'=>Lang::get('lang.password'),'class'=>'inputbox form-control', 'required'=>'required'))}}
                                   </div>
                            </div>

                            <div class="row form-group">
                                   <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                       {{ Form::label('email' ,Lang::get('lang.email'))}}
                                   </div>
                                   <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                        {{ Form::email('email' ,(empty($data['email'])) ? null : $data['email'] ,array('placeholder'=>Lang::get('lang.emailExample'),'class'=>'inputbox form-control', 'required'=>'required'))}}
                                   </div>
                            </div>

                            <div class="form-group">
                                {{Form::checkbox('agree_rule','1', array('required'=>'required'))}} - {{ Form::label('label' ,Lang::get('lang.agreeRule'))}} <small>(<a href='#'>{{Lang::get('lang.rules')}}</a>)</small>
                            </div>

                            <div class="form-group">
                                {{ Form::submit(Lang::get('lang.registration'),['class'=>'btn btn-primary'])}} {{Lang::get('lang.or')}} <a href='{{action('Account_IndexController@getAuthorization')}}'>{{Lang::get('lang.cancel')}}</a>
                            </div>

                        </section>
                    {{ Form::close() }}
                </fieldset>
            </div>
        </div>
    </div>
@stop