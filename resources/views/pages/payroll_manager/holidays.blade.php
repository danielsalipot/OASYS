@extends('layout.pr_carousel')

@section('Title')
    <h1 class="section-title mt-5 pb-5 text-center w-100">Holidays Management</h1>
@endsection

@section('first')
<div class="container">
    <h1 class="display-4 pb-5 mt-5 text-center w-100">Listed Holidays</h1>
    <div class="row my-4">
        <div class="col-8">
            <div id="calendar"></div>
        </div>
        <div class="col card shadow-sm p-3" style="height:660px;overflow-y:scroll">
            <h1 class="alert alert-primary p-3 text-center w-100">List a Holiday</h1>
            <div class="card shadow-sm p-4 ">
                {!! Form::open(['action'=>'App\Http\Controllers\Payroll\PayrollInsertController@InsertHoliday']) !!}
                <div class="row p-4">
                    <h5 class="text-center">Start Date</h5>
                    {!! Form::text('holiday_name', '' , ['class' =>'form-control p-3 text-center w-100 m' ,'placeholder'=>'Holiday Name']) !!}
                </div>
                <div class="row input-daterange p-3">
                    <div class="col">
                        <h5 class="text-center">Start Date</h5>
                        <input type="text" name="insert_start_date" id="insert_start_date" class="form-control " placeholder="Start Date" readonly />
                    </div>
                    <div class="col-1 text-center">
                        <h5 class="text-center">to</h5>
                        <h3>-</h3></div>
                    <div class="col">
                        <h5 class="text-center">End Date</h5>
                        <input type="text" name="insert_end_date" id="insert_end_date" class="form-control" placeholder="End Date" readonly />
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col text-center">
                        {!! Form::submit('Add Holiday', ['class'=>'btn btn-primary w-75 p-3 ']) !!}
                    </div>
                    <div class="col text-center">
                        <button type="button" class="btn btn-danger w-75 p-3">Cancel</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>

            <div class="card p-3 shadow-sm mt-5">
                <h5 class="alert alert-danger p-3 text-center w-100">Delete a Holiday</h5>

            <div class="row input-daterange p-3">
                <div class="col">
                    <input type="text" name="cal_from_date" id="cal_from_date" class="form-control " placeholder="Start Date" readonly />
                </div>
                <div class="col">
                    <input type="text" name="cal_to_date" id="cal_to_date" class="form-control" placeholder="End Date" readonly />
                </div>
                <div class="col-2">
                    <button type="button" name="cal_filter" id="cal_filter" class="btn w-100 h-100 btn-outline-primary">Filter</button>
                </div>
                <div class="col-2">
                    <button type="button" name="cal_refresh" id="cal_refresh" class="btn w-100 h-100 btn-outline-success">Refresh</button>
                </div>
            </div>

            <table class="table table-striped table-dark" id="delete_table">
                <thead>
                    <tr>
                        <th scope="col">Holiday Name</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
            </table>
            </div>
        </div>
    </div>

</div>
@endsection

@section('second')
<div class="container">
    <h1 class="display-4 pb-5 mt-5 text-center w-100">Add Holiday Pay</h1>
    <div class="row">
        <div class="col">
            <h5 class="w-100 text-center">Pay All Employee Holiday</h5>
            <button onclick="select_all(this)" id="selectAll" class="w-100 p-4 btn btn-primary">Select All Employee</button>

            <hr>

            <h5 class="w-100 text-center">Pay Selected Employee Holiday</h5>
            <div class="container w-100">
                <table class="table w-100 table-striped text-center table-dark" id="employee_table">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Employee Picture</th>
                            <th scope="col">Employee Name</th>
                            <th scope="col">Department</th>
                            <th scope="col">Position</th>
                            <th scope="col">Select</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="col">
            <div class="container">
                <h1 class="display-5 m-3 text-center w-100">Selected Employees</h1>
                <table class="table table-striped text-center">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Employee Picture</th>
                            <th scope="col">Employee Name</th>
                            <th scope="col">Department</th>
                            <th scope="col">Position</th>
                        </tr>
                    </thead>
                    <tbody id="selected_employee_table"></tbody>
                </table>
                <div id="select_all_div"></div>
            </div>

            <div class="container card shadow-lg p-4">
                <h1 class="display-5 mb-3 text-center w-100">Holiday Detail</h1>
                <div class="m-3 px-5">
                    {!! Form::open(['action'=>'App\Http\Controllers\Payroll\PayrollInsertController@InsertAttendanceHoliday']) !!}
                    <select onchange="select_holiday()" class="h4 p-4 w-100" name="holiday" id="holiday">
                        <option value="">Select Holiday</option>
                        @foreach ($holidays as $item)
                            <option value="{{$item}}">{{ $item->holiday_name }}</option>
                        @endforeach
                    </select>
                    <div class="row my-4">
                        <div class="col">
                            <h4 class="text-center">Start Date</h4>
                            <input type="text" name="emp_start_date" id="emp_start_date" class="form-control text-center" placeholder="Start Date" readonly />
                        </div>
                        <div class="col">
                            <h4 class="text-center">End Date</h4>
                            <input type="text" name="emp_end_date" id="emp_end_date" class="form-control text-center" placeholder="End Date" readonly />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col text-center">
                            {!! Form::hidden('selected_all',0,['id'=>'selected_all']) !!}
                            {!! Form::hidden('ids','',['id'=>'hidden_id']) !!}
                                {!! Form::submit('Submit', ['class'=>"btn btn-primary w-100 p-3"]) !!}
                            {!! Form::close() !!}
                        </div>
                        <div class="col-3 text-center">
                            <button class="btn btn-outline-danger w-100 p-3">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra')
<div class="item">
    <div class="container w-100">
        <h1 class="display-4 pb-5 mt-5 text-center w-100">Holiday Attendance</h1>
        @include('inc.date_filter')
            <table class="table table-striped text-center table-dark w-100" id="holiday_attendance">
                <thead>
                    <tr>
                        <th scope="col">Employee Details</th>
                        <th scope="col">Holiday Name</th>
                        <th scope="col">Date of Paid Holiday</th>
                        <th scope="col">Holiday Start Date</th>
                        <th scope="col">Holiday End Date</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
            </table>
    </div>
</div>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
    var holidays = {!! $holidays !!}
    var event_list = []
    holidays.forEach(element => {
        event_list.push({
            title: element.holiday_name,
            start: element.holiday_start_date,
            end: element.holiday_end_date,
            allDay: true,
        })
    });
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: event_list

    });

    calendar.render();
});
</script>

<script>
    $(document).ready(function(){
        $('.input-daterange').datepicker({
                todayBtn:'linked',
                format:'yyyy-mm-dd',
                autoclose:true
            });

        $('#employee_table').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: '/employeelistjson'
            },
            columns: [
                { data: 'employee_id',
                    render : (data,type,row)=>{
                        return `<img src="{{ URL::asset('${row.user_detail.picture}')}}" class="rounded" width="50" height="50">`
                    }
                },
                { data: 'user_detail.fname',
                    render : (data,type,row)=>{
                        return `<b>${data} ${row.user_detail.mname} ${row.user_detail.lname}</b>`
                    }
                },
                { data: 'department',
                    render : (data,type,row)=>{
                        return `<b>${data}</b>`
                    }
                },
                { data: 'position',
                    render : (data,type,row)=>{
                        return `<b>${data}</b>`
                    }
                },
                { data: 'employee_id',
                    render : (data,type,row)=>{
                        return row.select
                    }
                }
            ]
        })

        let { start_date, end_date } = getDateToday();
        load_table(start_date,end_date);

        $('#cal_from_date').val(start_date);
        $('#cal_to_date').val(end_date);

        function load_table(from_date = '', to_date = ''){
            $('#delete_table').DataTable({
                processing: true,
                serverSide: false,
                ajax: {
                    url: '/holidayJson',
                    data:{
                        from_date: from_date,
                        to_date: to_date
                    }
                },
                columns: [
                    { data: 'holiday_name',
                        render : (data,type,row)=>{
                            return `<b>${data}</b>`
                        }
                    },
                    { data: 'holiday_start_date',
                        render : (data,type,row)=>{
                            return `<b>${data}</b>`
                        }
                    },
                    { data: 'holiday_end_date',
                        render : (data,type,row)=>{
                            return `<b>${data}</b>`
                        }
                    },
                    { data: 'delete',
                        render : (data,type,row)=>{
                            return `<b>${data}</b>`
                        }
                    }
                ]
            })
        }

        $('#cal_filter').click(function(){
            var from_date = $('#cal_from_date').val();
            var to_date = $('#cal_to_date').val();
            if(from_date != '' &&  to_date != ''){
                $('#delete_table').DataTable().destroy();
                load_table(from_date, to_date);
            }else{
                alert('Both Date is required');
            }
        });

        $('#cal_refresh').click(function(){
            let { start_date, end_date } = getDateToday();
            $('#cal_from_date').val(start_date);
            $('#cal_to_date').val(end_date);
            $('#delete_table').DataTable().destroy();
            load_table(start_date,end_date);
        });

        load_attendance(start_date,end_date);

        $('#from_date').val(start_date);
        $('#to_date').val(end_date);

        function load_attendance(from_date = '', to_date = ''){
            $('#holiday_attendance').DataTable({
                processing: true,
                serverSide: false,
                ajax: {
                    url: '/holidayJsonAttendance',
                    data:{
                        from_date: from_date,
                        to_date: to_date
                    }
                },
                columns: [
                    { data: 'employee_details',
                        render : (data,type,row)=>{
                            return `<b>${data}</b>`
                        }
                    },
                    { data: 'holiday_name',
                        render : (data,type,row)=>{
                            return `<b>${data}</b>`
                        }
                    },
                    { data: 'attendance_date',
                        render : (data,type,row)=>{
                            return `<b>${data}</b>`
                        }
                    },
                    { data: 'holiday_start_date',
                        render : (data,type,row)=>{
                            return `<b>${data}</b>`
                        }
                    },
                    { data: 'holiday_end_date',
                        render : (data,type,row)=>{
                            return `<b>${data}</b>`
                        }
                    },
                    { data: 'delete',
                        render : (data,type,row)=>{
                            return `<b>${data}</b>`
                        }
                    },
                ]
            })
        }

        $('#filter').click(function(){
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            if(from_date != '' &&  to_date != ''){
                $('#holiday_attendance').DataTable().destroy();
                load_table(from_date, to_date);
            }else{
                alert('Both Date is required');
            }
        });

        $('#refresh').click(function(){
            let { start_date, end_date } = getDateToday();
            $('#from_date').val(start_date);
            $('#to_date').val(end_date);
            $('#holiday_attendance').DataTable().destroy();
            load_table(start_date,end_date);
        });


    })

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

    function selectEmployee(btn, emp_id, emp_picture, emp_name, emp_department, emp_position){
            document.getElementById("selectAll").className = 'w-100 p-4 btn btn-primary'
            $(`#selectAll`).html('Select All Employee')
            $('#selected_all').val(0)
            $('#select_all_div').html(``)


            if(btn.innerHTML == "Select"){
                btn.innerHTML = 'Selected'
                btn.className = 'btn btn-success';

                $('#hidden_id').val(`${$('#hidden_id').val()}${emp_id};`)
                $('#selected_employee_table').html(
                `${$('#selected_employee_table').html()}

                <tr>
                    <td><img src="{{ URL::asset('${emp_picture}')}}" class="rounded" width="50" height="50"></td>
                    <td>${emp_name}</td>
                    <td>${emp_department}</td>
                    <td>${emp_position}</td>
                </tr>
                `)
            }else{
                btn.innerHTML = 'Select'
                btn.className = 'btn btn-outline-primary text-primary';

                $('#hidden_id').val($('#hidden_id').val().replace(`${emp_id};`,''))

                $('#selected_employee_table').html($('#selected_employee_table').html().replace(`<tr>
                    <td><img src="{{ URL::asset('${emp_picture}')}}" class="rounded" width="50" height="50"></td>
                    <td>${emp_name}</td>
                    <td>${emp_department}</td>
                    <td>${emp_position}</td>
                </tr>`,''))
            }
        }
</script>

<script>
    function select_all(btn){
        $(`#selectAll`).toggleClass('btn-primary')
        $(`#selectAll`).toggleClass('btn-outline-danger')
        $('#selected_employee_table').html('')
        $('#hidden_id').val('')

        $('#employee_table button').prop('class',"btn btn-outline-primary");
        $('#employee_table button').html('Select')

        if(btn.innerHTML != 'Select All Employee'){
            btn.innerHTML = 'Select All Employee'
            $('#select_all_div').html(``)
            $('#selected_all').val(0)
        }
        else{
            btn.innerHTML = 'Unselect All Employee'
            $('#select_all_div').html(`
                <div class="text-center bg-dark rounded text-white w-100 py-5 mb-5">
                    <h3>All Employee Selected</h3>
                </div>`)
            $('#selected_all').val(1)
        }
    }

    function select_holiday(){
        var data = JSON.parse($('#holiday').find(":selected").val())

        $('#emp_start_date').val(data.holiday_start_date)
        $('#emp_end_date').val(data.holiday_end_date)
    }
</script>
@endsection

