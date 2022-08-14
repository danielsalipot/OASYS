@extends('layout.admin_app')
    @section('content')
        @include('inc.chart')
        <h1 class="section-title mt-5 pb-2">Performance Assessment History</h1>

        <div class="row">
            <div class="col-3 p-0 text-center me-4">
                <a href="/admin/performance" class="btn btn-lg btn-outline-danger p-4 rounded-0 w-100">Select new Employee</a>
                <div class="card mt-5 shadow-lg">
                    <h1 class="display-6 alert-primary rounded-0 rounded-top p-4 m-0">Employee Details</h1>
                    <img src="/{{$employee->userDetail->picture}}" class="mx-auto" style="height: 100%; width:100%;">

                    <br>

                    <h2 class="h1">{{$employee->userDetail->fname}} {{$employee->userDetail->mname}} {{$employee->userDetail->lname}}</h2>
                    <div class="row p-1 mx-4">
                        <div class="col text-end"><h5>Employee ID:</h5></div>
                        <div class="col text-center" id="employee_id_txt">{{ $employee->employee_id }}</div>
                    </div>
                    <div class="row p-1 mx-4">
                        <div class="col text-end"><h5>Employee Position: </h5></div>
                        <div class="col text-center">{{ $employee->position }}</div>
                    </div>
                    <div class="row p-1 mx-4">
                        <div class="col text-end"><h5>Employmee Department: </h5></div>
                        <div class="col text-center">{{ $employee->department }}</div>
                    </div>
                    <a href="/admin/performance/{{$employee->employee_id}}" class="btn btn-lg btn-outline-success rounded-0 rounded-bottom p-4 mt-5 w-100">Manage Assessment</a>
                </div>
            </div>

            <div class="col p-0 border rounded shadow-sm" style="height: 690px; overflow-y:scroll">
                <div class="row">
                    <div class="col-1">
                        <ul class="nav nav-pills p-0 card shadow-sm" style="height:100%; width:90px; overflow-y:scroll">
                            <li><h4 class="p-2 m-0 text-center alert-light mb-2">Year</h4></li>
                            @foreach ($employee->assessments as $key => $year)
                                @if (!$key)
                                    <li class="active mx-2 my-1"><a data-toggle="tab" class="h5 text-decoration-none m-0 " href="#pill_{{$year->year}}">{{$year->year}}</a></li>
                                @else
                                    <li class="mx-2 my-1"><a data-toggle="tab" class="h5 text-decoration-none m-0 " href="#pill_{{$year->year}}">{{$year->year}}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </div>

                    <div class="col">
                        <div class="tab-content">
                            @foreach ($employee->assessments as $key => $year)
                            @if (!$key)
                                <div id="pill_{{$year->year}}"class="tab-pane in active shadow-sm m-4 p-0">
                            @else
                                <div id="pill_{{$year->year}}"class="tab-pane shadow-sm m-4 p-0">
                            @endif
                                <h1 class="w-100 p-3 alert-primary text-center border-bottom">{{ $year->year }}</h1>

                                <ul class="nav nav-tabs">
                                @foreach ($year->quarter as $key => $quarter)
                                    @if (!$key)
                                        <li class="active"><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#{{$year->year}}_{{$quarter->qrt_display}}">{{$quarter->qrt_display}} Quarter</a></li>
                                    @else
                                        <li><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#{{$year->year}}_{{$quarter->qrt_display}}">{{$quarter->qrt_display}} Quarter</a></li>
                                    @endif
                                @endforeach
                                </ul>

                                <div class="tab-content">
                                @foreach ($year->quarter as $key => $quarter)
                                @if (!$key)
                                    <div id="{{$year->year}}_{{$quarter->qrt_display}}" class="tab-pane in active">
                                @else
                                    <div id="{{$year->year}}_{{$quarter->qrt_display}}" class="tab-pane">
                                @endif
                                    <div class="card m-1 shadow-sm">
                                        <h4 class="w-100 p-2 text-center alert-light border-bottom">{{ $quarter->qrt_display }} Quarter</h4>

                                        <div class="d-flex w-100 p-0 m-0 justify-content-between">
                                            @foreach ($quarter->assessments as $assessment)
                                            <div class="card w-25 m-1 p-0">
                                                <h4 class="w-100 p-2 text-center m-0 alert-success border-bottom">{{ ucfirst($assessment->assessment_type) }}</h4>
                                                <div class="row alert-warning py-2 pb-1 px-0 w-100 mx-auto">
                                                    <div class="col-3 text-center pt-2 mt-1"><h5>Score:</h5></div>
                                                    <div class="col p-0"> <input class="form-control text-center w-100" value="{{ $assessment->score }}" readonly></div>
                                                </div>
                                                <textarea class="form-control" readonly cols="30" rows="10">{{ $assessment->feedback }}</textarea>
                                            </div>
                                            @endforeach
                                        </div>
                                        <h6 class="p-2 w-100 m-0 text-end alert-light">Date of Assessment: {{ $quarter->assessments[0]->start_date }} - {{ $quarter->assessments[0]->end_date }}</h6>
                                    </div>
                                </div>

                                @endforeach
                                </div>
                                <div class="card m-1">
                                    <h1 class="w-100 rounded-top alert-secondary p-3">Summary of {{$year->year}}</h1>
                                    <div class="container w-75 mx-auto">
                                        <canvas id="chart_{{$year->year}}" width="1" height="1"></canvas>
                                    </div>

                                </div>

                                {!! Form::hidden('', json_encode($year), ['id'=>'json_'. $year->year]) !!}
                            </div>

                                <script>
                                var ctx = document.getElementById('chart_{{$year->year}}').getContext('2d');
                                var datax = JSON.parse(document.getElementById('json_{{$year->year}}').value)
                                var data_set_var = [];

                                datax.quarter.forEach(element => {
                                    var color_string = random(0,255) + ',' + random(0,255) + ',' + random(0,255)
                                    var temp = []
                                    element.assessments.forEach(assessment => {
                                        temp.push(assessment.score)
                                    })

                                    data_set_var.push({
                                        label: `${element.qrt_display} Quarter`,
                                        data: temp,
                                        fill: true,
                                        backgroundColor: `rgba(${color_string}, 0.2)`,
                                        borderColor: `rgb(${color_string})`,
                                        pointBackgroundColor: `rgb(${color_string})`,
                                        pointBorderColor: '#fff',
                                        pointHoverBackgroundColor: '#fff',
                                        pointHoverBorderColor: `rgb(${color_string})`
                                    })
                                });

                                var myChart = new Chart(ctx, {
                                    type: 'radar',
                                    data: {
                                        labels: [
                                            'Attendance',
                                            'Performance',
                                            'Character',
                                            'Cooperation'
                                        ],
                                        datasets: data_set_var,
                                    },
                                    options: {
                                        elements: {
                                            line: {
                                                borderWidth: 3
                                            }
                                        },
                                        scales: {
                                            r: {
                                                angleLines: {
                                                    display: false
                                                },
                                                suggestedMin: 0,
                                                suggestedMax: 100
                                            }
                                        }
                                    },
                                });

                                function random(min, max) { // min and max included
                                    return Math.floor(Math.random() * (max - min + 1) + min)
                                }

                                </script>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

