@extends('layout.employee_app')
@section('content')
    <div class="row">
        <div class="col">
            <h1 class="section-title mt-2 pb-1">Employee Overtime</h1>
        </div>
        <div class="col pt-5 mt-3">
        </div>
    </div>

    <div class="row">
        <div class="container">
            <ul class="container nav nav-tabs mt-5">
                <li class="active"><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#home">Apply for Overtime</a></li>
                <li><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#menu1">Overtime Application History</a></li>
            </ul>

            <div class="tab-content">
                <div id="home" class="tab-pane in active">
                    <div class="container p-5 border shadow-lg">
                        <h1 class="display-4 my-3 text-center w-100 alert-light rounded shadow-sm p-4">Apply for Overtime</h1>
                        <div class="row">
                            <div class="col-8 card m-2 p-4 shadow-sm">
                                <div class="row mb-2">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-2 text-right">
                                        <b class="me-1">Minimum extra time</b><br>
                                        <select id="time_filter" class="form-select p-2">
                                            <option value="1800">00:30:00</option>
                                            <option value="3600">01:00:00</option>
                                            <option value="5400">01:30:00</option>
                                            <option value="7200">02:00:00</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 input-daterange">
                                        <input type="text" name="from_date" id="from_date" class="form-control h-100" placeholder="From Date" readonly />
                                    </div>
                                    <div class="col-md-2 input-daterange">
                                        <input type="text" name="to_date" id="to_date" class="form-control h-100" placeholder="To Date" readonly />
                                    </div>
                                    <div class="col-2">
                                        <button type="button" name="filter" id="filter" class="btn h-100 btn-outline-primary">Filter</button>
                                        <button type="button" name="refresh" id="refresh" class="btn h-100 btn-outline-success">Refresh</button>
                                    </div>
                                </div>
                                <table class="table text-center" id="overtime_table">
                                    <thead>
                                        <tr>
                                            <th class="col">Attendance Date</th>
                                            <th class="col">Time in</th>
                                            <th class="col">Time out</th>
                                            <th class="col">Total Overtime Hours</th>
                                            <th class="col">Pay Overtime</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="col card m-2 p-4 shadow-sm">
                                @error('attendance_id'){!!"<span class='alert-danger w-100 p-2 rounded mb-1'>Pleases Select an Attendance</span><br>"!!}@enderror

                                <form action="/overtimeApplicationInsert" method="POST">
                                    @csrf
                                    {!! Form::hidden('attendance_id', '',['id'=>'attendance_id']) !!}
                                    {!! Form::label('attendance_date', 'Attendance Date', ['class'=>'h5']) !!}

                                    {!! Form::text('attendance_date', '', ['class'=>'form-control','id'=>'attendance_date','readonly']) !!}
                                    <div class="row my-3 w-100 text-center mx-auto">
                                        <div class="col card p-0 me-1">
                                            <h5 class="w-100 rounded-top alert-success p-2">Time in</h5>
                                            Time in: <h5 class="text-success" id="time_in">00:00:00</h5>
                                            Schedule: <h5 id="time_in_sched">00:00:00</h5>
                                        </div>
                                        <div class="col card p-0 ms-1">
                                            <h5 class="w-100 rounded-top alert-success p-2">Time out</h5>
                                            Time out: <h5 class="text-success" id="time_out">00:00:00</h5>
                                            Schedule: <h5 id="time_out_sched">00:00:00</h5>
                                        </div>
                                    </div>
                                    {!! Form::label('message', 'Message', ['class'=>'h5']) !!}
                                    {!! Form::textarea('message', '', ['class'=>'form-control']) !!}
                                    <span class="text-danger">@error('message'){{"This Field is required"}}@enderror</span>

                                    <div class="row mt-4">
                                        <div class="col">
                                            <button class="btn btn-success w-100 p-3">Submit Application</button>
                                        </div>
                                        <div class="col">
                                            <button class="btn btn-danger w-100 p-3">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="menu1" class="tab-pane">
                    <div class="container p-5 border shadow-lg">
                        @foreach ($overtime as $data)
                        <div class="card shadow-sm my-5" style="height: 200px">
                            <div class="row w-100 mx-auto m-0 h-100 p-0">
                                <div class="col-2 text-center alert-secondary py-5 h-100">
                                    <div class="pt-5 mt-3">
                                        <p class="m-0">Attendance Date</p>
                                        <h2>{{ $data->attendance_date }}</h2>
                                        <p class="m-0 mt-4">Total Hours</p>
                                        <h6>{{ $data->total_overtime_hours }}</h6>
                                    </div>
                                </div>
                                <div class="col text-center p-0">
                                    <h5 class="w-100 alert-light p-2">Time in</h5>
                                    <h3 class="text-success">{{ $data->time_in }}</h3>
                                    <p class="m-0">Schedule:</p>
                                    <h5 class="text-secondary">{{ $employee->schedule_Timein }}</h5>

                                    <h5 class="w-100 alert-light p-2 mt-4">Time out</h5>
                                    <h3 class="text-success">{{ $data->time_out }}</h3>
                                    <p class="m-0">Schedule:</p>
                                    <h5 class="text-secondary">{{ $employee->schedule_Timeout }}</h5>
                                </div>
                                <div class="col p-0">
                                    <h5 class="w-100 alert-light p-2 text-center">Details</h5>
                                    {!! Form::textarea('', $data->message, ['class'=>'form-control w-100 m-0','readonly']) !!}
                                </div>
                                <div class="col p-4">
                                    @if(isset($data->status))
                                        @if ($data->status)
                                            <div class="card shadow-sm h-100 w-100 text-center">
                                                <h5 class="w-100 p-3 alert-light">Approval Status</h5>
                                                <h3 class="text-primary w-100 p-4 alert-primary">Approved</h3>
                                                <div class="alert-light w-100 m-0">
                                                    <p class="p-0 m-0">Updated on:</p>
                                                    <h5>{{ $data->approval_date }}</h5>
                                                    <p class="p-0 m-0">Updated by:</p>
                                                    <h5>{{ $data->approver->fname }} {{ $data->approver->mname }} {{ $data->approver->lname }}</h5>
                                                </div>
                                            </div>
                                        @else
                                            <div class="card shadow-lg h-100 w-100 text-center">
                                                <h5 class="w-100 p-3 alert-light">Approval Status</h5>
                                                <h3 class="text-danger w-100 p-4 alert-danger">Denied</h3>
                                                <div class="alert-light w-100 m-0">
                                                    <p class="p-0 m-0">Updated on:</p>
                                                    <h5>{{ $data->approval_date }}</h5>
                                                    <p class="p-0 m-0">Updated by:</p>
                                                    <h5>{{ $data->approver->fname }} {{ $data->approver->mname }} {{ $data->approver->lname }}</h5>
                                                </div>
                                            </div>
                                        @endif
                                    @else
                                    <form action="/deleteOvertimeApplication" method="POST">
                                        <h4 class="text-secondary border shadow-sm rounded w-100 p-5 w-100 text-center mt-4">No approval yet</h4>
                                        @csrf
                                        {!! Form::hidden('id', $data->id) !!}
                                        <button type="submit" class="btn btn-outline-danger w-100"><i class="bi bi-x-circle h1"></i><br>Cancel Application</button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('.input-daterange').datepicker({
            todayBtn: 'linked',
            format: 'yyyy-mm-dd',
            autoclose: true
        });

        let {
            start_date,
            end_date
        } = getDateToday();
        load_table(start_date, end_date, 1800);

        $('#from_date').val(start_date);
        $('#to_date').val(end_date);

        function load_table(from_date = '', to_date = '', time_filter = '') {
            $('#overtime_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/overtimeJsonEmployee',
                    data: {
                        from_date: from_date,
                        to_date: to_date,
                        time_filter: time_filter
                    }
                },
                columns: [
                    {
                        data: 'attendance_date',
                        render: (data, type, row) => {
                            return `<h4>${data}</h4>`
                        }
                    },
                    {
                        data: 'time_in',
                        render: (data, type, row) => {
                            console.log(row)
                            return `Time in: <h5 class="text-success">${data}</h5>
                                    Schedule: <h5>${row.user_details.schedule_Timein}</h5>`
                        }
                    },
                    {
                        data: 'time_out',
                        render: (data, type, row) => {
                            return `Time out: <h5 class="text-success">${data}</h5>
                                    Schedule: <h5>${row.user_details.schedule_Timeout}</h5>`
                        }
                    },
                    {
                        data: 'total_overtime_hours',
                        render: (data, type, row) => {
                            return `${data}`
                        }
                    },
                    {
                        data: 'attendance_date',
                        render: (data, type, row) => {
                            if(row.applied){
                                return `<button class="btn btn-primary w-100 h-100 m-0"><i class="h2 bi bi-cash"></i><br>Applied for Application</button>`
                            }else{
                                return `<button type="button" class="btn btn-outline-success w-100 h-100 m-0" data-toggle="modal"
                                onclick='selectAttendance(
                                    this,
                                    ${row.attendance_id},
                                    "${row.attendance_date}",
                                    "${row.time_in}",
                                    "${row.user_details.schedule_Timein}",
                                    "${row.time_out}",
                                    "${row.user_details.schedule_Timeout}")'
                                data-target="#pay_ot_modal" id="btn_select"><i class="h2 bi bi-cash"></i><br>Select for Application</button>`
                            }
                        }
                    },
                ]
            })
        }

        $('#filter').click(function() {
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            var time_filter = $('#time_filter').find(":selected").val()
            if (from_date != '' && to_date != '') {
                $('#overtime_table').DataTable().destroy();
                load_table(from_date, to_date, time_filter);
            } else {
                alert('Both Date is required');
            }
        });

        $('#refresh').click(function() {
            let {
                start_date,
                end_date
            } = getDateToday();
            $('#from_date').val(start_date);
            $('#to_date').val(end_date);
            $("#time_filter").val('1800').change();;
            $('#overtime_table').DataTable().destroy();
            load_table(start_date, end_date, 1800);
        });
    })

    function selectAttendance(btn,attendance_id,attendance_date,time_in,time_in_sched,time_out,time_out_sched){
        var select = document.querySelectorAll("#btn_select")
        select.forEach(element => {
            element.classList.add("btn-outline-success")
            element.classList.remove("btn-success")
        });

        btn.classList.toggle("btn-outline-success")
        btn.classList.toggle("btn-success")

        document.getElementById('attendance_id').value = attendance_id
        document.getElementById('attendance_date').value = attendance_date

        document.getElementById('time_in').innerHTML = time_in
        document.getElementById('time_in_sched').innerHTML = time_in_sched
        document.getElementById('time_out').innerHTML = time_out
        document.getElementById('time_out_sched').innerHTML = time_out_sched
    }

    function getDateToday() {
        var today = new Date();
        var start_date = ''
        var end_date = ''

        if (today.getDate() < 16) {
            start_date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + 1;
            end_date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + 15;
        } else {
            start_date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + 16;
            end_date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + 30;
        }

        return {
            start_date,
            end_date
        };
    }
</script>
@endsection
