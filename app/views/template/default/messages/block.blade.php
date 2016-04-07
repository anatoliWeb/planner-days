<?php
   if (Session::has('messages.errors')){
           $messages['errors'] = Session::get('messages.errors');
       }
       if (Session::has('messages.info')){
           $messages['info'] = Session::get('messages.info');
       }

?>

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
    <div class="alert alert-danger alert-info">
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

