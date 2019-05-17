@extends('home')

@section('main-content')

    @include('layouts._alert')

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <p class="" style="">User Role Manager</p>
            @can('role-create')
                <a class="btn btn-success pull-right" style="margin-right:8px;" href="{{ route('roles.create') }}"><i class="glyphicon glyphicon-plus margin-right-sm"></i>&nbsp;New Role</a>
            @endcan
        </div>
        <div class="panel-body">

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    {{ $role->name }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Permissions:</strong>
                    @if(!empty($rolePermissions))
                        @foreach($rolePermissions as $v)
                            <label class="label label-success">{{ $v->name }},</label>
                        @endforeach
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection