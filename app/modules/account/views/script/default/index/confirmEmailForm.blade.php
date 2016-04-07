@extends('template.default.index')

@section('style')
   .confirm-email{
      margin: auto;
      width: 390px;
      display: block;
      height: 330px;
      border-radius: 3px
   }
   .alert-messages{
        position: absolute;
        width: 358px;
            z-index: 99;
   }
@stop

@section('controller')
    <div class = 'confirm-email modal'>
        <div class="panel panel-primary">

            <div class="panel panel-heading">
                <h1 class="panel-title">{{Lang::get('lang.confirm')}}</h1>
            </div>

            <div class="panel-body">
                @include('template.default.messages.block')
                <fieldset>
                    {{ Form::open(array('action'=>array('Account_IndexController@postConfirmEmail', $hash)))}}
                        <section class="confirm-block">
                            <div class="form-group">
                                {{ Form::label('login' ,Lang::get('lang.login'))}}
                                {{ Form::password('login',['placeholder'=>Lang::get('lang.login'),'class'=>'inputbox form-control'])}}
                            </div>

                            <div class="form-group">
                                {{ Form::submit(Lang::get('lang.next'),['class'=>'btn btn-primary'])}} {{Lang::get('lang.or')}} <a href='{{action('Account_IndexController@getAuthorization')}}'>{{Lang::get('lang.cancel')}}</a>
                            </div>
                        </section>
                        {{Form::hidden('hash',$hash)}}
                    {{ Form::close() }}
                </fieldset>
            </div>
        </div>
    </div>
@stop