<section class="row">
    <div class="col-sm-12">
        <p class="form-group">{{$rows['description']}}</p>
        <hr/>
        <div class="form-group">
            <div class="col-sm-3">{{Lang::get('lang.start')}}</div>
            <div class="col-sm-8">{{date('F d, Y H:i:s', strtotime($rows['start']))}}</div>
        </div>
        <div class="form-group">
            <div class="col-sm-3">{{Lang::get('lang.end')}}</div>
            <div class="col-sm-8">{{date('F d, Y H:i:s', strtotime($rows['end']))}}</div>
        </div>
    </div>
</section>