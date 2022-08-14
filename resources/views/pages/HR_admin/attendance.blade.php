@extends('layout.admin_carousel')

@section('title')
    <h1 class="section-title mt-2 pb-1">Attendance</h1>
@endsection

@section('controls')
    <li class="active"><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#home">Today Attendance Overview</a></li>
    <li><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#menu1">All time Attendance Overview</a></li>
@endsection

@section('first')
    @include('inc.chart')
    <div class="row text-primary pt-2">
        <div class="col card m-3 p-3 ps-5 alert-primary shadow-sm">
            <h1 style="font-size:50px">{{ count($employee) }}</h3>
            <h3>Total Employees</h2>
        </div>
        <div class="col card m-3 p-3 ps-5 alert-success shadow-sm">
            <h1 style="font-size:50px">{{ $time_in[0] }}</h1>
            <h3>Total on time Employee</h3>
        </div>
        <div class="col card m-3 p-3 ps-5 alert-warning shadow-sm">
            <h1 style="font-size:50px">{{ $time_in[2] }}</h1>
            <h3>Total Late Employee</h3>
        </div>
        <div class="col card m-3 p-3 ps-5 alert-danger shadow-sm ">
            <h1 style="font-size:50px">{{ $time_in[5] }}</h1>
            <h3>Total Absent Employee</h3>
        </div>
    </div>
    <div class="row pt-2">
        <div class="col-8">
            <div class="container card p-3 shadow-sm">
                <table class="table text-center" id="attendance_today_table">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Employee Name</th>
                            <th scope="col">Scheduled Time in</th>
                            <th scope="col">Time in</th>
                            <th scope="col">Scheduled Time out</th>
                            <th scope="col">Time out</th>
                            <th scope="col">Health Check</th>
                        </tr>
                    </thead>
                    <tbody>

                    </body>
                </table>
            </div>
        </div>
        <div class="col-4">
            <div class="container card shadow-sm p-3 ">
                <canvas id="attendance_pie" width="1" height="1"></canvas>
            </div>
            <script>

            var ctx = document.getElementById('attendance_pie').getContext('2d');
            var myChart = new Chart(ctx,{
                type: 'pie',
                data: {
                    labels: [
                        'On Time Onboardee',
                        'On Time Regualar',
                        'On Time Offboardee',
                        'Late Onboardee',
                        'Late Regualar',
                        'Late Offboardee',
                        'Absent Onboardee',
                        'Absent Regualar',
                        'Absent Offboardee',
                    ],
                    datasets: [{
                        label: 'My First Dataset',
                        data: ['{{ $time_in[1][0]}}','{{ $time_in[1][1]}}','{{ $time_in[1][2]}}','{{ $time_in[3][0]}}','{{ $time_in[3][1]}}','{{ $time_in[3][2]}}','{{ $time_in[4][0]}}','{{ $time_in[4][1]}}','{{ $time_in[4][2]}}'],
                        backgroundColor: [
                            'rgb(85, 183, 70)',
                            'rgb(55, 153, 40)',
                            'rgb(35, 123, 10)',
                            'rgb(285, 193, 73)',
                            'rgb(255, 163, 43)',
                            'rgb(225, 133, 13)',
                            'rgb(183, 70, 70)',
                            'rgb(153, 40, 40)',
                            'rgb(123, 10, 10)',
                        ],
                        hoverOffset: 4
                    }]
                },
            })
            </script>

            <div class="container card shadow-sm p-3 mt-5">
                <canvas id="health_pie" width="1" height="1"></canvas>
            </div>
            <script>

                var ctx = document.getElementById('health_pie').getContext('2d');
                var myChart = new Chart(ctx,{
                    type: 'pie',
                    data: {
                        labels: [
                            '🤢 Sick',
                            '😷 Bad',
                            '😕 Unpleasant',
                            '😐 Neutral',
                            '🙂 Good',
                            '😀 Better',
                            '😁 Best',
                        ],
                        datasets: [{
                            label: 'My First Dataset',
                            data: ['{{ $health_check[0]}}','{{ $health_check[1]}}','{{ $health_check[2]}}','{{ $health_check[3]}}','{{ $health_check[4]}}','{{ $health_check[5]}}','{{ $health_check[6]}}'],
                            backgroundColor: [
                                'rgb(158, 28, 28)',
                                'rgb(158, 56, 28)',
                                'rgb(158, 93, 28)',
                                'rgb(234, 255, 3)',
                                'rgb(123, 158, 28)',
                                'rgb(95, 158, 28)',
                                'rgb(41, 158, 28)',
                            ],
                            hoverOffset: 4
                        }]
                    },
                })
                </script>
        </div>
    </div>

@endsection

@section('second')
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#overall">Overall Attendance Overview</a></li>
        <li><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#departments">Department Attendance Overview</a></li>
        <li><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#positions">Positions Attendance Overview</a></li>
        <li><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#employee">Employee Attendance Overview</a></li>
    </ul>

    <div class="tab-content">
        <div id="overall" class="tab-pane in active">
            <div class="container p-5 bg-white border shadow-lg">
                <h1 class="bg-primary text-white w-100 text-center rounded-top m-0 mb-4 p-3">Overall Attendance Overview</h1>
                <div class="row w-100">
                    <div class="col">
                        <div class="container w-75">
                            <canvas id="line_chart" width="1" height="1"></canvas>
                            <script>
                                var ctx = document.getElementById('line_chart').getContext('2d');
                                var myChart = new Chart(ctx,{
                                    type: 'line',
                                    data: {
                                        labels: {!! json_encode($all_date, JSON_HEX_TAG) !!},
                                        datasets: [
                                        {
                                            label: 'On time Attendance',
                                            data: {!! json_encode($all_ontime, JSON_HEX_TAG) !!},
                                            fill: false,
                                            borderColor: 'rgb(75, 192, 192)',
                                            tension: 0.1
                                        },
                                        {
                                            label: 'Late Attendance',
                                            data: {!! json_encode($all_late, JSON_HEX_TAG) !!},
                                            fill: false,
                                            borderColor: 'rgb(179, 142, 43)',
                                            tension: 0.1
                                        },
                                        {
                                            label: 'Absents',
                                            data: {!! json_encode($all_absent, JSON_HEX_TAG) !!},
                                            fill: false,
                                            borderColor: 'rgb(179, 66, 43)',
                                            tension: 0.1
                                        }
                                    ]
                                    },
                                })
                            </script>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card alert-primary text-center h3 p-3 w-100">
                            Reports
                        </div>

                        <div class="card alert-light text-center h3 p-5 shadow-sm w-100">
                            {{ round(($totals[1]/$totals[0]) * 100,2) }}% On time percentage
                        </div>
                        <div class="card alert-light text-center h3 p-5 shadow-sm w-100">
                            {{ round(($totals[3]/$totals[0]) * 100,2) }}% Late percentage
                        </div>
                        <div class="card alert-light text-center h3 p-5 shadow-sm w-100">
                            {{ round(($totals[2]/$totals[0]) * 100,2) }}% Absent percentage
                        </div>
                    </div>
                </div>

                <h1 class="bg-primary text-white w-100 text-center rounded-top m-0 mb-4 mt-5 p-3">Overall Health Overview</h1>
                <div class="row w-100">
                    <div class="col">
                        <div class="container w-100">
                            <canvas id="line_chart1" width="1" height="1"></canvas>
                            <script>
                                var ctx = document.getElementById('line_chart1').getContext('2d');
                                var myChart = new Chart(ctx,{
                                    type: 'line',
                                    data: {
                                        labels: {!! json_encode($health_check_all[0], JSON_HEX_TAG) !!},
                                        datasets: [
                                        {
                                            label: 'Sick',
                                            data: {!! json_encode($health_check_all[1], JSON_HEX_TAG) !!},
                                            fill: false,
                                            borderColor: 'rgb(158, 28, 28)',
                                            tension: 0.1
                                        },
                                        {
                                            label: 'Bad',
                                            data: {!! json_encode($health_check_all[2], JSON_HEX_TAG) !!},
                                            fill: false,
                                            borderColor: 'rgb(158, 56, 28)',
                                            tension: 0.1
                                        },
                                        {
                                            label: 'Unpleasnt',
                                            data: {!! json_encode($health_check_all[3], JSON_HEX_TAG) !!},
                                            fill: false,
                                            borderColor: 'rgb(158, 93, 28)',
                                            tension: 0.1
                                        },
                                        {
                                            label: 'Neutral',
                                            data: {!! json_encode($health_check_all[4], JSON_HEX_TAG) !!},
                                            fill: false,
                                            borderColor: 'rgb(234, 255, 3)',
                                            tension: 0.1
                                        },
                                        {
                                            label: 'Good',
                                            data: {!! json_encode($health_check_all[5], JSON_HEX_TAG) !!},
                                            fill: false,
                                            borderColor: 'rgb(123, 158, 28)',
                                            tension: 0.1
                                        },
                                        {
                                            label: 'Better',
                                            data: {!! json_encode($health_check_all[6], JSON_HEX_TAG) !!},
                                            fill: false,
                                            borderColor: 'rgb(95, 158, 28)',
                                            tension: 0.1
                                        },
                                        {
                                            label: 'Best',
                                            data: {!! json_encode($health_check_all[7], JSON_HEX_TAG) !!},
                                            fill: false,
                                            borderColor: 'rgb(41, 158, 28)',
                                            tension: 0.1
                                        }
                                    ]
                                    },
                                })
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="departments" class="tab-pane">
            <div class="container p-0 border bg-white shadow-lg w-100">
                <h1 class="bg-primary text-white w-100 text-center m-0 p-3">Department Attendance Overview</h1>
                <div class="row mx-auto">
                    @foreach ($deparment_attendance as $key => $data)
                    <div class="container w-25 mb-4 card p-0">
                        <h3 class="text-center w-100 alert-primary p-3 ">{{ $data->department_name }}</h3>
                        <canvas id="chart_{{ $key }}" width="1" height="1"></canvas>
                    </div>

                    <script>
                        var ctx = document.getElementById('chart_{{ $key }}').getContext('2d');
                        var myChart = new Chart(ctx,{
                            type: 'doughnut',
                            data: {labels:[
                                'On time',
                                'Absent',
                                'Late'
                            ],
                            datasets: [{
                                label: 'Department Attendance',
                                data: ['{{$data->ontime}}', '{{$data->absent}}', '{{$data->late}}'],
                                backgroundColor: [
                                    'rgb(54, 162, 235)',
                                    'rgb(255, 99, 132)',
                                    'rgb(255, 205, 86)'
                                ],
                                hoverOffset: 4
                            }]
                        }
                        })
                    </script>
                    @endforeach
                </div>
            </div>
        </div>
        <div id="positions" class="tab-pane">
            <div class="container p-0 border bg-white shadow-lg w-100">
                <h1 class="bg-primary text-white w-100 text-center m-0 p-3">Position Attendance Overview</h1>
                <div class="row mx-auto">
                    @foreach ($position_attendance as $key => $data)
                    <div class="container w-25 mb-4 card p-0">
                        <h3 class="text-center w-100 alert-primary p-3 ">{{ $data->position_title }}</h3>
                        <canvas id="chart_position{{ $key }}" width="1" height="1"></canvas>
                    </div>

                    <script>
                        var ctx = document.getElementById('chart_position{{ $key }}').getContext('2d');
                        var myChart = new Chart(ctx,{
                            type: 'doughnut',
                            data: {labels:[
                                'On time',
                                'Absent',
                                'Late'
                            ],
                            datasets: [{
                                label: 'Position Title',
                                data: ['{{$data->ontime}}', '{{$data->absent}}', '{{$data->late}}'],
                                backgroundColor: [
                                    'rgb(54, 212, 285)',
                                    'rgb(305, 99, 182)',
                                    'rgb(305, 255, 86)'
                                ],
                                hoverOffset: 4
                            }]
                        }
                        })
                    </script>
                    @endforeach
                </div>
            </div>
        </div>
        <div id="employee" class="tab-pane">
            <h1 class="bg-primary text-white w-100 text-center m-0 p-3">Employee Attendance Overview</h1>
            <table class="table table-striped  w-100 text-center" id="emp_attendance_table">
                <thead>
                    <tr>
                        <th class="col"></th>
                        <th class="col">Employee Details</th>
                        <th class="col">On Time</th>
                        <th class="col">Late</th>
                        <th class="col">Absent</th>
                    </tr>
                </thead>
            </table>

            <script>
                $('#emp_attendance_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: { url: '/getEmployeeOverallAttendance' },
                columns: [
                    { data: 'employee_id',
                        render : (data,type,row)=>{
                            return  `<img src="{{ URL::asset('${row.user_detail.picture}')}}" class="rounded" width="50" height="50">`
                        }
                    },
                    { data: 'user_detail.fname',
                        render : (data,type,row)=>{
                            return `<h3>${data} ${row.user_detail.mname} ${row.user_detail.lname}</h3>
                            ${row.position}<br>
                            ${row.department}`
                        }
                    },
                    { data: 'ontime',
                        render : (data,type,row)=>{
                            return `<h5 class="border border-success p-4 text-success h5">${data} Records <b class="text-dark">(${Math.round((data / row.total) * 100 * 100) / 100}%)</b></h5>`
                        }
                    },
                    { data: 'late',
                        render : (data,type,row)=>{
                            return `<h5 class="border border-warning p-4 text-warning h5">${data} Records <b class="text-dark">(${Math.round((data / row.total) * 100 * 100) / 100}%)</b></h5>`
                        }
                    },
                    { data: 'absent',
                        render : (data,type,row)=>{
                            return `<h5 class="border border-danger p-4 text-danger h5">${data} Records <b class="text-secondary">(${Math.round((data / row.total) * 100 * 100) / 100}%)</b></h5>`
                        }
                    },
                ]
            })
            </script>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#attendance_today_table').DataTable({
                processing: true,
                serverSide: false,
                ajax: {
                    url: '/attendanceTodayJSON'
                },
                columns: [
                    { data: 'employee_id',
                        render : (data,type,row)=>{
                            return `<img src="{{ URL::asset('${row.picture}')}}" class="rounded" width="50" height="50">`
                        }
                    },
                    { data: 'fname',
                        render : (data,type,row)=>{
                            return `<h4>${data} ${row.mname} ${row.lname}</h4>
                            <h6>${row.position}</h6>
                            <h6>${row.department}</h6>`

                        }
                    },
                    { data: 'schedule_Timein',
                        render : (data,type,row)=>{
                            return `${data}`
                        }
                    },
                    { data: 'null',
                        render : (data,type,row)=>{
                            if(row.attendance_today){
                                return `${row.attendance_today.time_in}`
                            }
                            return `<b class="text-danger">No record</b>`
                        }
                    },
                    { data: 'schedule_Timeout',
                        render : (data,type,row)=>{
                            return `${data}`
                        }
                    },
                    { data: 'null',
                        render : (data,type,row)=>{
                            if(row.attendance_today){
                                return `${row.attendance_today.time_out}`
                            }
                            return `<b class="text-danger">No record</b>`
                        }
                    },
                    { data: 'healthCheck.score',
                        render : (data,type,row)=>{
                            switch (data) {
                                case 0:
                                return `<h1>🤢</h1>Sick`
                                    break;

                                case 1:
                                return `<h1>😷</h1>Bad`
                                    break;

                                case 2:
                                return `<h1>😕</h1>Unpleasant`
                                    break;

                                case 3:
                                return `<h1>😐</h1>Neutral`
                                    break;

                                case 4:
                                return `<h1>🙂</h1>Good`
                                    break;

                                case 5:
                                return `<h1>😀</h1>Better`
                                    break;

                                case 6:
                                return `<h1>😁</h1>Best`
                                    break;

                                default:
                                    break;
                            }

                        }
                    },
                ]
            })

        })
    </script>
@endsection
