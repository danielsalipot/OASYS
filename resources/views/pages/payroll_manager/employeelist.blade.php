@extends('layout.payroll_app')

@section('title')
    <h1 class="section-title mt-5 pb-5">Employee List</h1>
@endsection

@section('content')
<div class="container w-100 p-2">
    <table class="table table-striped table-dark text-center w-100" id="employee_table">
        <thead>
            <tr class="text-center">
                <th scope="col">Employee ID</th>
                <th scope="col">Picture</th>
                <th scope="col">Employee Details</th>
                <th scope="col">Department</th>
                <th scope="col">Position</th>
                <th scope="col">Rate/hr</th>
                <th scope="col">Start Date</th>
                <th scope="col">Employement <br>Status</th>
                <th scope="col">Edit</th>
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
                    {!! Form::submit('Save', ['class'=>'btn btn-success m-auto h-100 w-25']) !!}
                    {!! Form::close() !!}
                    <button type="button" class="btn btn-danger m-auto h-100 w-25 " data-dismiss="modal">Close</button>
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
                        dataSrc: ''
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
                            return `<button type="button" id="${data}" onclick="editRate(${data})" class="btn btn-primary" data-toggle="modal" data-target="#edit_modal">Edit Rate</button>`
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
