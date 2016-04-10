<section class="form-horizontal">
{{ Form::open( array('id'=>'modal-form'))}}
    <div class="form-group">
        <?php $name = 'tasks_type_id';?>
        {{ Form::label($name ,Lang::get('lang.type'),['class'=>'control-label col-sm-3'])}}
        {{ Form::select($name , $allTypeEvent, empty($data[$name]) ? null : $data[$name])}}
    </div>
    <div class="form-group">
        <?php $name = 'title';?>
        {{ Form::label($name ,Lang::get('lang.'.$name),['class'=>'control-label col-sm-3'])}}
        {{ Form::text($name ,empty($data[$name]) ? null : $data[$name] , array('placeholder'=>Lang::get('lang.'.$name),'class'=>'inputbox controls col-sm-8', 'required'=>'required')) }}
    </div>
    <div class="form-group">
        <?php $name = 'description';?>
        {{ Form::label($name ,Lang::get('lang.'.$name),['class'=>'control-label col-sm-3'])}}
        {{ Form::textarea($name, empty($data[$name]) ? null : $data[$name], array('class'=>'inputbox controls col-sm-8')) }}
    </div>
    <div class="form-group">
        <?php $name = 'start';?>
        {{ Form::label($name ,Lang::get('lang.'.$name),['class'=>'control-label col-sm-3'])}}
        <div class="input-group datetimepicker col-sm-8">
            {{ Form::text($name, empty($data[$name]) ? null : $data[$name], array("class"=>"check-list form-control")) }}
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>
    </div>
    <div class="form-group">
        <?php $name = 'end';?>
        {{ Form::label($name ,Lang::get('lang.'.$name),['class'=>'control-label col-sm-3'])}}
        <div class="input-group datetimepicker col-sm-8">
            {{ Form::text($name, empty($data[$name]) ? null : $data[$name], array("class"=>"check-list form-control")) }}
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>
    </div>

    <?php $name = 'id';?>
    {{Form::hidden($name ,empty($data[$name]) ? '0' : $data[$name]) }}
{{ Form::close()}}
</section>