@extends('layout.employee_profile_layout')
    @section('content')
    @include('inc.chart')
    <style>
        body{
            overflow-x: hidden
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css">
    <style>
        .progress {
        width: 150px;
        height: 150px;
        background: none;
        position: relative;
        }

        .progress::after {
        content: "";
        width: 100%;
        height: 100%;
        border-radius: 50%;
        border: 6px solid #eee;
        position: absolute;
        top: 0;
        left: 0;
        }

        .progress>span {
        width: 50%;
        height: 100%;
        overflow: hidden;
        position: absolute;
        top: 0;
        z-index: 1;
        }

        .progress .progress-left {
        left: 0;
        }

        .progress .progress-bar {
        width: 100%;
        height: 100%;
        background: none;
        border-width: 6px;
        border-style: solid;
        position: absolute;
        top: 0;
        }

        .progress .progress-left .progress-bar {
        left: 100%;
        border-top-right-radius: 80px;
        border-bottom-right-radius: 80px;
        border-left: 0;
        -webkit-transform-origin: center left;
        transform-origin: center left;
        }

        .progress .progress-right {
        right: 0;
        }

        .progress .progress-right .progress-bar {
        left: -100%;
        border-top-left-radius: 80px;
        border-bottom-left-radius: 80px;
        border-right: 0;
        -webkit-transform-origin: center right;
        transform-origin: center right;
        }

        .progress .progress-value {
        position: absolute;
        top: 0;
        left: 0;
        }
        </style>


    <div class="row">
        <div class="col-4">
            <div class="card w-100 p-5 rounded-0 rounded-top shadow-sm">
                <div class="row">
                    <img src="/{{$profile->userDetail->picture}}" class="rounded-circle shadow-sm p-0 m-auto" height="390px" width="390px">
                </div>
                <div class="row text-center mt-5 mb-3">
                    <h6 class="text-secondary p-0 m-0">Employee Name</h6>
                    <h1 class="display-3 p-0 m-0">{{ $profile->userDetail->fname }} {{ $profile->userDetail->mname }} {{ $profile->userDetail->lname }}</h1>
                </div>
                <hr>
                <div class="row my-5 p-0 text-center">
                    <div class="col-3">
                        <h6 class="text-secondary p-0 m-0">Employee ID</h6>
                        <h1 class="display-6 p-0 m-0">{{ $profile->employee_id }}</h1>
                    </div>
                    <div class="col">
                        <h6 class="text-secondary p-0 m-0">Employee Department</h6>
                        <h1 class="display-6 p-0 m-0">{{ $profile->department }}</h1>
                    </div>
                    <div class="col">
                        <h6 class="text-secondary p-0 m-0">Employee Position</h6>
                        <h1 class="display-6 p-0 m-0">{{ $profile->position }}</h1>
                    </div>
                </div>
                <div class="row my-5 mt-2  text-center">
                    <h6 class="text-secondary p-0 m-0">Employment Status</h6>
                    <h3 class="display-6 p-0 m-0 text-secondary">{{ $profile->employment_status }}</h3>
                </div>
                <hr>
                <div class="row my-5 mt-2  text-center">
                    <h6 class="text-secondary p-0 m-0">Educational Attainment</h6>
                    <h3 class=" p-0 m-0 text-secondary">{{ $profile->educ }}</h3>
                </div>
                <div class="row mb-5 text-center">
                    <div class="col">
                        <h6 class="text-secondary p-0 m-0">Sex</h6>
                        <h3 class=" p-0 m-0 text-secondary">{{ $profile->userDetail->sex }}</h3>
                    </div>
                    <div class="col">
                        <h6 class="text-secondary p-0 m-0">Age</h6>
                        <h3 class="text-secondary p-0 m-0">{{ $profile->age }}</h3>
                    </div>
                    <div class="col">
                        <h6 class="text-secondary p-0 m-0">Birthdate</h6>
                        <h3 class="text-secondary p-0 m-0">{{ $profile->userDetail->bday }}</h3>
                    </div>
                </div>
                <div class="row my-5 text-center">
                    <div class="col">
                        <h6 class="text-secondary p-0 m-0">Email Address</h6>
                        <h4 class=" p-0 m-0 text-secondary">{{ $profile->userDetail->email }}</h4>
                    </div>
                    <div class="col">
                        <h6 class="text-secondary p-0 m-0">Contact Number</h6>
                        <h4 class="text-secondary p-0 m-0">{{ $profile->userDetail->cnum }}</h4>
                    </div>
                </div>
            </div>
            @if (session('user_type') == 'employee')
            <div class="row mb-5">
                <div class="col-4 pe-0">
                    <a href="/employee/profile/update" class='btn btn-primary p-3 rounded-0 btn-lg w-100 shadow-sm'>Update Profile <i class="bi bi-person"></i></a>
                </div>
                <div class="col-4 p-0">
                    <a href="/change_picture" class='btn btn-success p-3 rounded-0 btn-lg w-100 shadow-sm'>Change Picture <i class="bi bi-camera-fill"></i></a>
                </div>
                <div class="col-4 ps-0">
                    @if ($profile->employment_status == 'Offboardee')
                        <button class='btn btn-outline-danger p-3 rounded-0 btn-lg w-100 shadow-sm' data-toggle="modal"
                        data-target="#resign_modal" disabled>Resign <i class="bi bi-file-earmark-text-fill"></i></button>
                    @else
                        @if(isset($profile->resign))
                            <button class='btn btn-danger p-3 rounded-0 btn-lg w-100 shadow-sm' data-toggle="modal"
                            data-target="#resign_modal">Application Submitted</button>
                        @else
                            <button class='btn btn-outline-danger p-3 rounded-0 btn-lg w-100 shadow-sm' data-toggle="modal"
                            data-target="#resign_modal">Resign <i class="bi bi-file-earmark-text-fill"></i></button>
                        @endif
                    @endif
                </div>
            </div>
            @endif
        </div>
        <div class="col">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#home">Attendance Overview</a></li>
                <li><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#menu1">Assessment Overview</a></li>
                <li><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#menu2">Assessment History</a></li>
            </ul>

            <div class="tab-content">
                <div id="home" class="tab-pane in active">
                    <div class="container p-5 border shadow-sm">
                        <div class="row p-3">
                            <h1 class="alert-light">Attendance Overview</h1>
                        </div>
                        <div id="calendar"></div>
                        <div class="row p-3">
                            <h1 class="alert-light">Overall Attendance Summary</h1>

                            <div class="row">
                                <div class="container card shadow-sm p-3 ">
                                    <canvas id="attendance_pie" width="1" height="1"></canvas>
                                </div>
                            <script>
                                var ctx = document.getElementById('attendance_pie').getContext('2d');
                                var myChart = new Chart(ctx,{
                                    type: 'pie',
                                    data: {
                                        labels: [
                                            'On Time',
                                            'Under Time',
                                            'Late',
                                            'Absent',
                                        ],
                                        datasets: [{
                                            label: 'My First Dataset',
                                            data: ['{!! $graph_arr[0] !!}','{!! $graph_arr[1] !!}','{!! $graph_arr[2] !!}','{!! $graph_arr[3] !!}'],
                                            backgroundColor: [
                                                'rgb(85, 183, 70)',
                                                'rgb(255, 133, 73)',
                                                'rgb(285, 193, 73)',
                                                'rgb(183, 70, 70)',
                                            ],
                                            hoverOffset: 4
                                        }]
                                    },
                                })
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="menu1" class="tab-pane">
                    <div class="container p-5 border shadow-sm">
                        <div class="row p-3">
                            <h1 class="alert-light">Assessment Overview</h1>
                        </div>
                        <div class="row">
                            <div class="col-xl-3 col-lg-6 mb-4">
                              <div class="bg-white rounded-lg p-5 shadow">
                                <h2 class="h6 font-weight-bold text-center mb-4">Attendance</h2>

                                <!-- Progress bar 1 -->
                                <div class="progress mx-auto" data-value='{{$types[0]->average}}'>
                                  <span class="progress-left">
                                                <span class="progress-bar border-primary"></span>
                                  </span>
                                  <span class="progress-right">
                                                <span class="progress-bar border-primary"></span>
                                  </span>
                                  <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                    <div class="h2 font-weight-bold">{{$types[0]->average}}<sup class="small">%</sup></div>
                                  </div>
                                </div>
                                <!-- END -->
                              </div>
                            </div>

                            <div class="col-xl-3 col-lg-6 mb-4">
                              <div class="bg-white rounded-lg p-5 shadow">
                                <h2 class="h6 font-weight-bold text-center mb-4">Performance</h2>

                                <!-- Progress bar 2 -->
                                <div class="progress mx-auto" data-value='{{$types[1]->average}}'>
                                  <span class="progress-left">
                                                <span class="progress-bar border-danger"></span>
                                  </span>
                                  <span class="progress-right">
                                                <span class="progress-bar border-danger"></span>
                                  </span>
                                  <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                    <div class="h2 font-weight-bold">{{$types[1]->average}}<sup class="small">%</sup></div>
                                  </div>
                                </div>
                                <!-- END -->
                              </div>
                            </div>

                            <div class="col-xl-3 col-lg-6 mb-4">
                              <div class="bg-white rounded-lg p-5 shadow">
                                <h2 class="h6 font-weight-bold text-center mb-4">Character</h2>

                                <!-- Progress bar 3 -->
                                <div class="progress mx-auto" data-value='{{$types[2]->average}}'>
                                  <span class="progress-left">
                                                <span class="progress-bar border-success"></span>
                                  </span>
                                  <span class="progress-right">
                                                <span class="progress-bar border-success"></span>
                                  </span>
                                  <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                    <div class="h2 font-weight-bold">{{$types[2]->average}}<sup class="small">%</sup></div>
                                  </div>
                                </div>
                                <!-- END -->
                              </div>
                            </div>

                            <div class="col-xl-3 col-lg-6 mb-4">
                              <div class="bg-white rounded-lg p-5 shadow">
                                <h2 class="h6 font-weight-bold text-center mb-4">Cooperation</h2>

                                <!-- Progress bar 4 -->
                                <div class="progress mx-auto" data-value='{{$types[3]->average}}'>
                                  <span class="progress-left">
                                                <span class="progress-bar border-warning"></span>
                                  </span>
                                  <span class="progress-right">
                                                <span class="progress-bar border-warning"></span>
                                  </span>
                                  <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                    <div class="h2 font-weight-bold">{{$types[3]->average}}<sup class="small">%</sup></div>
                                  </div>
                                </div>
                                <!-- END -->
                              </div>
                            </div>
                        </div>
                        <div class="row">
                            <h1 class="alert-light">Employee Characteristics</h1>
                        </div>
                        <div class="row">
                            <canvas id="characteristics" width="1" height="1"></canvas>
                        </div>
                        <script>
                            var ctx = document.getElementById('characteristics').getContext('2d');

                            new Chart(ctx, {
                                type: 'radar',
                                data: {
                                        labels: [
                                            'Attendance',
                                            'Performance',
                                            'Character',
                                            'Cooperation'
                                        ],
                                        datasets:  [{
                                            label: 'Employee Characteristics',
                                            data: ['{!!$types[0]->average!!}', '{!!$types[1]->average!!}', '{!!$types[2]->average!!}', '{!!$types[3]->average!!}'],
                                            fill: true,
                                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                            borderColor: 'rgb(255, 99, 132)',
                                            pointBackgroundColor: 'rgb(255, 99, 132)',
                                            pointBorderColor: '#fff',
                                            pointHoverBackgroundColor: '#fff',
                                            pointHoverBorderColor: 'rgb(255, 99, 132)'
                                        }]
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
                        </script>
                    </div>
                </div>
                <div id="menu2" class="tab-pane">
                    <div class="container p-4 border shadow-sm">
                        <div class="row">
                            <div class="col-2 card p-0">
                                <ul class="nav nav-pills p-0 w-100" >
                                    @foreach ($years as $key => $value)
                                        @if (!$key)
                                            <li class="active mx-2 my-1 w-100"><a data-toggle="tab" class="h5 text-decoration-none m-0 w-100 text-center" href="#pill_{{ $value->year }}">{{ $value->year }}</a></li>
                                        @else
                                            <li class="mx-2 my-1 w-100"><a data-toggle="tab" class="h5 text-decoration-none m-0 w-100 text-center" href="#pill_{{ $value->year }}">{{ $value->year }}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col card">
                                <div class="tab-content">
                                    @foreach ($years as $key => $year)
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
                                                            <div class="col-4 text-center pt-2 mt-1"><h5>Score:</h5></div>
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
            </div>
        </div>
    </div>

    <script>
        $(function() {
            $(".progress").each(function() {
                var value = $(this).attr('data-value');
                var left = $(this).find('.progress-left .progress-bar');
                var right = $(this).find('.progress-right .progress-bar');

                if (value > 0) {
                    if (value <= 50) {
                        right.css('transform', 'rotate(' + percentageToDegrees(value) + 'deg)')
                    } else {
                        right.css('transform', 'rotate(180deg)')
                        left.css('transform', 'rotate(' + percentageToDegrees(value - 50) + 'deg)')
                    }
                }
            })

            function percentageToDegrees(percentage) {
                return percentage / 100 * 360
            }
        });
    </script>

    <!-- The Modal -->
    <div class="modal" id="resign_modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title w-100">Submit your Resignation Letter</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" >
                    <div class="row mx-3" style="height: 540px">
                        <div class="col-3 text-center">
                            <div class="card p-3 mb-5">
                            <form action="/insertEmployeeResignation" method='POST' enctype="multipart/form-data">
                                @csrf
                                <h6>Submit Letter in PDF Format</h6>
                                <input class="form-control p-3 m-0" type="file" accept="application/pdf" name='resign' id="formFile">
                            </div>

                            @if(isset($profile->resign))
                            <div class="card p-0">
                                <h6 class="p-3">Resignation Status</h6>
                                @if(!isset($profile->resign->status))
                                    <h6 class="alert-info w-100 p-3">No Updates Yet
                                        <hr>
                                        <p class="p-0 text-secondary m-0">Talk to your manager</p>
                                    </h6>
                                @else
                                    @if($profile->resign->status)
                                        <h6 class="alert-primary w-100 p-3">Your resignation letter has been approved
                                            <hr>
                                            <p class="p-0 text-secondary m-0">By: {{$profile->resign->manager->fname}} {{$profile->resign->manager->mname}} {{$profile->resign->manager->lname}}</p>
                                            <p class="p-0 text-secondary m-0">On: {{$profile->resign->update_date}}</p>
                                        </h6>
                                    @else
                                    <h6 class="alert-danger w-100 p-3">Your resignation letter has been denied
                                        <hr>
                                        <p class="p-0 text-secondary m-0">By: {{$profile->resign->manager->fname}} {{$profile->resign->manager->mname}} {{$profile->resign->manager->lname}}</p>
                                        <p class="p-0 text-secondary m-0">On: {{$profile->resign->update_date}}</p>
                                    </h6>
                                    @endif
                                @endif
                            </div>
                            @endif
                        </div>

                        <div class="col">
                            @if(isset($profile->resign))
                                <embed src="/{{$profile->resign->resignation_path}}" class="w-100 h-100" />
                            @else
                                <h1 class="w-100 text-center border rounded alert-light p-4">No Letter Uploaded</h1>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                        <div class="col">
                            <button class="btn btn-success w-100 p-3">Submit</button>
                        </div>
                    </form>
                        <div class="col">
                            @if (isset($profile->resign) && !$profile->resign->status)
                            <form action="/deleteEmployeeResignation" method="POST">
                                @csrf
                                {!! Form::hidden('resignation_id', $profile->resign->id) !!}
                                <button type="submit" class="btn btn-warning p-3 w-100">Delete Application</button>
                            </form>
                            @endif
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-danger w-100 p-3" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection

    @section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        var calendar_data = {!! json_encode($attendance_display_arr, JSON_HEX_TAG) !!}
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: calendar_data
        });

        calendar.render();
    });
    </script>
    @endsection
