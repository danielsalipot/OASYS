@extends('layout.staff_app')

    @section('content')
        <div class="row">
            <div class="col card shadow-sm m-3">
                <div class="row"><h4 class="section-title mt-2 pb-1">{{ $app_count }}</h4></div>
                <hr>
                <div class="row px-2 pb-2"><h3 class="text-dark">Total Applicants</h3></div>
            </div>
            <div class="col card shadow-sm m-3">
                <div class="row"><h4 class="section-title mt-2 pb-1">{{ $on_count }}</h4></div>
                <hr>
                <div class="row px-2 pb-2"><h3 class="text-dark">Total Onboardees</h3></div>
            </div>
            <div class="col card shadow-sm m-3">
                <div class="row"><h4 class="section-title mt-2 pb-1">{{ $reg_count }}</h4></div>
                <hr>
                <div class="row px-2 pb-2"><h3 class="text-dark">Total Regulars</h3></div>
            </div>
            <div class="col card shadow-sm m-3">
                <div class="row"><h4 class="section-title mt-2 pb-1">{{ $off_count }}</h4></div>
                <hr>
                <div class="row px-2 pb-2"><h3 class="text-dark">Total Offboardees</h3></div>
            </div>
        </div>

        <div class="row mx-2">
            <div class="col-9">
                <div class="card p-3">
                    <h3 class="p-3">Applicants Overview</h3>
                    <div class="d-flex" style="overflow-x: scroll">
                        @foreach ($applicants as $applicant)
                            <div class="card col-5 mx-3">
                                <div class="row text-center">
                                    <div class="col-4">
                                        <img src="/{{$applicant->picture}}" class='rounded h-100 w-100'>
                                    </div>
                                    <div class="col p-2">
                                        <h3 class="mb-3">{{ $applicant->fname }} {{ $applicant->mname }} {{ $applicant->lname }}</h3>
                                        <div class="row">
                                            <div class="col-5">
                                                <h6 class="text-secondary">Applying For</h6>
                                                <h4 class="mb-3">{{ $applicant->Applyingfor }}</h4>
                                                <h6 class="text-secondary">Contact Number</h6>
                                                {{ $applicant->cnum }}
                                            </div>
                                            <div class="col">
                                                <h6 class="text-secondary">Education</h6>
                                                <h4 class="mb-3">{{ $applicant->educ }}</h4>
                                                <h6 class="text-secondary">Email</h6>
                                                {{ $applicant->email }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h6 class="alert-primary w-100 m-0 p-3">Resume</h6>
                                <div class="row p-0">
                                    <embed src="/{{$applicant->resume}}" height="600px"/>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="row">
                    <a href='/staff/department' class="btn col card shadow-sm m-2 p-4 py-5 text-center">
                        <h3><i class="bi bi-building"></i></h3>
                        <h6>Manage Departments</h6>
                    </a>
                    <a href='/staff/schedules' class="btn col card shadow-sm m-2 p-4 py-5 text-center">
                        <h3><i class="bi bi-calendar"></i></h3>
                        <h6>Manage Schedules</h6>
                    </a>
                    <a href='/staff/position'  class="btn col card shadow-sm m-2 p-4 py-5 text-center">
                        <h3><i class="bi bi-person-badge"></i></h3>
                        <h6>Manage Positions</h6>
                    </a>
                    <a href='/staff/termination'  class="btn col card shadow-sm m-2 p-4 py-5 text-center">
                        <h3><i class="bi bi-slash-circle-fill"></i></h3>
                        <h6>Manage Termination</h6>
                    </a>
                </div>
            </div>
            <div class="col">
                <h5 class="w-100 alert alert-primary mb-0 rounded-0 rounded-top">Interviews Today</h5>
                <div class="card w-100 text-center rounded-0 rounded-bottom h-75" style="overflow-y: scroll;">
                    @if(!count($interviews))
                        <h6 class="p-3 alert-secondary m-1 py-5 shadow-sm rounded">No interview Pending</h6>
                    @endif
                    @foreach ($interviews as $data)
                        <a href="/staff/interview" class="card alert alert-success m-0 shadow-sm p-3 text-decoration-none">
                            <div class="row w-100 h-100">
                                <div class="col-3">
                                    <img src="/{{$data->picture}}" alt="" srcset="" height="60px" width="60px">
                                </div>
                                <div class="col">
                                    <h4>{{$data->fname}} {{$data->mname}} {{$data->lname}}</h4>
                                    Schedule
                                    <h5>{{$data->interview_schedule}}</h5>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endsection
