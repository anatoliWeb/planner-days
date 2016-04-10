@extends('template.default.index')

@section('controller')
    <div class="row">
        <h2>{{Lang::get('lang.account')}}</h2>
        <div>
            <div class="table-responsive">
                <table class="table list-accounts">
                    <tr>
                        <td>{{Lang::get('Lang.id')}}</td>
                        <td>{{$account->id}}</td>
                    </tr>
                    <tr>
                        <td>{{Lang::get('Lang.login')}}</td>
                        <td>{{$account->login}}</td>
                    </tr>
                    <tr>
                        <td>{{Lang::get('Lang.email')}}</td>
                        <td>{{$account->email}}</td>
                    </tr>
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