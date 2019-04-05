{{--search employees--}}
{{--add employees--}}
{{--show program results--}}

@extends('layouts.main')

@section('content-title', 'Programs')

@section('content')
    <div class="card mb-3">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title">{{$program[0]->title}}</h4>
        </div>
        <div class="card-body  p-4">
            {{--Messages--}}
            @include('layouts._alert')

{{--            <img src="storage/7edfea74f45405fb147f478bd6b08d68.jpg{{str_replace("public", "storage", url($program[0]->brochureUrl))}}" alt="" class="img-thumbnail">--}}


            {{--            {"id":1,"programId":"d55edd46468bae657b1f5278b72cab3d","title":"Optio totam odio quo","organisedBy":"Voluptas autem architecto labore","targetGroup":"Amet eius nobis asperiores corrupti ullam quae ea et eveniet","startDate":"2021-02-11 12:52:55.000","endDate":"2021-07-06 12:37:35.000","applicationClosingDateTime":"2019-05-19 19:49:35.000","nonMemberFee":"1314.0","memberFee":"1397.0","studentFee":"1250.0","brochureUrl":"public\/brochures\/bd141fbc4195ca206c1fc474ad23410a.jpg","createdBy":"vonrueden.myra@example.net","updatedBy":null,"created_at":"2019-04-04 21:29:53.000","updated_at":"2019-04-04 21:29:53.000--}}



            {{$program[0]}}

            <div class="row">
                <div class="col col-md-6">
                    <img src="https://www.visme.co/wp-content/uploads/2018/12/technology-brochure-template-visme.jpg" alt="" class="img-thumbnail">
                </div>

                {{ucfirst(preg_replace('/(?<! )[A-Z]/', ' $0', 'helloWorld'))}}
            </div>

        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            Add Trainee
        </div>
        <div class="card-body">
            <form class="form-inline"  action="{{ route('trainees.show', 'id') }}" method="GET">
                {{ csrf_field() }}
                <div class="form-group mx-sm-3 mb-3">
                    <label for="epfNo" class="mr-5">EPF No:</label>
                    <input type="text" class="form-control" id="epfNo" name="epfNo" placeholder="" required>
                </div>
                <button type="submit" class="btn btn-primary mb-3">Find</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Results
        </div>
        <div class="card-body">
            @if(session('trainee'))

                    {{session('trainee')}}
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Designation</th>
                            <th scope="col">Experience</th>
                            <th scope="col">Handle</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">{{session('trainee')[0]['NameWithInitial']}}</th>
                            <td>{{session('trainee')[0]['designationName']}}</td>
                            <td>{{new DateTime(session('trainee')[0]['DateOfAppointment']))->diff(new DateTime(strftime('today')))->m}}</td>
                            <td><a href="" class="btn btn-primary">Add</a></td>
                        </tr>
                        </tbody>
                    </table>
            @else
                @if(session('trainee') == null)
                    <div class="alert alert-warning" role="alert">
                        No results !
                    </div>
                @endif
            @endif
        </div>
    </div>


@endsection
