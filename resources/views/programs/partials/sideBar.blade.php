<div class="col-lg-3">

    <div class="program-brochure">
        <a href="/storage/brochures/{{$program->brochure_url}}" target="_blank"><img src="/storage/brochures/{{$program->brochure_url}}" class="img-thumbnail" alt="program brochure"></a>
    </div>

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
</div>