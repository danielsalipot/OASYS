@extends('layout.admin_carousel')
    @section('title')
        <h1 class="section-title mt-3 pb-2">{{ ucfirst($category) }} Module</h1>
    @endsection

    @section('controls')
        <li class="active"><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#home">Module Management</a></li>
        <li><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#menu1">{{ ucfirst($category) }} Employee Progress</a></li>
        <li><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#menu2">Enroll Employees</a></li>
    @endsection


    @section('first')
        <h1 class="display-4 pb-5 mt-5 text-center w-100">Module Management</h1>
        <div class="card shadow-sm w-100 p-2">
            <div class="row m-0 p-0">
                <div class="col row">

                </div>

                <div class="col-3 p-0 text-center">
                    <a href="./add" class='btn btn-lg btn-outline-primary w-100 h-100'><i class="bi bi-plus-circle"></i> Add Lesson</a>
                </div>
            </div>

            @foreach ($videos as $video)
                <div class="card shadow-sm rounded p-0 my-2">
                    <div class="row p-0 m-0">
                        <div class="col-6 p-0 pe-2 m-0">
                            <video id="video1" class="w-100 h-100 p-0 m-0" controls>
                                <source src="/{{$video->path}}" type="video/mp4">
                            </video>
                        </div>
                        <div class="col-6">
                            <div class="card shadow-sm p-3 my-3">
                                <div class="row w-100 m-0">
                                    <div class="col-1 p-0"><h1 class="display-4 rounded-start border text-center w-100 m-0 bg-primary text-white">{{$video->order}}</h1></div>
                                    <div class="col p-0"><h1 class="display-6 h-100 rounded-end border m-0">{{$video->title}}</h1></div>
                                </div>
                                <textarea class="form-control rounded-0 rounded-bottom" rows="10" readonly>{{$video->description}}</textarea>
                                <div class="row">
                                    <div class="col"></div>
                                    <div class="col-4 p-0">
                                        <a href="./{{$video->id}}/edit" class="btn btn-outline-success  p-2 w-100"><i class="bi bi-pencil"></i> Edit Lesson</a>
                                    </div>
                                    <div class="col-4 p-0">
                                        {!! Form::open(['action'=>'App\Http\Controllers\Admin\AdminDeleteController@deleteVideo']) !!}
                                            {!! Form::hidden('video', json_encode($video)) !!}
                                            <button type='submit' class="btn btn-outline-danger p-2 w-100"><i class="bi bi-eraser-fill"></i> Remove Lesson</button>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endsection

    @section('second')
    <div class="row">
        <div class="col-2 p-0">
            <ul class="nav nav-pills p-0 card shadow-sm">
                <li><h4 class="p-2 m-0 text-center alert-dark mb-2">Controls</h4></li>
                <li class="active mx-2 my-1"><a data-toggle="tab" class="h5 text-decoration-none m-0 " href="#inprogress">In Progress</a></li>
                <li class="mx-2 my-1"><a data-toggle="tab" class="h5 text-decoration-none m-0 " href="#done">Completed</a></li>
            </ul>
        </div>
        <div class="col">
            <div class="tab-content">
                <div id="inprogress" class="tab-pane in active p-5 border shadow-lg">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Employee Name</th>
                                <th>Department</th>
                                <th>Position</th>
                                <th></th>
                                <th>Progress</th>
                                <th></th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inprogress as $data)
                                <tr>
                                    <td><img src="{{ URL::asset($data->picture)}}" class="rounded" width="50" height="50"></td>
                                    <td>{{ $data->fname }} {{ $data->mname }} {{ $data->lname }}</td>
                                    <td>{{ $data->department }}</td>
                                    <td>{{ $data->position }}</td>
                                    <td colspan="3">
                                        <div class="progress p-0 m-0">
                                            <div class="progress-bar" role="progressbar" style="width: {{$data->progress}}%;" aria-valuenow="{{$data->progress}}" aria-valuemin="0" aria-valuemax="100">{{$data->progress}}%</div>
                                        </div>
                                    </td>
                                    <td>{{ $data->module[0]->start_date }}</td>
                                    <td>{{ $data->module[0]->end_date }}</td>
                                    @if ($data->progress >= 100)
                                        <td>
                                            <form action="/completeEmployeeModule" method="POST">
                                                @csrf

                                                @php ($ids = '')
                                                @foreach ($data->module as $data)
                                                    @php ($ids .= $data->id.';')
                                                @endforeach

                                                {!! Form::hidden('learner_ids', $ids) !!}
                                                <button class="btn btn-primary w-100"><i class="bi bi-check2-circle h1"></i><br>Mark as Complete</button>
                                            </form>
                                        </td>
                                    @else
                                        <td>
                                            <button class="btn btn-outline-danger primary w-100" disabled><i class="bi bi-x-circle"></i><br>Not Finished</button>
                                        </td>
                                    @endif

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="done" class="tab-pane p-5 border shadow-lg">
                    <table class="table">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Employee Name</th>
                            <th>Department</th>
                            <th>Position</th>
                            <th>Progress</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Completion Date</th>
                        </tr>

                        </thead>
                        <tbody>
                            @foreach ($completed as $data)
                                <tr>
                                    <td><img src="{{ URL::asset($data->picture)}}" class="rounded" width="50" height="50"></td>
                                    <td>{{ $data->fname }} {{ $data->mname }} {{ $data->lname }}</td>
                                    <td>{{ $data->department }}</td>
                                    <td>{{ $data->position }}</td>
                                    <td>
                                        <div class="progress p-0 m-0">
                                            <div class="progress-bar" role="progressbar" style="width: {{$data->progress}}%;" aria-valuenow="{{$data->progress}}" aria-valuemin="0" aria-valuemax="100">{{$data->progress}}%</div>
                                        </div>
                                    </td>
                                    <td>{{ $data->module[0]->start_date }}</td>
                                    <td>{{ $data->module[0]->end_date }}</td>
                                    <td>{{ $data->module[0]->completion_date }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @section('third')
    <div class="container p-5 bg-white border shadow-lg">
        <div class="row">
            <h1 class="display-4 pb-5 mt-5 text-center w-100">Enroll Employees</h1>
            <div class="col card shadow-sm p-4">
                <h1 class="display-5 text-center w-100">Employee Selection</h1>
                <div class="container w-100">
                    <table class="table w-100 table-striped text-center" id="employee_table">
                        <thead>
                            <tr class="text-center">
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
                <div class="container card p-4 shadow-sm mb-3" style="height: 400px;overflow-y:scroll;overflow-x:hidden;">
                    <h1 class="display-5 m-3 text-center w-100">Selected Employees</h1>
                    <table class="table table-striped text-center">
                        <thead>
                            <tr class="text-center">
                                <th class="col">Employee Picture</th>
                                <th class="col">Employee Name</th>
                                <th class="col">Department</th>
                                <th class="col">Position</th>
                            </tr>
                        </thead>
                        <tbody id="selected_employee_table"></tbody>
                    </table>
                </div>
                <div class="container card shadow-sm p-4">
                    <h1 class="display-5 m-3 text-center w-100">Enrollent Details Details</h1>
                    <form action="/enrollEmployee" method="POST">
                        {!! Form::hidden('emp_ids', '',['id'=>'emp_ids']) !!}
                        @csrf
                        {!! Form::label('module', 'Module Type', ['class'=>'w-100 text-center']) !!}
                        {!! Form::text('module', $category, ['class'=>'form-control text-center m-auto form-control-lg','readonly']) !!}
                        <br>

                        {!! Form::label('start_date_input', 'Module Duration', ['class'=>'w-100 text-center']) !!}
                        <div class="row m-0 mb-3 w-100 m-auto">
                            <div class="col input-daterange p-0">
                                <input type="text" name="start_date_input" id="start_date_input" class="form-control h-100 w-100 m-auto" placeholder="From Date" readonly />
                            </div>
                            <div class="col-1 text-center h2 pt-2">-</div>
                            <div class="col input-daterange p-0">
                                <input type="text" name="end_date_input" id="end_date_input" class="form-control h-100 w-100 m-auto" placeholder="To Date" readonly />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                {!! Form::submit('Enroll', ["class"=>"btn btn-lg btn-success p-3 w-50"]) !!}
                            </div>
                            <div class="col-4">
                                <button onclick="location.reload()" class="btn btn-lg btn-danger w-100 p-3">Cancel</button>
                            </div>
                        </div>
                    </form>
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

})

function selectEmployee(btn, emp_id, emp_picture, emp_name, emp_department, emp_position){
    if(btn.innerHTML == "Select"){
        btn.innerHTML = 'Selected'
        btn.className = 'btn btn-success';

        $('#emp_ids').val(`${$('#emp_ids').val()}${emp_id};`)

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

        $('#emp_ids').val($('#emp_ids').val().replace(`${emp_id};`,''))

        $('#selected_employee_table').html($('#selected_employee_table').html().replace(`<tr>
            <td><img src="{{ URL::asset('${emp_picture}')}}" class="rounded" width="50" height="50"></td>
            <td>${emp_name}</td>
            <td>${emp_department}</td>
            <td>${emp_position}</td>
        </tr>`,''))
    }
}
</script>

@if ($category == 'orientation')
<style>
    body{
        background-color: rgb(213, 255, 150);
    }
</style>
@endif
@if ($category == 'training')
<style>
    body{
        background-color: rgb(150, 243, 255);
    }
</style>
@endif
@if ($category == 'correction')
<style>
    body{
        background-color: rgb(255, 155, 150);
    }
</style>
@endif
@endsection
