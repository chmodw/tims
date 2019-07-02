@extends('home')

@section('main-content')

    @include('layouts._alert')

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <div class="btn-container">
{{--                <a href="{{route($route.'.show', $program_id)}}" class="btn btn-default pull-right margin-right-sm"><i class="glyphicon glyphicon-arrow-left margin-right-sm"></i>Back</a>--}}
            </div>
        </div>
        <div class="panel-body">

            <table class="table table-bordered">
                <thead>
                    <th>Section</th>
                    <th>Trainee</th>
                    <th>Total</th>
                </thead>
                <tbody>

                </tbody>
            </table>

        </div>
    </div>



{{--        Program Name--}}
{{--        Section Name--}}
{{--        total trainee count--}}
{{--        total payable amount--}}
{{--        amount paied--}}
{{--        actions--}}


    <script>

    </script>
@endsection