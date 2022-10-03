@extends('layout.common_layout')

@section('title')
    <h1 class="section-title w-100 text-center mt-5 pb-5">Employee List</h1>
    <hr>
    <br><br>
@endsection

@section('content')
<div class="d-flex row justify-content-center">
    @foreach ($employees as $employee)
    <div class="col-2 mb-5 card shadow-sm p-0 mx-3">
        <img src="/{{$employee->userDetail->picture}}" class="rounded-top w-100 h-100" >
        <h4 class="alert-primary w-100 text-center p-3">{{ $employee->userDetail->fname }} {{ $employee->userDetail->mname }} {{ $employee->userDetail->lname }}</h4>
        <div class="row w-100 mx-auto h-100">
            <div class="col alert-light text-center p-3">
                <h5>Employee ID</h5>
                #{{ $employee->employee_id }}
            </div>
            <div class="col alert-light text-center p-3">
                <h5>Position</h5>
                {{ $employee->position }}
            </div>
            <div class="col alert-light text-center p-3">
                <h5>Department</h5>
                {{ $employee->department }}
            </div>
        </div>
        <div class="row w-100 mx-auto">
            <div class="col p-0">
                <a href="/payroll/employee/profile/{{$employee->login_id}}" class="btn btn-outline-primary w-100 rounded-0 rounded-bottom"><i class="bi bi-person-square h1"></i><br>Profile</a>
            </div>
            <div class="col p-0">
                <a href="/message/ {{$employee->userDetail->fname}} {{$employee->userDetail->mname}} {{$employee->userDetail->lname}}" class="btn btn-outline-warning rounded-0 w-100 rounded-bottom"><i class="bi bi-chat h1"></i><br>Message</a>
            </div>
        </div>
    </div>

    @endforeach
</div>
@endsection


