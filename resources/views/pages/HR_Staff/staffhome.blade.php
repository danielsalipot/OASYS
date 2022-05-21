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
                <div class="row card shadow-sm p-4">
                    <h3>Applicants Overview</h3>
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="col"></th>
                            <th class="col">Employee Name</th>
                            <th class="col">Applying for</th>
                            <th class="col">Education</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($applicants as $applicant)
                                <tr>
                                    <td class="col"><img src="/{{$applicant->picture}}" height='40px' width='40px' class='rounded-circle'></td>
                                    <td class="col">{{ $applicant->fname }} {{ $applicant->mname }} {{ $applicant->lname }}</td>
                                    <td class="col">{{ $applicant->Applyingfor }}</td>
                                    <td class="col">{{ $applicant->educ }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $applicants->links() }}
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
                <div class="card w-100 text-center" style="overflow-y: scroll; height:562px;">
                    <h5 class="w-100 alert alert-primary mb-0">Interviews Today</h5>
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
