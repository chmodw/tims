@extends('home')

@section('main-content')

    @include('layouts._alert')

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <p class="" style="">Template Manager</p>
            <a class="btn btn-primary pull-right" style="margin-right:8px;" href="{{url('templatemanager/create')}}"><i class="glyphicon glyphicon-plus margin-right-sm"></i>&nbsp;New</a>
        </div>
        <div class="panel-body">

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th style="width: 5%;">#</th>
                        <th style="width: 37%;">Name</th>
                        <th style="width: 18%;">Program Type</th>
                        <th style="width: 15%;">Uploaded On</th>
                        <th style="width: 15%;">Uploaded By</th>
                        <th style="width: 10%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($templates as $i => $template)
                        <tr>
                            <td scope="row">{{isset($_GET['page']) ? (20 * $_GET['page']) - (20-$i) + 1 : $i+1}}</td>
                            <td>{{$template->name}}</td>
                            <td>{{$template->program_type}}</td>
                            <td>{{$template->created_at}}</td>
                            <td>{{$template->created_by}}</td>
                            <td class="action-btn-container">
                                <a href="{{url('templatemanager/'.$template->file_name)}}" class="margin-right-sm"><i class="glyphicon glyphicon-download-alt"></i></a>
                                <a href="{{url('templatemanager/'.$template->file_name.'/edit')}}" style="display: inline-block; color: orange;"class="margin-right-sm"><i class="glyphicon glyphicon-edit"></i></a>
                                <form style="display: inline-block;" method="POST" action="{{ route('templatemanager.destroy', $template->file_name) }}">
                                    {{ csrf_field() }}
                                    {{method_field('DELETE')}}
                                    <button  class='btn btn-link' style="display: inline-block; color: red; padding: 0; margin-top: -8px;" onclick="return confirm('Are you sure?')"><i class="glyphicon glyphicon-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $templates->links() }}
        </div>
    </div>

@endsection