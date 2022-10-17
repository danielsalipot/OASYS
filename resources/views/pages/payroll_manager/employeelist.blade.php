@extends('layout.payroll_app')

@section('title')
    @error('rate')<div class="alert-danger p-3 rounded">{{$message}}</div>@enderror
    <h1 class="section-title mt-5 pb-5">Salary Management</h1>
@endsection

@section('content')
<div class="row">
    <h4 class="alert-primary p-4 shadow-sm w-100 mb-4">Average Salary of Positions</h4>

    @foreach ($positions as $position)
        <div class="col-3 card mb-4 p-0">
            <h5 class="alert-light shadow-sm w-100 p-3">{{ $position->position_title }}</h5>
            <h5 class="ms-2 w-100 text-secondary p-3 pb-2">{{ count($position->employee) }} Employees occupying the position</h5>
            <div class="row mx-auto w-100">
                <div class="col alert-success rounded text-center p-4 m-2">
                    <h2 class="my-3">₱{{ round($position->average_salary,2) }} <small class="text-success">Per hr.</small></h2>
                </div>
                <div class="col m-2 text-center">
                    <h6 class="w-100 text-center p-2 alert-light">Top 3 Salaries</h6>
                    @if (isset($position->employee[0]))
                        <h6 class="w-100">{{ $position->employee[0]->employee_id }}# {{ $position->employee[0]->userDetail->lname }} <b class="text-success">(₱{{ $position->employee[0]->rate }})</b></h6>
                    @endif

                    @if (isset($position->employee[1]))
                        <h6 class="w-100">{{ $position->employee[1]->employee_id }}# {{ $position->employee[1]->userDetail->lname }} <b class="text-success">(₱{{ $position->employee[1]->rate }})</b></h6>
                    @endif

                    @if (isset($position->employee[2]))
                        <h6 class="w-100">{{ $position->employee[2]->employee_id }}# {{ $position->employee[2]->userDetail->lname }} <b class="text-success">(₱{{ $position->employee[2]->rate }})</b></h6>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
<div class="row p-3"></div>

<div class="row card p-3">
    <table class="table table-striped  text-centerresponsive w-100" id="employee_table">
        <thead>
            <tr class="text-center">
                <th class="col">Employee ID</th>
                <th class="col">Picture</th>
                <th class="col" data-priority="1">Employee Details</th>
                <th class="col">Department</th>
                <th class="col-2">Position</th>
                <th class="col" data-priority="1">Rate/hr</th>
                <th class="col">Start Date</th>
                <th class="col">Employement <br>Status</th>
                <th class="col-2" data-priority="2">Edit</th>
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
                    <h4 class="modal-title w-100">Edit Employee Rate</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body row">
                    <div id="edit_pic" class="col-3"></div>
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <p id='id_txt'></p>
                                <p id='name_txt'></p>
                                <p id='department_txt'></p>
                            </div>
                            <div class="col">
                                <p id='position_txt'></p>
                                <p id='start_date_txt'></p>
                                <p id='status_txt'></p>
                            </div>
                        </div>

                        {!! Form::open(['action'=>'App\Http\Controllers\Payroll\PayrollUpdateController@editrate']) !!}
                            {{ Form::hidden('emp_id', '',['id' => 'emp_id']) }}
                            {{Form::label('', 'Employee Rate', 'rate')}}
                            {!! Form::text('rate','', ['id'=>'rate_txt','class'=>'form-control w-75']) !!}
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">

                    <div class="row w-100">
                        <div class="col-3 border border-secondary rounded text-center pt-2">
                            {{ Form::label('chk', 'Notifications', ['class' => 'control-label']) }}
                            {!! Form::checkbox('chk', 'value', true,['class'=>'form-check-input']) !!}
                        </div>
                        <div class="col">
                            {!! Form::submit('Save', ['class'=>'btn btn-success m-auto h-100 w-75']) !!}
                            {!! Form::close() !!}
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-danger m-auto h-100 w-75 " data-dismiss="modal">Close</button>
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
            $('#employee_table').DataTable({
                ajax: {
                        url: '/employeelistjson',
                    },
                columns: [
                    { data: 'employee_id',
                        render : (data,type,row)=>{
                            return `<b>${data}</b>`
                        }
                    },
                    { data: 'user_detail.picture',
                        render : (data,type,row)=>{
                            return `<img src="{{ URL::asset('${data}') }}" class="rounded" width="50" height="50">`
                        }
                    },
                    { data: 'user_detail.fname',
                        render : (data,type,row)=>{
                            return  `
                                        <b>${row.user_detail.fname} ${row.user_detail.mname} ${row.user_detail.lname}</b><br>
                                            Sex: ${row.user_detail.sex}<br>
                                            age: ${row.user_detail.age}
                                    `
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
                    { data: 'rate',
                        render : (data,type,row)=>{
                            return `<b class="h5">₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</b>`
                        }
                    },
                    { data: 'start_date',
                        render : (data,type,row)=>{
                            return `<b>${data}</b>`
                        }
                    },
                    { data: 'employment_status',
                        render : (data,type,row)=>{
                            return `<b>${data}</b>`
                        }
                    },
                    { data: 'employee_id',
                        render : (data,type,row)=>{
                            return `
                            <div class="row p-0 w-100 mx-auto">
                                <div class="col p-0">
                                    <button type="button" id="${data}" onclick="editRate(${data})" class="btn btn-outline-dark w-100" data-toggle="modal" data-target="#edit_modal"><i class="h3 bi bi-cash-coin"></i><br>Edit Rate</button>
                                </div>
                                <div class="col-4 p-0">
                                    <a href="/payroll/employee/profile/${row.login_id}" class="btn btn-outline-primary w-100"><i class="bi bi-person-square h3"></i><br>Profile</a>
                                </div>
                            </div>`
                        }
                    },
                ]
            })
        })

        function editRate(id){
            $.ajax({
                url: '/fetchSingleEmployee',
                type: 'get',
                data: {employee_id: id},
                success: function(response){
                    $('#edit_pic').html(` <img src="{{ URL::asset('${response.user_detail.picture}')}}" class="border rounded-circle"height="100px" width="100px" >`)
                    $('#emp_id').val(response.employee_id)
                    $('#id_txt').html(`<b>Employee ID: </b> <br>${response.employee_id}`)
                    $('#name_txt').html(`<b>Employee Name: </b> <br>${response.user_detail.fname} ${response.user_detail.mname} ${response.user_detail.lname}`)
                    $('#department_txt').html(`<b>Department: </b> <br>${response.department}`)
                    $('#position_txt').html(`<b>Position: </b> <br>${response.position}`)
                    $('#start_date_txt').html(`<b>Start Date: </b> <br>${response.start_date}`)
                    $('#status_txt').html(`<b>Employment Status:</b> <br>${response.employment_status}`)
                    $('#rate_txt').val(response.rate)
                }
            });
        }

    </script>
@endsection
