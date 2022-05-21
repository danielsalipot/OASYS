@extends('layout.staff_carousel')
    @section('Title')
        <h1 class="section-title mt-2 pb-1">Department Management</h1>
    @endsection

    @section('first')
        <h1 class="display-4 mt-5 text-center">Position Overview</h1>
        <hr>
        <div class="row d-flex p-4 w-100 text-center justify-content-center">
            @foreach ($all_dept as $department)
                <div class="col-2 card border border-primary shadow-lg p-2 m-2 alert alert-primary">
                    <h1  class="section-title mt-0" >{{$department->emp_count}}</h1>
                    <hr>
                    <h3>{{$department->department_name}}</h3>
                </div>
            @endforeach
        </div>
        <h6 class="display-4 mt-5">Add New Department</h6>
        <hr>
        <div class="row mb-5">
            <div class="col-8 card shadow-sm pt-3 me-2">
                {!! $departments->links() !!}
                <table class="table table-striped table-dark w-100 text-center" id="applicant_table">
                    <thead>
                    <tr>
                        <th class="col">Department ID</th>
                        <th class="col">Department Name</th>
                        <th class="col">Added On</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($departments as $department)
                            <tr>
                                <td>{{ $department->id }}</td>
                                <td>{{ $department->department_name }}</td>
                                <td>{{ date($department->created_at) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $departments->links() !!}
            </div>
            <div class="col p-0 card">
                <h2 class="alert alert-primary w-100">Add Departments</h2>
                <div class="p-4">
                    {!! Form::open(['action'=>'App\Http\Controllers\Staff\StaffInsertController@InsertDepartment','method'=>'GET']) !!}
                    <h6>Department Name</h6>
                    {!! Form::text('dept_name', '', ["class"=>"form-control","placeholder"=>"Department name"]) !!}
                    <div class="row m-3">
                        <div class="col text-center">
                            {!! Form::submit('Save Department', ['class'=>'btn btn-success w-75 p-3']) !!}
                        </div>
                        <div class="col text-center">
                            <button type='button' class='btn btn-danger w-75 p-3'>Cancel</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    @endsection

    @section('second')
    <div class="container">
        <h1 class="display-4 pb-5 mt-5 text-center w-100">Update Employee Department</h1>
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

                <div class="container">
                    <h1 class="display-5 mb-3 text-center w-100">Department Details</h1>
                    <div class="m-5 ps-5 pe-5">

                            {!! Form::open(['action'=>'App\Http\Controllers\Staff\StaffUpdateController@EmployeeDepartmentUpdate','method'=>'GET']) !!}
                            {!! Form::hidden('hidden_emp_id','',['id'=>'hidden_emp_id']) !!}
                            {!! Form::label('department_name', 'Department Name') !!}
                            <select name='department_name' id='department_name' class='h4 py-3 w-100 btn btn-primary'>
                                @foreach ($all_dept as $department)
                                    <option value='{{$department->department_name}}'>{{$department->department_name}}</option>
                                @endforeach
                            </select>

                            <div class="row">
                                <div class="col">
                                    {!! Form::submit('Update Employee Department', ["class"=>"btn btn-success p-3 px-5"]) !!}
                                </div>
                            {!! Form::close() !!}
                                <div class="col-2">
                                    <button onclick="location.reload()" class="btn btn-danger w-100 p-3">Cancel</button>
                                </div>
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
    })

    function selectEmployee(btn, emp_id, emp_picture, emp_name, emp_department, emp_position){
            if(btn.innerHTML == "Select"){
                btn.innerHTML = 'Selected'
                btn.className = 'btn btn-success';

                $('#hidden_emp_id').val(`${$('#hidden_emp_id').val()}${emp_id};`)

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
