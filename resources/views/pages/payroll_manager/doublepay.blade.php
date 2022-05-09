@extends('layout.pr_carousel')

@section('Title')
<h1 class="section-title w-100 text-center mt-5 pb-5">Multi Pay Managament</h1>
@endsection

@section('first')
        {{-- START --}}
    <div class="container">
        <h1 class="display-4 pb-5 mt-5 text-center w-100">Multi Pay History</h1>
        @include('inc.date_filter')
        <table class="table table-striped text-center table-dark" id="multi_pay_table">
            <thead>
                <tr>
                    <th scope="col">Employee ID</th>
                    <th scope="col">Employee Details</th>
                    <th scope="col">Employee rate</th>
                    <th scope="col">Time in Detials</th>
                    <th scope="col">Time out Details</th>
                    <th scope="col">Total Hours</th>
                    <th scope="col">Attendance Date</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
        </table>
    </div>
        {{-- END --}}
@endsection

@section('second')
        <div class="container">
            <h1 class="display-4 pb-5 mt-5 text-center w-100">Multi Pay History</h1>
                <div class="row mb-3 mt-3">
                    <div class="col-md-2 input-daterange">
                        <input type="text" name="paid_from_date" id="paid_from_date" class="form-control p-3 h-100" placeholder="From Date" readonly />
                    </div>
                    <div class="col-md-2 input-daterange">
                        <input type="text" name="paid_to_date" id="paid_to_date" class="form-control h-100" placeholder="To Date" readonly />
                    </div>
                    <div class="col-2 input-daterange">
                        <button type="button" name="paid_filter" id="paid_filter" class="btn h-100 w-25 btn-outline-primary">Filter</button>
                        <button type="button" name="paid_refresh" id="paid_refresh" class="btn h-100 w-25 btn-outline-success">Refresh</button>
                    </div>
                </div>
                <table class="table table-striped text-center w-100 table-dark" id="paid_table">
                    <thead>
                        <tr>
                            <th scope="col">Transaction ID</th>
                            <th scope="col">Employee Details</th>
                            <th scope="col">Employee Rate</th>
                            <th scope="col">Time in Details</th>
                            <th scope="col">Time out Detials</th>
                            <th scope="col">Total hours</th>
                            <th scope="col">Multiplier</th>
                            <th scope="col">Total Compensation</th>
                            <th scope="col">Attendance Date</th>
                            <th scope="col">Payroll Manager</th>
                            <th scope="col">Added on (UTC)</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('modal')
     <!-- The Modal -->
     <div class="modal" id="edit_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title w-100">Continue to Multiply Payment</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body row">
                    <div class="row">
                        <div class="col text-center ps-5">
                            <p class="h5 text-center w-100">Attendance Detail</p>
                            <hr>
                            <p id='modal_emp_details'></p>
                            <div class="row">
                                <h6>Attendance Date</h6>
                                <p id="modal_attendance_date"></p>
                                <div class="col">
                                    <h6>Time in Details</h6>
                                    <p id="modal_time_in_details"></p>
                                </div>
                                <div class="col">
                                    <h6>Time out Details</h6>
                                    <p id="modal_time_out_details"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <p class="h5 text-center w-100">Salary Payment Details</p>

                            <hr>
                            <div class="row">
                                <div class="col">
                                    <h6>Employee Rate</h6>
                                    {!! Form::text('modal_employee_rate', 'from date', ['disabled','id'=>'modal_employee_rate','class'=>'p-2 w-100 text-center']) !!}
                                </div>
                                <div class="col">
                                    <h6>Employee Total hours</h6>
                                    {!! Form::text('modal_employee_hours', 'from date', ['disabled','id'=>'modal_employee_hours','class'=>'p-2 w-100 text-center']) !!}
                                </div>
                            </div>
                            <hr>
                            <h6>Salary Multiplier</h6>
                            {!! Form::text('modal_multiplier', 'date', ['disabled','id'=>'modal_multiplier','class'=>'p-2 w-100 text-center']) !!}

                            <hr>
                            <h6>Total Payment</h6>
                            {!! Form::text('modal_total_payment', 'date', ['disabled','id'=>'modal_total_payment','class'=>'p-2 w-100 text-center']) !!}
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <div class="row">
                        <div class="col">
                            {!! Form::open(['action'=>'App\Http\Controllers\Payroll\PayrollInsertController@InsertMultiPay']) !!}
                                {!! Form::hidden('hidden_emp_id','',['id'=>'hidden_emp_id']) !!}
                                {!! Form::hidden('hidden_attendance_id','',['id'=>'hidden_attendance_id']) !!}
                                {!! Form::hidden('hidden_status','',['id'=>'hidden_status']) !!}
                                {!! Form::submit('Confirm Multi Pay', ['class' => ' w-100 btn btn-success']) !!}
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
        $(document).ready(function(){
            $('.input-daterange').datepicker({
                todayBtn:'linked',
                format:'yyyy-mm-dd',
                autoclose:true
            });

            let { start_date, end_date } = getDateToday();
            load_table(start_date,end_date);
            load_paid_table(start_date,end_date);

            $('#from_date').val(start_date);
            $('#to_date').val(end_date);

            $('#paid_from_date').val(start_date);
            $('#paid_to_date').val(end_date);

            function load_table(from_date = '', to_date = ''){
                $('#multi_pay_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: { url: '/fetchattendancejson',
                            data:{
                                from_date: from_date,
                                to_date: to_date
                            }
                        },
                    columns: [
                        { data: 'employee_id',
                            render : (data,type,row)=>{
                                return `<b>${data}</b>`
                            }
                        },
                        { data: 'fname',
                            render : (data,type,row)=>{
                                return `<b>${data} ${row.mname} ${row.lname}</b><br>
                                            ${row.department}<br>
                                            ${row.position}`
                            }
                        },
                        { data: 'rate',
                            render : (data,type,row)=>{
                                return `<b>₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</b>`
                            }
                        },
                        { data: 'time_in',
                            render : (data,type,row)=>{
                                if(row.late){
                                    return `Time in:<br>
                                    <b class="text-danger">${data}</b><br>
                                    Schedule: <br>
                                    <b>${row.schedule_Timeout}</b>
                                    `
                                }

                                return `Time in:<br>
                                    <b class="text-success">${data}</b><br>
                                    Schedule: <br>
                                    <b>${row.schedule_Timeout}</b>
                                    `
                            }
                        },
                        { data: 'time_out',
                            render : (data,type,row)=>{
                                if(row.under){
                                    return `Time in:<br>
                                    <b class="text-danger">${data}</b><br>
                                    Schedule: <br>
                                    <b>${row.schedule_Timeout}</b>
                                    `
                                }

                                return `Time in:<br>
                                    <b class="text-success">${data}</b><br>
                                    Schedule: <br>
                                    <b>${row.schedule_Timeout}</b>
                                    `
                            }
                        },
                        { data: 'total_hours',
                            render : (data,type,row)=>{
                                if(row.overtime){
                                    return `<b>${data}</b><br>
                                            <h6 class="text-info">Overtime</h6>`
                                }
                                return `<b>${data}</b>`
                            }
                        },
                        { data: 'attendance_date',
                            render : (data,type,row)=>{
                                return `<b>${data}</b>`
                            }
                        },
                        { data: 'employee_id',
                            render : (data,type,row)=>{
                                return `
                                <button type="button" onclick="MultiPayButtonClick(
                                    2,
                                    '${row.attendance_id}',
                                    '${row.attendance_date}',
                                    '${row.total_hours}',
                                    '${row.employee_id}',
                                    '${row.fname.replace("\'","\\'")} ${row.mname.replace("\'","\\'")} ${row.lname.replace("\'","\\'")}',
                                    '${row.department}',
                                    '${row.position}',
                                    '${row.rate}',
                                    '${row.schedule_Timein}',
                                    '${row.schedule_Timeout}',
                                    '${row.time_in}',
                                    '${row.time_out}',

                                )" class="btn btn-outline-warning" data-toggle="modal" data-target="#edit_modal">2X</button>
                                <button type="button" onclick="MultiPayButtonClick(
                                    3,
                                    '${row.attendance_id}',
                                    '${row.attendance_date}',
                                    '${row.total_hours}',
                                    '${row.employee_id}',
                                    '${row.fname.replace("\'","\\'")} ${row.mname.replace("\'","\\'")} ${row.lname.replace("\'","\\'")}',
                                    '${row.department}',
                                    '${row.position}',
                                    '${row.rate}',
                                    '${row.schedule_Timein}',
                                    '${row.schedule_Timeout}',
                                    '${row.time_in}',
                                    '${row.time_out}',

                                )" class="btn btn-outline-info" data-toggle="modal" data-target="#edit_modal">3X</button>`
                            }
                        },
                    ]
                })
            }

            function load_paid_table(from_date = '', to_date = ''){
                $('#paid_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: { url: '/doublepayjson',
                            data:{
                                from_date: from_date,
                                to_date: to_date
                            }
                        },
                    columns: [
                        { data: 'multi_pay_id',
                            render : (data,type,row)=>{
                                return `<b>${data}</b>`
                            }
                        },
                        { data: 'fname',
                            render : (data,type,row)=>{
                                return `<h5>${data} ${row.mname} ${row.lname}</h5>
                                        ${row.department}<br>
                                        ${row.position}`
                            }
                        },
                        { data: 'rate',
                            render : (data,type,row)=>{
                                return `<b>₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</b>`
                            }
                        },
                        { data: 'time_in',
                            render : (data,type,row)=>{
                                if(row.late){
                                    return `Time in:<br>
                                    <b class="text-danger">${data}</b><br>
                                    Schedule: <br>
                                    <b>${row.schedule_Timeout}</b>
                                    `
                                }

                                return `Time in:<br>
                                    <b class="text-success">${data}</b><br>
                                    Schedule: <br>
                                    <b>${row.schedule_Timeout}</b>
                                    `
                            }
                        },
                        { data: 'time_out',
                            render : (data,type,row)=>{
                                if(row.under){
                                    return `Time in:<br>
                                    <b class="text-danger">${data}</b><br>
                                    Schedule: <br>
                                    <b>${row.schedule_Timeout}</b>
                                    `
                                }

                                return `Time in:<br>
                                    <b class="text-success">${data}</b><br>
                                    Schedule: <br>
                                    <b>${row.schedule_Timeout}</b>
                                    `
                            }
                        },
                        { data: 'total_hours',
                            render : (data,type,row)=>{
                                if(row.overtime){
                                    return `<b>${data}</b><br>
                                            <h6 class="text-info">Overtime</h6>`
                                }
                                return `<b>${data}</b>`
                            }
                        },
                        { data: 'status',
                            render : (data,type,row)=>{
                                if(data == 2){
                                    return `<b class="text-warning">${data}X</b>`
                                }
                                return `<b class="text-info">${data}X</b>`
                            }
                        },
                        { data: 'total_compensation',
                            render : (data,type,row)=>{
                                return `<b>₱${(data).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</b>`
                            }
                        },
                        { data: 'attendance_date',
                            render : (data,type,row)=>{
                                return `<b>${data}</b>`
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
                        {   data: 'employee_id',
                            render : (data,type,row)=>{
                                return row.delete
                            }
                        }
                    ]
                })
            }

            $('#filter').click(function(){
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                if(from_date != '' &&  to_date != ''){
                    $('#multi_pay_table').DataTable().destroy();
                    load_table(from_date, to_date);
                }else{
                    alert('Both Date is required');
                }
            });

            $('#refresh').click(function(){
                let { start_date, end_date } = getDateToday();
                $('#from_date').val(start_date);
                $('#to_date').val(end_date);
                $('#multi_pay_table').DataTable().destroy();
                load_table(start_date,end_date);
            });

            $('#paid_filter').click(function(){
                var from_date = $('#paid_from_date').val();
                var to_date = $('#paid_to_date').val();
                if(from_date != '' &&  to_date != ''){
                    $('#paid_table').DataTable().destroy();
                    load_paid_table(from_date, to_date);
                }else{
                    alert('Both Date is required');
                }
            });

            $('#paid_refresh').click(function(){
                let { start_date, end_date } = getDateToday();
                $('#paid_from_date').val(start_date);
                $('#paid_to_date').val(end_date);
                $('#paid_table').DataTable().destroy();
                load_paid_table(start_date,end_date);
            });
        })

        function getDateToday(){
            var today = new Date();
            var start_date = ''
            var end_date = ''

            if(today.getDate() < 16){
                start_date = formatDate(today.getFullYear()+'-'+(today.getMonth()+1)+'-'+1);
                end_date = formatDate(today.getFullYear()+'-'+(today.getMonth()+1)+'-'+15);
            }
            else{
                start_date = formatDate(today.getFullYear()+'-'+(today.getMonth()+1)+'-'+16);
                end_date = formatDate(today.getFullYear()+'-'+(today.getMonth()+1)+'-'+30);
            }

            return {start_date,end_date};
        }


        function formatDate(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2)
                month = '0' + month;
            if (day.length < 2)
                day = '0' + day;

            return [year, month, day].join('-');
        }

        function MultiPayButtonClick(
            multiplier,
            attendance_id,
            attendance_date,
            total_hours,
            emp_id,
            emp_name,
            emp_department,
            emp_position,
            emp_rate,
            emp_sched_in,
            emp_sched_out,
            emp_time_in,
            emp_time_out)
            {

            $('#modal_emp_details').html(`<b>${emp_name}</b><br>
                ${emp_department}<br>
                ${emp_position}`)

            $('#modal_attendance_date').html(attendance_date)

            $('#modal_employee_hours').val(total_hours)
            $('#modal_employee_rate').val(emp_rate)
            $('#modal_multiplier').val(multiplier)

            $('#hidden_emp_id').val(emp_id)
            $('#hidden_attendance_id').val(attendance_id)
            $('#hidden_status').val(multiplier)

            $('#modal_total_payment').val(Math.round(((emp_rate * total_hours) * multiplier )* 100) / 100)

            $('#modal_time_in_details').html(`Time in:<br>
                <b class="text-success">${emp_time_in}</b><br>
                Schedule:<br>
                <b>${emp_sched_in}</b>`)

            $('#modal_time_out_details').html(`Time in:<br>
                <b class="text-success">${emp_time_out}</b><br>
                Schedule:<br>
                <b>${emp_sched_out}</b>`)
        }

    </script>

@endsection
