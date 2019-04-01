<table border="0" class="table table-striped">
    <thead class="">
    <tr>
        <th class="" scope="col">#</th>
        <th class="" scope="col">Title</th>
        <th class="" scope="col">Application Closing Date</th>
        <th class="" scope="col">Start Date</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($programs as $i => $program)
        <tr>
            <td scope="row">{{isset($_GET['page']) ? (16 * $_GET['page']) - (16-$i) + 1 : $i+1}}</td>
            <td><a href="/programs/local/{{$program->programId}}">{{$program->title}}</a></td>
            <td>{{$program->applicationClosingDate}}</td>
            <td>{{$program->startingDate}}</td>
            <td><a href="{{url($rootLink.$program->programId)}}">
                    <i class="fa fa-eye" style="color: blue" aria-hidden="true"></i>
                </a>
            </td>
            <td>
                @if(strtotime($program->applicationClosingDate) > strtotime('now'))
                    <a href="{{url($rootLink.$program->programId)}}">
                        <i class="fa fa-plus" style="color: green;" aria-hidden="true"></i>
                    </a>
                @endif
            </td>
            <td>
                @if(strtotime($program->applicationClosingDate) > strtotime('now'))
                    <a href="{{url($rootLink.'edit/'.$program->programId)}}">
                        <i class="fa fa-pencil" style="color: orange;" aria-hidden="true"></i>
                    </a>
                @endif
            </td>
            <td>
                @if(strtotime($program->applicationClosingDate) > strtotime('now'))
                    <a href="{{url($rootLink.$program->programId)}}">
                        <i class="fa fa-trash " style="color: red" aria-hidden="true"></i>
                    </a>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>