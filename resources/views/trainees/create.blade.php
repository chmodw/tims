@extends('layouts.app')

@section('content-title', 'Trainees')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">New Trainee</h4>
                </div>
                <div class="card-body  p-4">
                    @include('_alert')
                    <form action="{{ route('trainees.store') }}" method="POST">
                        <div class="row">
                            {{ csrf_field() }}
                            <div class="col col-md-1">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <select class="form-control" id="title" name="title">
                                        <option value="mr">Mr.</option>
                                        <option value="ms">Ms.</option>
                                        <option value="mss">Mss.</option>
                                        <option value="mrs">Mrs.</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col col-md-4">
                                <div class="form-group">
                                    <label for="nameWithInitials">Name With Initials</label>
                                    <input type="text" value="{{old('nameWithInitials')}}" class="form-control {{$errors->has('nameWithInitials') ? 'is-invalid' : '' }}" id="nameWithInitials" name="nameWithInitials" placeholder="Name With Initials">
                                    @if ($errors->has('nameWithInitials'))
                                        <span class="invalid-feedback">{{$errors->first('nameWithInitials')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col col-md-7">
                                <div class="form-group">
                                    <label for="fullName">Full Name</label>
                                    <input type="text" value="{{old('fullName')}}" class="form-control {{$errors->has('fullName') ? 'is-invalid' : '' }}" id="fullName" name="fullName" placeholder="Full Name">
                                    @if ($errors->has('fullName'))
                                        <span class="invalid-feedback">{{$errors->first('fullName')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col col-md-4">
                                <div class="form-group">
                                    <label for="epfNo">EPF Number</label>
                                    <input type="text" value="{{old('epfNo')}}" class="form-control {{$errors->has('epfNo') ? 'is-invalid' : '' }}" id="epfNo" name="epfNo" placeholder="EPF No">
                                    @if ($errors->has('epfNo'))
                                        <span class="invalid-feedback">{{$errors->first('epfNo')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col col-md-4">
                                <div class="form-group">
                                    <label for="officeEmail">Office Email</label>
                                    <input type="email" value="{{old('officeEmail')}}" class="form-control {{$errors->has('officeEmail') ? 'is-invalid' : '' }}" id="officeEmail" name="officeEmail" placeholder="Office Email">
                                    @if ($errors->has('officeEmail'))
                                        <span class="invalid-feedback">{{$errors->first('officeEmail')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col col-md-4">
                                <div class="form-group">
                                    <label for="personalEmail">Personal Email</label>
                                    <input type="email" value="{{old('personalEmail')}}" class="form-control {{$errors->has('personalEmail') ? 'is-invalid' : '' }}" id="personalEmail" name="personalEmail" placeholder="Personal Email">
                                    @if ($errors->has('personalEmail'))
                                        <span class="invalid-feedback">{{$errors->first('personalEmail')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col col-md-4">
                                <div class="form-group">
                                    <label for="mobile">Mobile Number</label>
                                    <input type="number" value="{{old('mobile')}}" class="form-control {{$errors->has('mobile') ? 'is-invalid' : '' }}" id="mobile" name="mobile" placeholder="Mobile Number">
                                    @if ($errors->has('number'))
                                        <span class="invalid-feedback">{{$errors->first('number')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col col-md-4">
                                <div class="form-group">
                                    <label for="telephone">Telephone</label>
                                    <input type="number" value="{{old('telephone')}}" class="form-control {{$errors->has('telephone') ? 'is-invalid' : '' }}" id="telephone" name="telephone" placeholder="Telephone Number">
                                    @if ($errors->has('telephone'))
                                        <span class="invalid-feedback">{{$errors->first('telephone')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col col-md-4">
                                <div class="form-group">
                                    <label for="birthday">Birthday</label>
                                    <input type="date" value="{{old('birthday')}}" class="form-control {{$errors->has('birthday') ? 'is-invalid' : '' }}" id="birthday" name="birthday" placeholder="Birthday">
                                    @if ($errors->has('birthday'))
                                        <span class="invalid-feedback">{{$errors->first('birthday')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col col-md-4">
                                <div class="form-group">
                                    <label for="grade">Grade</label>
                                    <input type="text" value="{{old('grade')}}" class="form-control {{$errors->has('grade') ? 'is-invalid' : '' }}" id="grade" name="grade" placeholder="Grade">
                                    @if ($errors->has('grade'))
                                        <span class="invalid-feedback">{{$errors->first('grade')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col col-md-4">
                                <div class="form-group">
                                    <label for="designation">Designation</label>
                                    <select class="form-control" id="designation" name="designation">
                                        @if(isset($designations))
                                            @foreach($designations as $designation)
                                                <option value="{{$designation->id}}">{{$designation->designationName}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col col-md-4">
                                <div class="form-group">
                                    <label for="section">Section</label>
                                    <select class="form-control" id="section" name="section">
                                        @if(isset($sections))
                                            @foreach($sections as $section)
                                                <option value="{{$section->id}}">{{$section->sectionName}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col col-md-3">
                                <div class="form-group">
                                    <label for="nic">NIC Number</label>
                                    <input type="text" value="{{old('nic')}}" class="form-control {{$errors->has('nic') ? 'is-invalid' : '' }}" id="nic" name="nic" placeholder="NIC Number">
                                    @if ($errors->has('nic'))
                                        <span class="invalid-feedback">{{$errors->first('nic')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col col-md-3">
                                <div class="form-group">
                                    <label for="passportNo">Passport No</label>
                                    <input type="text" value="{{old('passportNo')}}" class="form-control {{$errors->has('passportNo') ? 'is-invalid' : '' }}" id="passportNo" name="passportNo" placeholder="Passport Number">
                                    @if ($errors->has('nic'))
                                        <span class="invalid-feedback">{{$errors->first('nic')}}</span>
                                    @endif
                                    <small id="programBrochureHelpBlock" class="form-text text-muted">
                                        A Passport is required to attend Foreign Training Programs.
                                    </small>
                                </div>
                            </div>
                            <div class="col col-md-3">
                                <div class="form-group">
                                    <label for="passportIssuedOn">Passport Issued On</label>
                                    <input type="date" value="{{old('passportIssuedOn')}}" class="form-control {{$errors->has('passportIssuedOn') ? 'is-invalid' : '' }}" id="passportIssuedOn" name="passportIssuedOn" placeholder="Passport Issued On">
                                    @if ($errors->has('passportIssuedOn'))
                                        <span class="invalid-feedback">{{$errors->first('passportIssuedOn')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col col-md-3">
                                <div class="form-group">
                                    <label for="passportExpireOn">Passport Expire On</label>
                                    <input type="date" value="{{old('passportExpireOn')}}" class="form-control {{$errors->has('passportExpireOn') ? 'is-invalid' : '' }}" id="passportExpireOn" name="passportExpireOn" placeholder="Passport Expire Date">
                                    @if ($errors->has('passportExpireOn'))
                                        <span class="invalid-feedback">{{$errors->first('passportExpireOn')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col col-md-3">
                                <div class="form-group">
                                    <label for="mealPreference">Meal Preference</label>
                                    <select class="form-control" id="mealPreference" name="mealPreference">
                                        <option value="vegan">Vegan</option>
                                        <option value="vegetarian">Vegetarian</option>
                                        <option value="carnivore">carnivore - Meat Eater</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col col-md-3">
                                <div class="form-group">
                                    <label for="natureOfEmployment">Nature Of Employment</label>
                                    <input type="text" value="{{old('natureOfEmployment')}}" class="form-control {{$errors->has('natureOfEmployment') ? 'is-invalid' : '' }}" id="natureOfEmployment" name="natureOfEmployment" placeholder="Nature Of The Employment">
                                    @if ($errors->has('natureOfEmployment'))
                                        <span class="invalid-feedback">{{$errors->first('natureOfEmployment')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col col-md-3">
                                <div class="form-group">
                                    <label for="dateOfEmployment">Date Of Employment</label>
                                    <input type="date" value="{{old('dateOfEmployment')}}" class="form-control {{$errors->has('dateOfEmployment') ? 'is-invalid' : '' }}" id="dateOfEmployment" name="dateOfEmployment" placeholder="Date of the Employment">
                                    @if ($errors->has('dateOfEmployment'))
                                        <span class="invalid-feedback">{{$errors->first('dateOfEmployment')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col col-md-3">
                                <div class="form-group">
                                    <label for="dateOfAppointment">Date Of Appointment</label>
                                    <input type="date" value="{{old('dateOfAppointment')}}" class="form-control {{$errors->has('passportExpireOn') ? 'is-invalid' : '' }}" id="dateOfAppointment" name="dateOfAppointment" placeholder="Date Of The Appointment">
                                    @if ($errors->has('dateOfAppointment'))
                                        <span class="invalid-feedback">{{$errors->first('dateOfAppointment')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col col-md-12">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary form-submit-btn" value="Save" name="submit">
                                    <a class="btn btn-default mr-2 form-cancel-link" href="{{url('/programs/foreign')}}">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
