@extends('template.default.index')

@section('controller')
<div class="row">
    <h2>{{Lang::get('lang.statistic')}}</h2>
    <div><hr/></div>
    <div>
        <div class="table-responsive">
            <table class="table list-accounts">
                <thead>
                    <tr>
                        <th>{{Lang::get('Lang.account')}}
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $accaunt_id=>$rows)
                        <tr>
                            <td>{{$accountData[$accaunt_id]->login}}</td>
                            <td>
                                <table class="table list-accounts">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>{{Lang::get('Lang.total')}}</th>
                                            <th>{{Lang::get('Lang.used')}}</th>
                                            <th>{{Lang::get('Lang.left')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($rows as $type_id=>$row)
                                            <tr>
                                                <td>{{Lang::get('lang.'.$taskType[$type_id]->title)}}</td>
                                                <td>{{$row['total']}}</td>
                                                <td>{{$row['used']}}</td>
                                                <td>{{$row['left']}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

@section('style')

@stop

@section('script')
<script>

</script>
@stop