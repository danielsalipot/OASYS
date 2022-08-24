@extends('layout.pr_carousel')

@section('Title')
    <h1 class="section-title mt-5 pb-5 text-center w-100">Paid Leave Management</h1>
@endsection

@section('controls')
    <li class="active"><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#home">Paid Leave Approvals</a></li>
    <li><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#menu1">Add Paid Leave</a></li>
    <li><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#menu2">Paid Application History</a></li>
    <li><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#menu3">Paid Leave History</a></li>
@endsection

@section('first')
    @foreach ($applications as $data)
    <div class="container my-3">
        <div class="row">
            <div class="col card shadow-sm p-4 rounded-0 rounded-start">
                <div class="display-6 alert-light mb-4">Application Letter</div>
                <div class="row mb-4">
                    <div class="col-3 text-center">
                        <img src="/{{$data->employee->userDetail->picture}}" class="w-100 h-100 rounded-circle shadow-sm">
                    </div>
                    <div class="col pt-3">
                        <h6 class='text-secondary'>Employee Name</h6>
                        <h3>{{ $data->employee->userDetail->fname }} {{ $data->employee->userDetail->mname }} {{ $data->employee->userDetail->lname }}</h3>
                        Position: {{ $data->employee->position }} | Department: {{ $data->employee->department }}
                    </div>
                </div>
                <h6 class='text-secondary'>Title</h6>
                <h1>{{ $data->title }}</h1>
                <h6 class='text-secondary'>Body</h6>
                <p class="" style="font-size: 12px; text-align:justify;">{{ $data->detail }}</p>
            </div>
            <div class="col card shadow-sm p-4 rounded-0">
                <div class="display-6 alert-light mb-4">Leave Details</div>

                <h6 class='text-secondary'>Start Date</h6>
                <input type="text" name="" id="" class='form-control form-control-lg mb-4' readonly value="{{ $data->start_date }}">

                <h6 class='text-secondary'>End Date</h6>
                <input type="text" name="" id="" class='form-control form-control-lg mb-4' readonly value="{{ $data->end_date }}">

                <h6 class='text-secondary'>Number of Days</h6>
                <input type="text" name="" id="days{{$data->id}}" class='form-control form-control-lg mb-4' readonly value="">

                <script>
                    var difference = new Date("{{ $data->end_date }}").getTime() - new Date("{{ $data->start_date }}").getTime();
                    var TotalDays = Math.ceil(difference / (1000 * 3600 * 24));

                    document.getElementById('days{{$data->id}}').value = TotalDays
                </script>
            </div>
            <div class="col card shadow-sm p-4 rounded-0 rounded-end">
                <div class="display-6 alert-light mb-4">Approval Controls</div>
                <div class="m-3">
                    <h6 class='text-secondary'>Approval Date</h6>
                    <input type="text" name="" id="" class='form-control form-control-lg mb-4' readonly value="{{ date('Y-m-d') }}">
                    <form action="/updateApprovalLeave" method="POST">
                        @csrf
                        {!! Form::hidden('id', $data->id) !!}
                        {!! Form::hidden('status', 1) !!}
                        <button type="submit" class="btn btn-success btn-lg w-100 p-4 my-2">Approve</button>
                    </form>
                    <form action="/updateApprovalLeave" method="POST">
                        @csrf
                        {!! Form::hidden('id', $data->id) !!}
                        {!! Form::hidden('status', 0) !!}
                        <button class="btn btn-outline-danger btn-lg w-100 p-4 my-2 ">Disapprove</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endsection

@section('second')
<div class="container">
    <h1 class="display-4 pb-5 mt-5 text-center w-100">Add Paid Leave</h1>
    <div class="row">
        <div class="col">
            <h1 class="display-5 text-center w-100">Employee Selection</h1>
            <div class="container w-100">
                <table class="table w-100 table-striped text-center table-dark" id="employee_table">
                    <thead>
                        <tr class="text-center">
                            <th class="col">Employee ID</th>
                            <th class="col">Employee Picture</th>
                            <th class="col">Employee Name</th>
                            <th class="col">Department</th>
                            <th class="col">Position</th>
                            <th class="col">Select</th>
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
                            <th class="col">Employee ID</th>
                            <th class="col">Employee Picture</th>
                            <th class="col">Employee Name</th>
                            <th class="col">Department</th>
                            <th class="col">Position</th>
                        </tr>
                    </thead>
                    <tbody id="selected_employee_table"></tbody>
                </table>
            </div>

            <div class="container card shadow-lg p-5">
                <h1 class="display-5 mb-3 text-center w-100">Paid Leave Details</h1>
                <div class="m-5">
                    {!! Form::label('leave_input', 'Paid Leave Date', ['class'=>'w-100 text-center']) !!}
                    <div class="input-daterange row m-0">
                        <div class="col mb-3 w-100">
                            <input type="text" name="leave_from_date_input" id="leave_from_date_input" class="form-control h-100 ms-2 p-3 m-auto" placeholder="From Date" readonly />
                        </div>

                        <div class="col mb-3 w-100">
                            <input type="text" name="leave_to_date_input" id="leave_to_date_input" class="form-control h-100 ms-2 p-3 m-auto" placeholder="To Date" readonly />
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

@section('third')
<div class="container p-5 border shadow-lg">
    @foreach ($updatedApplications as $data)
    <div class="container my-3">
        <div class="row">
            <div class="col card shadow-sm p-4 rounded-0 rounded-start">
                <div class="display-6 alert-light mb-4">Application Letter</div>
                <div class="row mb-4">
                    <div class="col-3 text-center">
                        <img src="/{{$data->employee->userDetail->picture}}" class="w-100 h-100 rounded-circle shadow-sm">
                    </div>
                    <div class="col pt-3">
                        <h6 class='text-secondary'>Employee Name</h6>
                        <h3>{{ $data->employee->userDetail->fname }} {{ $data->employee->userDetail->mname }} {{ $data->employee->userDetail->lname }}</h3>
                        Position: {{ $data->employee->position }} | Department: {{ $data->employee->department }}
                    </div>
                </div>
                <h6 class='text-secondary'>Title</h6>
                <h1>{{ $data->title }}</h1>
                <h6 class='text-secondary'>Body</h6>
                <p class="" style="font-size: 12px; text-align:justify;">{{ $data->detail }}</p>
            </div>
            <div class="col card shadow-sm p-4 rounded-0">
                <div class="display-6 alert-light mb-4">Leave Details</div>

                <h6 class='text-secondary'>Start Date</h6>
                <input type="text" name="" id="" class='form-control form-control-lg mb-4' readonly value="{{ $data->start_date }}">

                <h6 class='text-secondary'>End Date</h6>
                <input type="text" name="" id="" class='form-control form-control-lg mb-4' readonly value="{{ $data->end_date }}">

                <h6 class='text-secondary'>Number of Days</h6>
                <input type="text" name="" id="applied_days{{$data->id}}" class='form-control form-control-lg mb-4' readonly value="">

                <script>
                    var difference = new Date("{{ $data->end_date }}").getTime() - new Date("{{ $data->start_date }}").getTime();
                    var TotalDays = Math.ceil(difference / (1000 * 3600 * 24));

                    document.getElementById('applied_days{{$data->id}}').value = TotalDays
                </script>
            </div>
            <div class="col card shadow-sm p-4 rounded-0 rounded-end">
                <div class="display-6 alert-light mb-4">Application Status</div>
                @if ($data->status)
                    <div class="card shadow-sm m-3 text-center shadow-sm alert-primary">
                        <h1 style="font-size:70px"><i class="bi bi-file-earmark-check"></i></h1>
                        <h3>Approved</h3>
                        <div class="w-100 mt-3 p-2 alert-light">
                            <p class="p-0 m-0">Approved by: {{ $data->manager->fname }} {{ $data->manager->mname }} {{ $data->manager->lname }}</p>
                            <p class="p-0 m-0">Approved on: {{ $data->approval_date }}</p>
                        </div>
                    </div>
                @else
                <div class="card shadow-sm m-3 text-center shadow-sm alert-danger">
                    <h1 style="font-size:70px"><i class="bi bi-file-earmark-x-fill"></i></h1>
                    <h3>Disapproved</h3>
                    <div class="w-100 mt-3 p-2 alert-light">
                        <p class="p-0 m-0">Approved by: {{ $data->manager->fname }} {{ $data->manager->mname }} {{ $data->manager->lname }}</p>
                        <p class="p-0 m-0">Approved on: {{ $data->approval_date }}</p>
                    </div>
                </div>
                @endif
                <form action="/updateRecoverLeave" method="POST" class="p-0 mx-3">
                    @csrf
                    {!! Form::hidden('id', $data->id) !!}
                    <button type="submit" class="btn btn-outline-info btn-lg shadow-sm w-100">Recover Application</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection

@section('fourth')
<div id="menu3" class="tab-pane">
    <div class="container p-5 border shadow-lg">
        <h1 class="display-4 pb-5 mt-5 text-center w-100">Paid Leave History</h1>
        @include('inc.date_filter')
        <table class="table table-striped  w-100 text-center" id="leave_table">
            <thead>
                <tr>
                    <th class="col">Transaction ID</th>
                    <th class="col">Employee Details</th>
                    <th class="col">Paid Leave Date</th>
                    <th class="col">Payroll Manager</th>
                    <th class="col">Added on (UTC)</th>
                    <th class="col">Delete</th>
                </tr>
            </thead>
        </table>
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
                                <div class="col">
                                    {!! Form::text('modal_from_date', 'from date', ['readonly','id'=>'modal_from_date','class'=>'form-control p-2 w-100 text-center']) !!}
                                </div>
                                <div class="col">
                                    {!! Form::text('modal_to_date', 'to date', ['readonly','id'=>'modal_to_date','class'=>'form-control p-2 w-100 text-center']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <div class="row w-100 text-center">
                        <div class="col-3 border border-secondary rounded text-center pt-2">
                            {!! Form::open(['action'=>'App\Http\Controllers\Payroll\PayrollInsertController@InsertLeave']) !!}
                            {{ Form::label('chk', 'Notifications', ['class' => 'control-label']) }}
                            {!! Form::checkbox('chk', 'value', true,['class'=>'form-check-input']) !!}
                        </div>
                        <div class="col">
                                {!! Form::hidden('hidden_emp_id','',['id'=>'hidden_emp_id']) !!}
                                {!! Form::hidden('hidden_leave_from_input','',['id'=>'hidden_leave_from_input']) !!}
                                {!! Form::hidden('hidden_leave_to_input','',['id'=>'hidden_leave_to_input']) !!}
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
                    { data: 'id',
                        render : (data,type,row)=>{
                            return `<b>${data}</b>`
                        }
                    },
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
                $('#leave_table').DataTable().destroy();
                load_table(from_date, to_date);
            }else{
                alert('Both Date is required');
            }
        });

        $('#refresh').click(function(){
            let { start_date, end_date } = getDateToday();
            $('#from_date').val(start_date);
            $('#to_date').val(end_date);
            $('#leave_table').DataTable().destroy();
            load_table(start_date,end_date);
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
        $('#hidden_leave_from_input').val($('#leave_from_date_input').val())
        $('#hidden_leave_to_input').val($('#leave_to_date_input').val())

        $('#modal_from_date').val($('#leave_from_date_input').val())
        $('#modal_to_date').val($('#leave_from_date_input').val())

    }

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
