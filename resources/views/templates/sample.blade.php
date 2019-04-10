<style>
    .date{
        float: right;
    }

    .title{
        font-size: 14px;
        font-family: "Times New Roman";
        text-decoration: underline;
    }
    .date, .to, .first, .second, .thrid, .manger-name, .manger-posi{
        font-size: 13px;
        font-family: "Times New Roman";
    }

    .manger-posi{
        display: block;
    }

    p{
        text-align: justify;
    }

    .thead{
        font-size: 13px;
        font-family: "Times New Roman";
        text-align: center;
        font-weight: bold;
    }

    .manger-name{
        font-family: "Times New Roman";
        line-height: 16px;
    }

    td,th{
        font-size: 12px;
        font-family: "Times New Roman";
    }

    .text-center{
        text-align: center;
    }
</style>

<p class="date">Date : {{$date}}</p>

<p class="to">General Manager</p>

<h1 class="title">{{$program[0]->program_title}}</h1>

<p class="first">{{$program[0]->organised_by}} has announced A Training Program which will be held on {{date('Y-m-d',strtotime($program[0]->start_date))}} at {{$program[0]->venue}}.</p>

<p class="second">The following offices have applied to attend with the recommendation of respective AGMs</p>

<table border="1">
    <thead>
    <tr>
        <th class="thead" width="5%">No</th>
        <th class="thead" width="35%">Name</th>
        <th class="thead" width="20%">Designation</th>
        <th class="thead" width="20%">Nature of Appointment</th>
        <th class="thead" width="20%">Recommendation</th>
    </tr>
    </thead>
    <tbody>
    @foreach($trainees as $key => $trainee)
        <tr>
            <td class="text-center" width="5%">{{$key+1}}.</td>
            <td width="35%">{{$trainee['data'][0]['NameWithInitial']}}</td>
            <td width="20%" class="text-center">{{$trainee['DesignationName']}}</td>
            <td width="20%" class="text-center">Permanent</td>
            <td width="20%" class="text-center">{{$trainee['recommendation'][0]['recommendation']}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<p class="thrid">Our approval is sought for the above nominations and programme fee Rs. {{$program[0]->member_fee}} (per member), Rs. {{$program[0]->non_member_fee}} (per non-member), Rs. {{$program[0]->student_fee}} (per student Memberships) Per participant should be paid by the respective AGM Section
</p>
<div class="spacer">
    &nbsp;
</div>
<p class="manger-name">Eng. L C K Karunarathne<br>Training Manager</p>

