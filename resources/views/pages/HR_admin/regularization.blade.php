@extends('layout.admin_app')

    @section('content')
    @include('inc.chart')
        <h1 class="section-title mt-2 pb-1">Regularization Management</h1>
        <div class="container w-100">
            <table class="w-100" id="employee_table">
                <thead class="">
                    <tr>
                        <th class="col-3">Sort By Name</th>
                        <th class="col-8 text-center">Sort by Date</th>
                        <th class="col-1"></th>
                    </tr>
                </thead>
            </table>
        </div>
    @endsection


    @section('script')
    <script>
    $(document).ready(function(){

        $('#employee_table').DataTable({
                processing: true,
                serverSide: false,
                ajax: {
                    url: '/regularizationEmployeeList'
                },
                columns: [
                    { data: 'user_detail.fname',
                        render : (data,type,row)=>{
                            return `
                            <div class="border-start border-top border-bottom my-5" style="height:350px">
                                <p class="d-none">${data}</p>
                                <img src="{{ URL::asset('${row.user_detail.picture}')}}" class="rounded-start" width="349" height="349">
                            </div>`
                        }
                    },
                    { data: 'start_date',
                        render : (data,type,row)=>{
                            return `
                            <p class="d-none">${data}</p>
                            <div class="border-top border-bottom my-5" style="height:350px">
                                <div class="row">
                                    <div class="col-5">
                                        <h4 class="w-100 text-center p-5 m-0 alert-primary">${row.user_detail.fname} ${row.user_detail.mname} ${row.user_detail.lname}</h4>
                                        <div class="row w-100 m-0 pt-3 ps-2 alert-light" style="height:200px">
                                            <div class="col">
                                                <h5 class="p-0 m-0">Position</h5>
                                                <h1 class="h4 mb-5">${row.position}</h1>
                                                <h5 class="p-0 m-0">Department</h5>
                                                <h1 class="h4 mb-5">${row.department}</h1>
                                                <h5 class="p-0 m-0">Employeed on</h5>
                                                <h1 class="h4 mb-5">${data}</h1>
                                            </div>
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <h5 class="p-0 m-0">Age</h5>
                                                        <h1 class="h4 mb-5">${row.user_detail.age}</h1>
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="p-0 m-0">Sex</h5>
                                                        <h1 class="h4 mb-5">${row.user_detail.sex}</h1>
                                                    </div>
                                                </div>
                                                <h5 class="p-0 m-0">Contact Information</h5>
                                                <h1 class="h4">${row.user_detail.cnum}</h1>
                                                <h1 class="h4">${row.user_detail.email}</h1>
                                            </div>
                                        </div>

                                        <div class="row m-0 w-100 py-4 text-center border-bottom alert-info">
                                                <h6>Employment Duration</h6>
                                                <h1 class="h4 text-secondary">${row.duration.y} Years | ${row.duration.m} Months | ${row.duration.d} Days</h1>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="container mx-auto" style="height:370px;width:370px;">
                                            <canvas id="chart_${row.employee_id}" class="w-100 h-100"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                var ctx = document.getElementById('chart_${row.employee_id}').getContext('2d');

                                var myChart = new Chart(ctx, {
                                    type: 'radar',
                                    data: {
                                        labels: [
                                            'Attendance',
                                            'Performance',
                                            'Character',
                                            'Cooperation'
                                        ],
                                        datasets: [{
                                            label: 'Performance assessment',
                                            data: [${row.assessment}],
                                            fill: true,
                                            backgroundColor: 'rgba(50, 168, 82, 0.2)',
                                            borderColor: 'rgb(50, 168, 82)',
                                            pointBackgroundColor: 'rgb(50, 168, 82)',
                                            pointBorderColor: '#fff',
                                            pointHoverBackgroundColor: '#fff',
                                            pointHoverBorderColor: 'rgb(50, 168, 82)'
                                        }],
                                    },
                                    options: {
                                        elements: {
                                            line: {
                                                borderWidth: 3
                                            }
                                        }
                                    },
                                });`
                        }
                    },

                    { data: 'department',
                        render : (data,type,row)=>{
                            return `
                            <div class="border-top border-bottom border-end my-5 p-0" style="height:350px">
                                <button type="button" data-toggle="modal" data-target="#modal_${row.employee_id}" class="btn btn-outline-success rounded-0 w-100" style="height:33.4%;"><i class="bi bi-award h1 mt-4"></i><br>Regularize</button>
                                <a href="/payroll/employee/profile/${row.login_id}" class="btn btn-outline-primary w-100 pt-5" style="height:33.4%"><i class="bi bi-person-square h1 mt-4"></i><br>Profile</a>
                                <a href="/message/${row.user_detail.fname} ${row.user_detail.mname} ${row.user_detail.lname}" class="btn btn-outline-warning  pt-5 rounded-0 w-100" style="height:33.4%"><i class="bi bi-chat h1"></i><br>Message</a>
                            </div>

                            <div class="modal" id="modal_${row.employee_id}">
                                <div class="modal-dialog modal-lg modal-dialog-centered" >
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title w-100">Confirmation of Regularization</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body row">
                                            <div class="row">
                                                <div class="col text-center">
                                                    <img src="{{ URL::asset('${row.user_detail.picture}')}}" class="rounded" width="200" height="200">
                                                    <h2 class="w-100 text-center p-2">${row.user_detail.fname} ${row.user_detail.mname} ${row.user_detail.lname}</h2>
                                                    <div class="row">
                                                        <div class="col">
                                                            <h5 class="p-0 m-0">Position</h5>
                                                            <h1 class="h4 mb-5">${row.position}</h1>
                                                            <h5 class="p-0 m-0">Department</h5>
                                                            <h1 class="h4 mb-5">${row.department}</h1>
                                                            <h5 class="p-0 m-0">Employeed on</h5>
                                                            <h1 class="h4 mb-5">${row.start_date}</h1>
                                                        </div>
                                                        <div class="col">
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    <h5 class="p-0 m-0">Age</h5>
                                                                    <h1 class="h4 mb-5">${row.user_detail.age}</h1>
                                                                </div>
                                                                <div class="col">
                                                                    <h5 class="p-0 m-0">Sex</h5>
                                                                    <h1 class="h4 mb-5">${row.user_detail.sex}</h1>
                                                                </div>
                                                            </div>
                                                            <h5 class="p-0 m-0">Contact Information</h5>
                                                            <h1 class="h4">${row.user_detail.cnum}</h1>
                                                            <h1 class="h4">${row.user_detail.email}</h1>

                                                            {!! Form::open(['action'=>'App\Http\Controllers\PagesController@display_resume','method'=>'GET','target'=>'_blank']) !!}
                                                            {!! Form::hidden('path','${row.resume}') !!}
                                                            {!! Form::submit('View Resume', ["class"=>"btn btn-lg mt-3 btn-outline-primary m-auto"]) !!}
                                                            {!! Form::close() !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <canvas id="chart2_${row.employee_id}" class="w-100 h-100"></canvas>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer d-flex justify-content-end">
                                            <a href="/updateEmploymentStatus/${row.employee_id}" class="btn btn-lg p-3 px-5 btn-success m-2">Regularize</a>
                                            <button type="button" data-dismiss="modal" class="btn btn-lg btn-outline-danger p-3 m-2">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                var ctx = document.getElementById('chart2_${row.employee_id}').getContext('2d');

                                var myChart = new Chart(ctx, {
                                    type: 'radar',
                                    data: {
                                        labels: [
                                            'Attendance',
                                            'Performance',
                                            'Character',
                                            'Cooperation'
                                        ],
                                        datasets: [{
                                            label: 'Performance assessment',
                                            data: [${row.assessment}],
                                            fill: true,
                                            backgroundColor: 'rgba(50, 168, 82, 0.2)',
                                            borderColor: 'rgb(50, 168, 82)',
                                            pointBackgroundColor: 'rgb(50, 168, 82)',
                                            pointBorderColor: '#fff',
                                            pointHoverBackgroundColor: '#fff',
                                            pointHoverBorderColor: 'rgb(50, 168, 82)'
                                        }],
                                    },
                                    options: {
                                        elements: {
                                            line: {
                                                borderWidth: 3
                                            }
                                        }
                                    },
                                });
                            `
                        }
                    }
                ]
            })

            @if (isset($name))
                $('#employee_table').DataTable().search('{{ $name }}').draw();
            @endif
    })
    </script>
@endsection



