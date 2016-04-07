@extends('template.default.index')

@section('controller')
    <div>
        @if(!Request::ajax())
        <h2>@if(empty($account->id)) {{Lang::get('lang.newUser')}} @else {{Lang::get('lang.edirUser')}}  {{$account->firstName}}@endif</h2>
        @endif
       <div>
          {{ Form::open(array('action' => array('Account_IndexController@postEdit',empty($account->id)?'':$account->id),'Method'=>'post', 'class'=>'form-horizontal'))}}
              <div>
              <!-- Nav tabs -->
              <!---
              <ul class="nav nav-tabs section-lists-head" role="tablist">
                  <li role="presentation" class="active">
                      <a href="#accauntDetail" aria-controls="#accauntDetail" role="tab" data-toggle="tab" class="lists-head">{{Lang::get('lang.accou{ntDetails')}}</a>
                  </li>
                  <li role="presentation">
                      <a href="#tabPanel-2" aria-controls="#tabPanel-2" role="tab" data-toggle="tab" class="lists-head">{{Lang::get('Lang.setting')}}</a>
                  </li>
              </ul>
              <p> </p>
          -->
              <!-- Tab panes -->
              <div class="tab-content">
                  <div class=" tab-pane active" role="tabpanel" id="accauntDetail"><?php

                        $classLabel = 'control-label col-lg-4 col-md-4 col-sm-4 col-xs-4';
                        $classEdit = 'inputbox form-control';

                    ?><div class="form-group"><?php
                            $name = 'login';
                            $_data = empty($account->$name) ? null : $account->$name;
                            print Form::label($name ,Lang::get('lang.'.$name), array('class'=>$classLabel));
                          ?><div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                              {{ Form::text('user['.$name.']' , $_data  ,array('placeholder'=>Lang::get('lang.'.$name), 'class'=>$classEdit))}}
                          </div>
                      </div>
                      <div class="form-group"><?php
                            $name = 'firstName';
                            $_data = empty($account->$name) ? null : $account->$name;
                          ?>{{ Form::label($name ,Lang::get('lang.'.$name), array('class'=>$classLabel))}}
                          <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                              {{ Form::text('user['.$name.']' , $_data  ,array('placeholder'=>Lang::get('lang.'.$name), 'class'=>$classEdit))}}
                          </div>
                      </div>
                      <div class="form-group"><?php
                            $name = 'lastName';
                            $_data = empty($account->$name) ? null : $account->$name;
                          ?>{{ Form::label($name ,Lang::get('lang.'.$name), array('class'=>$classLabel))}}
                          <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                              {{ Form::text('user['.$name.']' , $_data  ,array('placeholder'=>Lang::get('lang.'.$name), 'class'=>$classEdit))}}
                          </div>
                      </div>
                      <div class="form-group"><?php
                            $name = 'password';
                          ?>{{ Form::label($name ,Lang::get('lang.'.$name), array('class'=>$classLabel))}}
                          <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                              {{ Form::text('user['.$name.']' , null  ,array('placeholder'=>Lang::get('lang.'.$name), 'class'=>$classEdit))}}
                          </div>
                      </div>
                      <div class="form-group"><?php
                            $name = 'confirmPassword';
                          ?>{{ Form::label($name ,Lang::get('lang.'.$name), array('class'=>$classLabel))}}
                          <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                              {{ Form::text('user['.$name.']' , null  ,array('placeholder'=>Lang::get('lang.'.$name), 'class'=>$classEdit))}}
                          </div>
                      </div>
                      <div class="form-group"><?php
                            $name = 'email';
                            $_data = empty($account->$name) ? null : $account->$name;
                          ?>{{ Form::label($name ,Lang::get('lang.'.$name), array('class'=>$classLabel))}}
                          <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                              {{ Form::email('user['.$name.']' , $_data  ,array('placeholder'=>Lang::get('lang.'.$name), 'class'=>$classEdit))}}
                          </div>
                      </div>
                      <!-- read only box -->
                      <div class="form-group"><?php
                            $name = 'lastVisitDate';
                            ?>{{ Form::label($name ,Lang::get('lang.'.$name), array('class'=>$classLabel))}}
                          <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            {{ Form::text('user['.$name.']' , null  ,array('placeholder'=>Lang::get('lang.'.$name), 'class'=>$classEdit, 'disabled'=>'disabled'))}}
                          </div>
                      </div>
                      <div class="form-group"><?php
                            $name = 'registrationDate';
                            ?>{{ Form::label($name ,Lang::get('lang.'.$name), array('class'=>$classLabel))}}
                          <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            {{ Form::text('user['.$name.']' , null  ,array('placeholder'=>Lang::get('lang.'.$name), 'class'=>$classEdit))}}
                          </div>
                      </div>
                      <div class="form-group"><?php
                            $name = 'lastUpdateDate';
                            ?>{{ Form::label($name ,Lang::get('lang.'.$name), array('class'=>$classLabel))}}
                          <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            {{ Form::text('user['.$name.']' , null  ,array('placeholder'=>Lang::get('lang.'.$name), 'class'=>$classEdit))}}
                          </div>
                      </div>
                      <!-- radio box -->
                      <!--
                      <div class="form-group"><?php
                            $name = 'emails';
                          ?>{{ Form::label($name ,Lang::get('lang.'.$name), array('class'=>$classLabel))}}
                          <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 btn-group">
                              <div class="inputbox form-control">
                                  {{ Form::radio('user['.$name.']',3, null , array('class'=>'check-list switch'))}}
                                  {{ Form::radio('user['.$name.']',4, null , array('class'=>'check-list switch'))}}
                              </div>
                          </div>
                      </div>
-->
                  </div>
              </div>
              @if(!Request::ajax())
              <div>
                  <div class="btn-group pull-right">
                      {{Form::button('<span class="glyphicon glyphicon-edit"></span>&nbsp;'.Lang::get('lang.save'),           array('class'=>'btn btn-success save-skin-form',        'name'=>'task', 'value'=>'success',         'aria-haspopup'=>'true', 'aria-expanded'=>'false', 'type'=>'submit'))}}
                      {{Form::button('<span class="glyphicon glyphicon-ok"></span>&nbsp;'.Lang::get('lang.saveAndClose'),     array('class'=>'btn btn-success saveAndClose-skin-form','name'=>'task', 'value'=>'successClose',    'aria-haspopup'=>'true', 'aria-expanded'=>'false', 'type'=>'submit'))}}
                     @if(!empty($account->id))
                      {{Form::button('<span class="glyphicon glyphicon-minus"></span>&nbsp;'.Lang::get('lang.remove'),        array('class'=>'btn btn-danger remove-skin-form',       'name'=>'task', 'value'=>'remove',          'aria-haspopup'=>'true', 'aria-expanded'=>'false', 'type'=>'submit'))}}
                     @endif
                      {{Form::button('<span class="glyphicon glyphicon-remove-circle"></span>&nbsp;'.Lang::get('lang.cancel'),array('class'=>'btn btn-default cancel-skin-form',      'name'=>'task', 'value'=>'cancel',          'aria-haspopup'=>'true', 'aria-expanded'=>'false', 'type'=>'submit'))}}
                  </div>
              </div>
              @endif
              {{Form::hidden('user[id]',empty($account['id']) ? '0' : $account['id'] )}}
          {{ Form::close()}}
        </div>
    </div>
@stop

@section('style')

@stop

@section('script')
<script>
    (function($, win){
          var accountEdit = function(){
              this.init();
          };
          accountEdit.prototype = {
              // my modal Box
              modalBox : $("#boxModal"),
              modalBoxHead : null,
              modalBoxBody : null,
              modalBoxFooter : null,
              init: function(){
                  me = this;
                  me.initData();
                  me.initEvent();
              },
              initData: function(){
                  // init switch
                  $('.switch').bootstrapSwitch({'size':'mini'});
                  // init colorpicker
                  //$('.colorpickerBlock').colorpicker();
                  // init modal box
                  me.modalBoxHead   = me.modalBox.find(".modal-title");
                  me.modalBoxBody   = me.modalBox.find(".modal-body");
                  me.modalBoxFooter = me.modalBox.find(".modal-footer");
              },
              initEvent: function(){
                  $('body')
                      .on('click','.save-skin-form', me.getSave)
                      .on('click','.saveAndClose-skin-form', me.getSaveClose)
                      .on('click','.remove-skin-form', me.getRemove)
                      .on('click','.cancel-skin-form', me.getCancel)
                  ;
                  me.initPopover();
              },
              initPopover: function(){
                  $('body')
                      // init popover
                      .on('mouseover','span',function(){$(this).popover("show",{"show": 50})})
                      .on('mouseleave','span',function(){$(this).popover('hide')})
                      .on('mouseover','label',function(){$(this).popover("show",{"show": 50})})
                      .on('mouseleave','label',function(){$(this).popover('hide')})
                  ;
              },
              getSave: function(){
                console.log('get save');
                return true;
              },
              getSaveClose: function(){
                console.log('get save and close');
                return false;
              },
              getRemove: function(){
                console.log('remove');
                return false;
              },
              getCancel: function(){
                console.log('cancel');
                return false;
              }
          }
          var tmpAccountEdit = win.accountEdit = new accountEdit();
    })(jQuery, window);

</script>
@stop