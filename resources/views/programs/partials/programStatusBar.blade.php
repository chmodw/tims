{{--<div class="col-lg-3">--}}
    <ul class="list-group program-status">
        <li class="list-group-item active">
            <span class="badge">{{$program_status['total_count']}}</span>Trainee Count
        </li>
        @foreach($program_status['count_by_unit'] as $key => $sub_count)
            <li class="list-group-item">
                <span class="badge">{{$sub_count}}</span>{{$key}}
            </li>
        @endforeach
    </ul>
{{--</div>--}}