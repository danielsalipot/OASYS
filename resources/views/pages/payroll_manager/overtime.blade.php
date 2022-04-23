@extends('layout.payroll_app')
    @section('content')
    <div class="row mt-4">
        <div class="col-1" style="width:6vw"></div>
        <div class="col">
                <h1 class="section-title mt-4 pb-1 w-100 text-center">Overtime Management</h1>

                <div id="myCarousel" class="carousel carousel-dark  slide" data-interval="false" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
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
                                    <input type="text" name="from_date" id="from_date" class="form-control h-100" placeholder="From Date" readonly />
                                </div>
                                <div class="col-md-2 input-daterange">
                                    <input type="text" name="to_date" id="to_date" class="form-control h-100" placeholder="To Date" readonly />
                                </div>
                                <div class="col-2 input-daterange">
                                    <button type="button" name="filter" id="filter" class="btn h-100 w-25 btn-outline-primary">Filter</button>
                                    <button type="button" name="refresh" id="refresh" class="btn h-100 w-25 btn-outline-success">Refresh</button>
                                </div>
                            </div>
                            <table class="table table-striped table-dark text-center" id="overtime_table">
                                <thead>
                                    <tr>
                                        <th scope="col">Attendance Id</th>
                                        <th scope="col">Employee Details</th>
                                        <th scope="col">Time in</th>
                                        <th scope="col">Time out</th>
                                        <th scope="col">Total Overtime Hours</th>
                                        <th scope="col">Attendance Date</th>
                                        <th scope="col">Pay Overtime</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                        <div class="item">
                            <div class="container w-100 text-center">
                                <h1 class="display-4 pb-5 mt-5 text-center w-100">Paid Overtime</h1>
                            </div>
                            <div class="w-75 m-auto">
                                <table class="table table-striped table-dark text-center w-100" id="paid_overtime_table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Employee Details</th>
                                            <th scope="col">Time in</th>
                                            <th scope="col">Time out</th>
                                            <th scope="col">Total Overtime<br>Hours</th>
                                            <th scope="col">Attendance Date</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>

                    <a class="carousel-control-prev" href="#myCarousel" style="height:0px;margin-top:55px;margin-left:27vw" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#myCarousel" style="height:0px;margin-top:55px;margin-right:27vw" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal" id="edit_modal">
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
                    <div class="row">
                        <div class="col">
                            {!! Form::open(['action'=>'App\Http\Controllers\Payroll\PayrollInsertController@InsertOvertime', 'method'=>'GET']) !!}
                                {!! Form::hidden('emp_id','',['id'=>'emp_id']) !!}
                                {!! Form::hidden('attendance_id','',['id'=>'attendance_id']) !!}
                                {!! Form::submit('Pay Overtime', ['class' => ' w-100 btn btn-primary']) !!}
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

    <script>
        $(document).ready(function(){
            $('.input-daterange').datepicker({
                todayBtn:'linked',
                format:'yyyy-mm-dd',
                autoclose:true
            });

            let { start_date, end_date } = getDateToday();
            load_table(start_date,end_date,1800);

            $('#from_date').val(start_date);
            $('#to_date').val(end_date);

            function load_table(from_date = '', to_date = '', time_filter =''){
                $('#overtime_table').DataTable({
                    processing: true,
                    serverSide: false,
                    ajax: {
                            url: '/overtimejson',
                            data: {
                                from_date: from_date,
                                to_date: to_date,
                                time_filter: time_filter
                            },
                            dataSrc: ''
                        },
                    columns: [
                        { data: 'attendance_id',
                            render : (data,type,row)=>{
                                return `${data}`
                            }
                        },
                        { data: 'user_details.fname',
                            render : (data,type,row)=>{
                                return `<h4>${data} ${row.user_details.mname} ${row.user_details.lname}</h4>
                                        ${row.user_details.position}<br>
                                        ${row.user_details.department}
                                        `
                            }
                        },
                        { data: 'time_in',
                            render : (data,type,row)=>{
                                return `Time in: <h5 class="text-success">${data}</h5>
                                        Schedule: <h5>${row.user_details.schedule_Timein}</h5>`
                            }
                        },
                        { data: 'time_out',
                            render : (data,type,row)=>{
                                return `Time out: <h5 class="text-success">${data}</h5>
                                        Schedule: <h5>${row.user_details.schedule_Timeout}</h5>`
                            }
                        },
                        { data: 'total_overtime_hours',
                            render : (data,type,row)=>{
                                return `${data}`
                            }
                        },
                        { data: 'attendance_date',
                            render : (data,type,row)=>{
                                return `${data}`
                            }
                        },
                        { data: 'attendance_date',
                            render : (data,type,row)=>{
                                var full_name = `${row.user_details.fname} ${row.user_details.mname} ${row.user_details.lname}`
                                return `<button type="button" onclick="payOvetimeClick(
                                    '${row.employee_id}',
                                    '${row.attendance_id}',
                                    '${full_name}',
                                    '${row.user_details.department}',
                                    '${row.user_details.position}',
                                    '${data}',
                                    '${row.time_out}',
                                    '${row.user_details.schedule_Timeout}',
                                    '${row.total_overtime_hours}')"
                                    class="btn btn-success" data-toggle="modal" data-target="#edit_modal">Pay Overtime</button>`
                            }
                        },
                    ]
                })
            }

            load_paid_table()
            function load_paid_table(){
                $('#paid_overtime_table').DataTable({
                    processing: true,
                    serverSide: false,
                    ajax: {
                            url: '/getPaidOvertime',
                            dataSrc: ''
                        },
                    columns: [
                        { data: 'fname',
                            render : (data,type,row)=>{
                                return `<b>${data} ${row.mname} ${row.lname}</b><br>
                                        ${row.position}<br>
                                        ${row.department}`
                            }
                        },
                        { data: 'time_in',
                            render : (data,type,row)=>{
                                return `Time in: <h5 class="text-success">${data}</h5>
                                        Schedule: <h5>${row.schedule_Timein}</h5>`
                            }
                        },
                        { data: 'time_out',
                            render : (data,type,row)=>{
                                return `Time out: <h5 class="text-success">${data}</h5>
                                        Schedule: <h5>${row.schedule_Timeout}</h5>`
                            }
                        },
                        { data: 'total_overtime_hours',
                            render : (data,type,row)=>{
                                return `${data}`
                            }
                        },
                        { data: 'attendance_date',
                            render : (data,type,row)=>{
                                return `${data}`
                            }
                        }
                    ]
            })
        }

            $('#filter').click(function(){
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                var time_filter = $('#time_filter').find(":selected").val()
                if(from_date != '' &&  to_date != ''){
                    $('#overtime_table').DataTable().destroy();
                    load_table(from_date, to_date,time_filter);
                }else{
                    alert('Both Date is required');
                }
            });

            $('#refresh').click(function(){
                let { start_date, end_date } = getDateToday();
                $('#from_date').val(start_date);
                $('#to_date').val(end_date);
                $("#time_filter").val('1800').change();;
                $('#overtime_table').DataTable().destroy();
                load_table(start_date,end_date,1800);
            });
        })

        function payOvetimeClick(emp_id, attendance_id, emp_name, emp_department, emp_position, emp_attendance_date, emp_sched_time_out, emp_time_out, emp_extra_hours){
            $('#emp_id').val(emp_id)
            $('#attendance_id').val(attendance_id)
            $('#emp_name').html(`<b>Employee Name: </b><br>${emp_name}`)
            $('#emp_position').html(`<b>Position: </b><br>${emp_position}`)
            $('#emp_department').html(`<b>Department: </b><br>${emp_department}`)
            $('#emp_attendance_date').html(`<b>Date of Attendance: </b><br>${emp_attendance_date}`)
            $('#emp_sched_time_out').html(`<b>Schedule: </b>${emp_sched_time_out}`)
            $('#emp_time_out').html(`<b>Time out: </b><br>${emp_time_out}`)
            $('#emp_extra_hours').html(`<b>Excess Hours: </b><br>${emp_extra_hours}`)

        }

        function getDateToday(){
            var today = new Date();
            var start_date = ''
            var end_date = ''

            if(today.getDate() < 16){
                start_date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+1;
                end_date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+15;
            }
            else{
                start_date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+16;
                end_date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+30;
            }

            return {start_date,end_date};
        }
    </script>
@endsection
