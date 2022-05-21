@extends('layout.pr_carousel')

@section('Title')
    <h1 class="section-title mt-4 pb-1 w-100 text-center">Overtime Management</h1>
@endsection

@section('first')
    <div class="container">
        <h1 class="display-4 pb-5 mt-5 text-center w-100">Overtime Payments</h1>
        <div class="row mb-2">
            <div class="col-md-2"></div>
            <div class="col-md-2 text-right">
                <b class="me-1">Minimum extra time</b><br>
                <select id="time_filter" class="w-50 p-2">
                    <option value="1800">00:30:00</option>
                    <option value="3600">01:00:00</option>
                    <option value="5400">01:30:00</option>
                    <option value="7200">02:00:00</option>
                </select>
            </div>
            <div class="col-md-2 input-daterange">
                <input type="text" name="from_date" id="from_date" class="form-control h-100" placeholder="From Date"
                    readonly />
            </div>
            <div class="col-md-2 input-daterange">
                <input type="text" name="to_date" id="to_date" class="form-control h-100" placeholder="To Date" readonly />
            </div>
            <div class="col-2 input-daterange">
                <button type="button" name="filter" id="filter" class="btn h-100 w-25 btn-outline-primary">Filter</button>
                <button type="button" name="refresh" id="refresh"
                    class="btn h-100 w-25 btn-outline-success">Refresh</button>
            </div>
        </div>
        <table class="table table-striped table-dark text-center" id="overtime_table">
            <thead>
                <tr>
                    <th class="col">Attendance Id</th>
                    <th class="col">Employee Details</th>
                    <th class="col">Time in</th>
                    <th class="col">Time out</th>
                    <th class="col">Total Overtime Hours</th>
                    <th class="col">Attendance Date</th>
                    <th class="col">Pay Overtime</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

@section('second')
    <div class="container w-100 text-center">
        <h1 class="display-4 pb-5 mt-5 text-center w-100">Paid Overtime</h1>
    </div>

    <div class="m-auto">
        <div class="rounded w-100 py-3 mb-4 shadow-lg">
            <button type="button" class="btn p-3 m-3 w-25 btn-danger" class="btn btn-success" data-toggle="modal"
                data-target="#paid_ot_modal">Remove Overtime</button>
        </div>

        <table class="table table-striped table-dark text-center w-100" id="paid_overtime_table">
            <thead>
                <tr>
                    <th class="col">Select</th>
                    <th class="col">Transaction ID</th>
                    <th class="col">Employee Details</th>
                    <th class="col">Time in</th>
                    <th class="col">Time out</th>
                    <th class="col">Total Overtime<br>Hours</th>
                    <th class="col">Payroll Manager</th>
                    <th class="col">Added on (UTC)</th>
                    <th class="col">Attendance Date</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

@section('modal')
    <!-- The Modal -->
    <div class="modal" id="pay_ot_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title w-100">Continue to Pay Overtime</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body row">
                    <div class="row">
                        <div class="col-7 text-center">
                            <p id='emp_name'></p>
                            <p id='emp_position'></p>
                            <p id='emp_department'></p>
                        </div>
                        <div class="col">
                            <p id='emp_attendance_date'></p>
                            <p id='emp_sched_time_out'></p>
                            <p id='emp_time_out'></p>
                            <p id='emp_extra_hours'></p>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <div class="row w-100 text-center">
                        <div class="col-3 border border-secondary rounded text-center pt-2">
                            {!! Form::open(['action' => 'App\Http\Controllers\Payroll\PayrollInsertController@InsertOvertime', 'method' => 'GET']) !!}
                            {{ Form::label('chk', 'Notifications', ['class' => 'control-label']) }}
                            {!! Form::checkbox('chk', 'value', true,['class'=>'form-check-input']) !!}
                        </div>
                        <div class="col">
                            {!! Form::hidden('emp_id', '', ['id' => 'emp_id']) !!}
                            {!! Form::hidden('attendance_id', '', ['id' => 'attendance_id']) !!}
                            {!! Form::submit('Pay Overtime', ['class' => ' w-100 btn h-100 btn-primary']) !!}
                            {!! Form::close() !!}
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-danger w-100 h-100" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal" id="paid_ot_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title w-100">Continue to Remove Overtime</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body row">
                    <div class="row">
                        <div class="col ps-5">
                            <p class="h5 text-center w-100">Selected Records</p>
                            <hr>
                            <table class="w-100 m-auto text-center">
                                <thead>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Total Overtime Hours</th>
                                    <th>Attendance Date</th>
                                </thead>
                                <tbody>
                                    <td>
                                        <h6 id='modal_emp_id'></h6>
                                    </td>
                                    <td>
                                        <h6 id='modal_emp_names'></h6>
                                    </td>
                                    <td>
                                        <h6 id='modal_total_hours'></h6>
                                    </td>
                                    <td>
                                        <h6 id='modal_attendance_date'></h6>
                                    </td>
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <div class="row">
                        <div class="col">
                            {!! Form::open(['action' => 'App\Http\Controllers\Payroll\PayrollDeleteController@DeleteOvertime', 'method' => 'GET']) !!}
                                {!! Form::hidden('overtime_id', '', ['id' => 'overtime_id']) !!}
                                {!! Form::submit('Remove Overtime', ['class' => ' w-100 btn btn-outline-danger']) !!}
                            {!! Form::close() !!}
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-danger w-100 " data-dismiss="modal">Close</button>
                        </div>
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
                        url: '/overtimejson',
                        data: {
                            from_date: from_date,
                            to_date: to_date,
                            time_filter: time_filter
                        }
                    },
                    columns: [{
                            data: 'attendance_id',
                            render: (data, type, row) => {
                                return `${data}`
                            }
                        },
                        {
                            data: 'user_details.fname',
                            render: (data, type, row) => {
                                return `<h4>${data} ${row.user_details.mname} ${row.user_details.lname}</h4>
                                        ${row.user_details.position}<br>
                                        ${row.user_details.department}
                                        `
                            }
                        },
                        {
                            data: 'time_in',
                            render: (data, type, row) => {
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
                                return `${data}`
                            }
                        },
                        {
                            data: 'attendance_date',
                            render: (data, type, row) => {
                                var full_name =
                                    `${row.user_details.fname} ${row.user_details.mname} ${row.user_details.lname}`
                                return `<button type="button" onclick="payOvetimeClick(
                                    '${row.employee_id}',
                                    '${row.attendance_id}',
                                    '${full_name}',
                                    '${row.user_details.department}',
                                    '${row.user_details.position}',
                                    '${data}',
                                    '${row.user_details.schedule_Timeout}',
                                    '${row.time_out}',
                                    '${row.total_overtime_hours}')"
                                    class="btn btn-success" data-toggle="modal" data-target="#pay_ot_modal"><i class="h2 bi bi-cash"></i><br>Pay Overtime</button>`
                            }
                        },
                    ]
                })
            }

            load_paid_table()

            function load_paid_table() {
                $('#paid_overtime_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '/getPaidOvertime'
                    },
                    columns: [{
                            data: 'employee_id',
                            render: (data, type, row) => {
                                return `<button type="button"
                                onclick="selectRecord(this,'${row.overtime_id}','${data}', '${row.fname} ${row.mname} ${row.lname}','${row.total_overtime_hours}','${row.attendance_date}')"
                                class="btn btn-outline-primary">Select</button>`
                            }
                        },
                        {
                            data: 'overtime_id',
                            render: (data, type, row) => {
                                return `${data}`
                            }
                        },
                        {
                            data: 'fname',
                            render: (data, type, row) => {
                                return `<b>${data} ${row.mname} ${row.lname}</b><br>
                                        ${row.position}<br>
                                        ${row.department}`
                            }
                        },
                        {
                            data: 'time_in',
                            render: (data, type, row) => {
                                return `Time in: <h5 class="text-success">${data}</h5>
                                        Schedule: <h5>${row.schedule_Timein}</h5>`
                            }
                        },
                        {
                            data: 'time_out',
                            render: (data, type, row) => {
                                return `Time out: <h5 class="text-success">${data}</h5>
                                        Schedule: <h5>${row.schedule_Timeout}</h5>`
                            }
                        },
                        {
                            data: 'total_overtime_hours',
                            render: (data, type, row) => {
                                return `${data}`
                            }
                        },
                        { data: 'payroll_manager',
                            render : (data,type,row)=>{
                                return `<b>${data}</b>`
                            }
                        },
                        { data: 'added_on',
                            render : (data,type,row)=>{
                                return `<b>${data}</b>`
                            }
                        },
                        {
                            data: 'attendance_date',
                            render: (data, type, row) => {
                                return `${data}`
                            }
                        }
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

        function payOvetimeClick(emp_id, attendance_id, emp_name, emp_department, emp_position, emp_attendance_date,
            emp_sched_time_out, emp_time_out, emp_extra_hours) {
            $('#emp_id').val(emp_id)
            $('#attendance_id').val(attendance_id)
            $('#emp_name').html(`<h5>Employee Name: </h5>${emp_name}`)
            $('#emp_position').html(`<h5>Position: </h5>${emp_position}`)
            $('#emp_department').html(`<h5>Department: </h5>${emp_department}`)
            $('#emp_attendance_date').html(`<h5>Date of Attendance: </h5>${emp_attendance_date}`)
            $('#emp_sched_time_out').html(`<h5>Schedule: </h5>${emp_sched_time_out}`)
            $('#emp_time_out').html(`<h5>Time out: </h5>${emp_time_out}`)
            $('#emp_extra_hours').html(`<h5>Excess Hours: </h5>${emp_extra_hours}`)

        }

        function selectRecord(btn, ot_id, id, emp_name, ttl_hours, date) {
            if (btn.innerHTML == "Select") {
                btn.innerHTML = 'Selected'
                btn.className = 'btn btn-success';

                $('#overtime_id').val(`${$('#overtime_id').val()}${ot_id};`)

                $('#modal_emp_id').html(`${$('#modal_emp_id').html()}${id}<br>`)
                $('#modal_emp_names').html(`${$('#modal_emp_names').html()}${emp_name}<br>`)
                $('#modal_total_hours').html(`${$('#modal_total_hours').html()}${ttl_hours}<br>`)
                $('#modal_attendance_date').html(`${$('#modal_attendance_date').html()}${date}<br>`)

            } else {
                btn.innerHTML = 'Select'
                btn.className = 'btn btn-outline-primary text-primary';

                $('#overtime_id').val($('#overtime_id').val().replace(`${ot_id};`,''))

                $('#modal_emp_id').html(`${$('#modal_emp_id').html().replace(`${id}<br>`,'')}`)
                $('#modal_emp_names').html(`${$('#modal_emp_names').html().replace(`${emp_name}<br>`,'')}`)
                $('#modal_total_hours').html(`${$('#modal_total_hours').html().replace(`${ttl_hours}<br>`,'')}`)
                $('#modal_attendance_date').html(`${$('#modal_attendance_date').html().replace(`${date}<br>`,'')}`)
            }
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

{{-- <div class="row w-100">
       <div class="col-3 border border-secondary rounded text-center pt-2">

    </div>
    <div class="col">


    </div>
    <div class="col">

    </div>
</div> --}}
