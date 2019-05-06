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
                            <td scope="row">{{isset($_GET['page']) ? (16 * $_GET['page']) - (16-$i) + 1 : $i+1}}</td>
                            <td>{{$template->name}}</td>
                            <td>{{$template->program_type}}</td>
                            <td>{{$template->created_at}}</td>
                            <td>{{$template->created_by}}</td>
                            <td class="action-btn-container">
                                <a href="{{url('templatemanager/'.$template->file_name)}}" class="margin-right-sm"><i class="glyphicon glyphicon-download-alt"></i></a>
                                <a href="{{url('templatemanager/'.$template->file_name.'/edit')}}" style="display: inline-block; color: orange;"class="margin-right-sm"><i class="glyphicon glyphicon-edit"></i></a>
                                <form style="display: inline-block;" method="POST" action="{{ route('templatemanager.destroy', $template->id) }}">
                                    {{ csrf_field() }}
                                    {{method_field('DELETE')}}
                                    <button  class='btn btn-link' style="display: inline-block; color: red; padding: 0; margin-top: -8px;" onclick="return confirm('Are you sure?')"><i class="glyphicon glyphicon-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="page-links">
                {{ $templates->links() }}
            </div>

            <div class="panel panel-info ref-list">
                <div class="panel-heading">Document Templates Reference Lists</div>
                <div class="panel-body">
                    <div class="col-md-3">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Local Program Fields
                            </div>
                            <div class="panel-body">
                                @foreach($local_programs_cols as $cols)
                                    {{'${'.$cols.'}'}}
                                    <br>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Foreign Program Fields
                            </div>
                            <div class="panel-body">
                                @foreach($foreign_programs_cols as $cols)
                                    {{'${'.$cols.'}'}}
                                    <br>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Post Grad. Program Fields
                            </div>
                            <div class="panel-body">
                                @foreach($postgrad_programs_cols as $cols)
                                    {{'${'.$cols.'}'}}
                                    <br>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                In-House Program Fields
                            </div>
                            <div class="panel-body">
                                @foreach($inhouse_programs_cols as $cols)
                                    {{'${'.$cols.'}'}}
                                    <br>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection