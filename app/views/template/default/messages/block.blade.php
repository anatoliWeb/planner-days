<?php

   if (Session::has('messages')){

        $sMessage = Session::get('messages');

        if(!empty($sMessage['errors'])){
            if(empty($messages['errors'])){
                 $messages['errors'] = $sMessage['errors'];
            }else{
                array_merge($messages['errors'], $sMessage['errors']);
            }
        }

        if(!empty($sMessage['info'])){
            if(empty($messages['info'])){
                 $messages['info'] = $sMessage['info'];
            }else{
                array_merge($messages['info'], $sMessage['info']);
            }
        }
        Session::forget('messages');
   }
?>
@if(!empty($messages['errors']) || !empty($messages['info']))
<div class="alert alert-messages">
    @if(!empty($messages['errors']))
        <div class="alert alert-danger alert-error">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            @if(is_array($messages['errors']))
                @foreach($messages['errors'] as $message)
                    <p>
                       <strong>{{Lang::get('lang.Error')}}!</strong> {{array_shift($message)}}
                    </p>
                @endforeach
            @else
                <p>
                   <strong>{{Lang::get('lang.Error')}}!</strong> {{$messages['errors']}}
                </p>
            @endif
        </div>
    @endif

    @if(!empty($messages['info']))
        <div class="alert alert-info alert-info">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            @if(is_array($messages['info']))
                @foreach($messages['info'] as $message)
                    <p>
                       <strong>{{Lang::get('lang.Info')}}!</strong> {{array_shift($message)}}
                    </p>
                @endforeach
            @else
                <p>
                   <strong>{{Lang::get('lang.Info')}}!</strong> {{$messages['info']}}
                </p>
            @endif
        </div>
    @endif
</div>
@endif

