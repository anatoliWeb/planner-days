@extends('template.default.index')

@section('controller')
    <div class="row">
        <h2>{{Lang::get('lang.account')}}</h2>
        <div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                list menu
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <div class="table-responsive">
                  <table class="table list-accounts">
                      <thead>
                        <tr>
                            <th>{{Lang::get('lang.name')}}</th>
                            <th class="text-center">{{Lang::get('lang.active')}}</th>
                            <th>{{Lang::get('lang.userGroup')}}</th>
                            <th>{{Lang::get('lang.email')}}</th>
                            {{--<th>{{Lang::get('lang.lastVisitDate')}}</th>--}}
                            <th>{{Lang::get('lang.registrationDate')}}</th>
                            <th></th>
                            <th>{{Lang::get('lang.id')}}</th>
                        </tr>
                      </thead>
                      <tbody>
                       @if(!empty($rows))
                            @foreach($rows as $row)
                            <tr data-id="{{$row->id}}" class="">
                                <td>{{$row->firstName}}</td>
                                <td class="text-center">{{Form::checkbox('ifram', true, $row->active, array('class'=>'switch','data-off-color'=>'danger','data-on-color'=>'success'))}}</td>
                                <td>Default</td>
                                <td>{{$row->email}}</td>
                                <td></td>
                                {{--<td></td>--}}
                                <td>
                                    <div class="btn-group text-right">
                                        <a href="#" class="" ><span class="glyphicon glyphicon-info-sign info" data-content="{{Lang::get("lang.info")}}" data-placement="top"></span></a>
                                        <a href="#" class="" ><span class="glyphicon glyphicon-edit edit" data-content="{{Lang::get("lang.edit")}}" data-placement="top"></span></a>
                                        <a href="#" class="" ><span class="glyphicon glyphicon-remove-circle remove" data-content="{{Lang::get("lang.remove")}}" data-placement="top"></span></a>
                                    </div>
                                </td>
                                <td>{{$row->id}}</td>
                            </tr>
                            @endforeach
                       @endif
                      </tbody>
                  </table>
                </div>
                <div>
                    <div class="btn-group pull-right">
                        <a href="" class="btn btn-default">{{Lang::get('lang.newUser')}}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-8">
            <h3>{{Lang::get('lang.userInfo')}}</h3>
            <ul>
            @foreach($account->toArray() as $name=>$row)
                <li> {{$name}} - {{$row}} </li>
            @endforeach
            </ul>
        </div>
    </div>
@stop

@section('style')

@stop

@section('script')

<script>
    (function($, win){
        var accountIndex = function(){
            this.init();
        };
        accountIndex.prototype = {
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
                me.modalBoxHead = me.modalBox.find(".modal-title");
                me.modalBoxBody = me.modalBox.find(".modal-body");
                me.modalBoxFooter = me.modalBox.find(".modal-footer");
            },
            initEvent: function(){
                $('.list-accounts')
                    .on('click','.edit', me.getEdit)
                    .on('click','.info', me.getInfo)
                    .on('click','.romove', me.getRemove)
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
            getEdit: function(){
                var t = $(this),block = $(t.parents().get(3)),id = block.data('id');


                $.ajax({ url: '{{action('Account_IndexController@getEdit')}}/'+id, type: "get" })
                    .done(function(json){
                        console.log(json);
                        if(json.success){
                            console.log('modal box');
                            me.modalBoxHead.text('Edit account');
                            me.modalBoxBody.html(json.content);
                            me.modalBox.modal('show');
                        }

                    }).fail(function(jqXHR, textStatus){
                       block.css('opacity','1');
                       console.log("Request failed: " + textStatus);
                    });
                // write data to modal box


            },
            getInfo: function(){
                var t = $(this),id = $(t.parents().get(3)).data('id');
                alert('info');
            },
            getRemove: function(){
                var t = $(this),id = $(t.parents().get(3)).data('id');
                if(confirm("Are you sure you want to remove this?")){

                    block.css('opacity','0.3');
                    $.ajax({ url: '/ifram/delete/'+id, type: "post" })
                        .done(function(json){
                            console.log(json);
                            if(json.success){
                                block.hide('slow',function(){block.remove();});
                            }else{
                                block.css('opacity','1');
                            }
                        }).fail(function(jqXHR, textStatus){
                             block.css('opacity','1');
                             console.log("Request failed: " + textStatus);
                        });
                }else{
                    console.log('not delete');
                }
                  return false;
            }
        }

        var tmpAccountIndex = win.accountIndex = new accountIndex();
    })(jQuery, window);
</script>
@stop