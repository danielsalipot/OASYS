@extends('layout.admin_app')
@section('content')
<div class="row mt-4">
    <div class="col-1" style="width:6vw"></div>
    <div class="col">
        <div class="container w-100 p-2">
            <h1 class="section-title mt-2 pb-1">Attendance</h1>

            <div class="row text-primary pt-2">
                <div class="col m-3 border border-3 border-primary section-title">
                    <h1 class=" display-3 ">300</h3>
                    <h3>Total Employees</h2>
                </div>
                <div class="col m-3 border border-3 border-primary section-title">
                    <h1 class="display-3">78%</h3>
                    <h3>On time percentage</h3>
                </div>
                <div class="col m-3 border border-3 border-primary section-title ">
                    <h1 class="display-3">234</h1>
                    <h3>Total on time Employee</h3>
                </div>
                <div class="col m-3 border border-3 border-primary section-title">
                    <h1 class="display-3">66</h1>
                    <h3>Total Late Employee</h3>
                </div>
            </div>
            <div class="row pt-2">
                <div class="col text-primary">
                    <h4>Attendance Overview</h4>
                </div>
                <div class="col-2 border border-dark m-auto text-center p-1">
                    <small>Monday, March 15, 2022</small>
                </div>
            </div>
@endsection
