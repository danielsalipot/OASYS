@extends('layout.pr_carousel')

@section('Title')
    <h1 class="section-title mt-5 pb-5 text-center w-100">Paid Leave Management</h1>
@endsection

@section('first')
<div class="container">
    <h1 class="display-4 pb-5 mt-5 text-center w-100">Add Paid Leave</h1>
    <div class="row">
        <div class="col">
            <h1 class="display-5 text-center w-100">Employee Selection</h1>
            <div class="container w-100">
                <table class="table w-100 table-striped text-center table-dark" id="employee_table">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Employee ID</th>
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
                            <th scope="col">Employee ID</th>
                            <th scope="col">Employee Picture</th>
                            <th scope="col">Employee Name</th>
                            <th scope="col">Department</th>
                            <th scope="col">Position</th>
                        </tr>
                    </thead>
                    <tbody id="selected_employee_table"></tbody>
                </table>
            </div>

            <div class="container card shadow-lg p-5">
                <h1 class="display-5 mb-3 text-center w-100">Paid Leave Details</h1>
                <div class="m-5 ">
                    {!! Form::label('leave_input', 'Paid Leave Date', ['class'=>'w-100 text-center']) !!}
                    <div class="row mb-3 w-100">
                        <div class="input-daterange">
                            <input type="text" name="leave_date_input" id="leave_date_input" class="form-control h-100 ms-2 p-3 m-auto" placeholder="From Date" readonly />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <button type="button" onclick="addLeave()" class="btn p-4 w-100 btn-success" data-toggle="modal" data-target="#edit_modal">Add Paid Leave</button>
                        </div>
                        <div class="col-4">
                            <button class="btn btn-outline-danger w-100 p-4">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('second')
<div class="container">
    <h1 class="display-4 pb-5 mt-5 text-center w-100">Cash Advance History</h1>
    @include('inc.date_filter')
    <table class="table table-striped table-dark w-100 text-center" id="leave_table">
        <thead>
            <tr>
                <th scope="col">Employee Details</th>
                <th scope="col">Paid Leave Date</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@section('modal')
    <!-- The Modal -->
    <div class="modal" id="edit_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title w-100">Continue to Add Paid Leave</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body row">
                    <div class="row">
                        <div class="col ps-5">
                            <p class="h5 text-center w-100">Selected Employees</p>
                            <hr>
                            <table class="w-100 m-auto text-center">
                                <thead>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Rate</th>
                                </thead>
                                <tbody>
                                    <td><h6 id='modal_emp_id'></h6></td>
                                    <td><h6 id='modal_emp_names'></h6></td>
                                    <td><h6 id='modal_rate'></h6></td>
                                </tbody>
                            </table>
                        </div>
                        <div class="col">
                            <p class="h5 text-center w-100">Paid Leave Detail</p>

                            <hr>
                            <h6>Paid Leave Date</h6>
                            <div class="row">
                                {!! Form::text('modal_leave_input', 'from date', ['disabled','id'=>'modal_leave_input','class'=>'p-2 w-100 text-center']) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <div class="row">
                        <div class="col">
                            {!! Form::open(['action'=>'App\Http\Controllers\Payroll\PayrollInsertController@InsertLeave']) !!}
                                {!! Form::hidden('hidden_emp_id','',['id'=>'hidden_emp_id']) !!}
                                {!! Form::hidden('hidden_leave_input','',['id'=>'hidden_leave_input']) !!}
                                {!! Form::submit('Confirm Paid Leave', ['class' => ' w-100 btn btn-success']) !!}
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

        let { start_date, end_date } = getDateToday();
        load_table(start_date,end_date);

        $('#from_date').val(start_date);
        $('#to_date').val(end_date);

        function load_table(from_date = '', to_date = ''){
            $('#leave_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                        url: '/leaveJson',
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
                    { data: 'attendance_date',
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

        $('#employee_table').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: '/employeelistjson'
            },
            columns: [
                { data: 'employee_id',
                    render : (data,type,row)=>{
                        return `<b>${data}</b>`
                    }
                },
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

        $('.input-daterange').datepicker({
            todayBtn:'linked',
            format:'yyyy-mm-dd',
            autoclose:true
        });
    })

    function addLeave(){
        $('#hidden_leave_input').val($('#leave_date_input').val())
        $('#modal_leave_input').val($('#leave_date_input').val())
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

    function selectEmployee(btn, emp_id, emp_picture, emp_name, emp_department, emp_position, rate){
            if(btn.innerHTML == "Select"){
                btn.innerHTML = 'Selected'
                btn.className = 'btn btn-success';

                $('#hidden_emp_id').val(`${$('#hidden_emp_id').val()}${emp_id};`)

                $('#modal_emp_id').html(`${$('#modal_emp_id').html()}${emp_id}<br>`)
                $('#modal_emp_names').html(`${$('#modal_emp_names').html()}${emp_name}<br>`)
                $('#modal_rate').html(`${$('#modal_rate').html()}${rate}<br>`)

                $('#selected_employee_table').html(
                `${$('#selected_employee_table').html()}

                <tr>
                    <td>${emp_id}</td>
                    <td><img src="{{ URL::asset('${emp_picture}')}}" class="rounded" width="50" height="50"></td>
                    <td>${emp_name}</td>
                    <td>${emp_department}</td>
                    <td>${emp_position}</td>
                </tr>
                `)
            }else{
                btn.innerHTML = 'Select'
                btn.className = 'btn btn-outline-primary text-primary';

                $('#hidden_emp_id').val($('#hidden_emp_id').val().replace(`${emp_id};`,''))

                $('#modal_emp_id').html(`${$('#modal_emp_id').html().replace(`${emp_id}<br>`,'')}`)
                $('#modal_emp_names').html(`${$('#modal_emp_names').html().replace(`${emp_name}<br>`,'')}`)
                $('#modal_rate').html(`${$('#modal_rate').html().replace(`${rate}<br>`,'')}`)

                $('#selected_employee_table').html($('#selected_employee_table').html().replace(`<tr>
                    <td>${emp_id}</td>
                    <td><img src="{{ URL::asset('${emp_picture}')}}" class="rounded" width="50" height="50"></td>
                    <td>${emp_name}</td>
                    <td>${emp_department}</td>
                    <td>${emp_position}</td>
                </tr>`,''))
            }
        }
</script>
@endsection
