@extends('home')


@section('main-content')
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <a class="btn btn-default pull-right" href="/programs/create/LocalProgram"><i class="glyphicon glyphicon-plus margin-right-md"></i>&nbsp;New</a>
        </div>
        <div class="panel-body">
            {{$program}}
        </div>
    </div>

    <script>

    </script>
@endsection