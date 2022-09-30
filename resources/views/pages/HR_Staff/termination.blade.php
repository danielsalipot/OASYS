@extends('layout.staff_carousel')
    @section('Title')
        <h1 class="section-title mt-2 pb-1">Offboarding Management</h1>
    @endsection

    @section('controls')
        <li class="active"><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#home">Termination Management</a></li>
        <li><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#menu1">Resignation Management</a></li>
    @endsection

    @section('first')
        <table class="table table-striped  w-100 text-center" id="employee_table">
            <thead>
            <tr>
                <th class="col-1">Picture</th>
                <th class="col-2">Employee Detail</th>
                <th class="col-1">Department</th>
                <th class="col-1">Position</th>
                <th class="col-1">Employement Status</th>
                <th class="col-2">Employed for</th>
                <th class="col">Actions</th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
        <script>
            $(document).ready(function(){
                $('#employee_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '/terminationjson',
                    },
                    columns: [
                        { data: 'img',
                            render : (data,type,row)=>{
                                return data
                            }
                        },
                        { data: 'full_name',
                            render : (data,type,row)=>{
                                return `<h4>${data}</h4>
                                    <h5>Sex: ${row.user_detail.sex}</h5>
                                    <h5>Age: ${row.user_detail.age}</h5>`
                            }
                        },
                        { data: 'department',
                            render : (data,type,row)=>{
                                return `<h5>${data}</h5>`
                            }
                        },
                        { data: 'position',
                            render : (data,type,row)=>{
                                return `<h5>${data}</h5>`
                            }
                        },
                        { data: 'employment_status',
                            render : (data,type,row)=>{
                                return `<h5>${data}</h5>`
                            }
                        },
                        { data: 'employed_for',
                            render : (data,type,row)=>{
                                return data
                            }
                        },
                        { data: 'employee_id',
                            render : (data,type,row)=>{
                                return `${row.retire} ${row.terminate}`
                            }
                        },
                    ]
                });
            })</script>
    @endsection

    @section('second')
    <div class="d-flex" style="overflow-x: scroll">
        @foreach($resigneds as $key => $data)
            <div class="card shadow-sm col-6 mx-5">
                <div class="alert-info ">
                    <h3 class="p-3 w-100 text-center">Employee Details</h2>
                    <div class="bg-white m-1 rounded p-3">
                        <div class="row px-3">
                            <div class="col-9">
                                <h6 class="text-secondary">Employee Name</h6>
                                <div class="display-6">{{ $data->employee->userDetail->fname }} {{ $data->employee->userDetail->mname }} {{ $data->employee->userDetail->lname }}</div>
                            </div>
                            <div class="col text-center">
                                <h6 class="text-secondary">Employee ID</h6>
                                <div class="display-6">{{ $data->employee->employee_id}}</div>
                            </div>
                        </div>

                        <hr>
                        <div class="row my-3 text-center">
                            <h6 class="text-secondary">Employment Status</h6>
                            <h4>{{ $data->employee->employment_status}}</h4>
                        </div>

                        <div class="row my-3 text-center">
                            <div class="col">
                                <h6 class="text-secondary">Employee Position</h6>
                                <h4>{{ $data->employee->position}}</h4>
                            </div>
                            <div class="col">
                                <h6 class="text-secondary">Employee Department</h6>
                                <h4>{{ $data->employee->department}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <h4 class="w-100 alert-light p-3">Resignation Letter</h4>
                <div class="row">
                    <embed src="/{{$data->resignation_path}}" height="600px"/>
                </div>
                <div class="row p-3 bg-dark w-100 mx-auto">
                    <div class="col">
                        <button onclick="offboarding('Resignation','{{$data->employee->employee_id}}','/{{$data->employee->userDetail->picture}}','{{ $data->employee->userDetail->fname }} {{ $data->employee->userDetail->mname }} {{ $data->employee->userDetail->lname }}','{{$data->employee->department}}','{{$data->employee->position}}','{{$data->employee->userDetail->cnum}}','{{$data->employee->userDetail->email}}', {{$data->id}} , 1)" class="btn btn-success p-3 w-100" data-toggle="modal" data-target="#edit_modal">Approve</button>
                        <form action="/updateEmployeeResignation" id="resignationFormUpdate{{$data->employee->employee_id}}" method="POST">
                            @csrf
                            {!! Form::hidden('id', $data->id ) !!}
                            {!! Form::hidden('status', 1) !!}
                        </form>
                    </div>
                    <div class="col">
                        <form action="/updateEmployeeResignation" method="POST">
                            @csrf
                            {!! Form::hidden('id', $data->id ) !!}
                            {!! Form::hidden('status', 0) !!}
                            <button type="submit" class="btn btn-danger p-3 w-100">Deny</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @endsection

    @section('modal')
        <!-- The Modal -->
    <div class="modal" id="edit_modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title w-100">Offboarding Employee</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body row">
                    <div class="row">
                        <div class="col-3">
                            <img src="" width="100px" height="100px" id="emp_picture">
                        </div>
                        <div class="col pt-3" id="emp_details"></div>
                    </div>
                    <div class="row mt-2 p-4">
                        <div class="col-3" id="contact_detail"></div>
                        <div class="col-1"></div>
                        <div class="col text-center" id='term_detail'></div>
                    </div>
                    <div class="card mx-auto shadow-sm p-0" style="width: 96%">
                        <h4 class="w-100 p-3 alert-primary">Employee Clearance Details</h4>
                        <div class="row">
                            <div class="col-4">
                                <div class="m-2 shadow-sm p-3">
                                    <h5 class="text-center alert-light ms-2">Add Clearance</h5>
                                    <br>
                                    <h6>Clearance Name</h6>
                                    <input type="text" placeholder="Clearance Name" id="clearanceInput" class="form-control w-100">
                                    <br>
                                    <div class="row h-100">
                                        <div class="col p-2">
                                            <button class="btn btn-outline-success w-100 p-3" onclick="addClearanceItem()">Add</button>
                                            <script>
                                                var clearanceItemId = 0
                                                var clearanceItemArray = []
                                                function addClearanceItem(){
                                                    if($('#clearanceInput').val()){
                                                        clearanceItemArray.push($('#clearanceInput').val())
                                                        $('#clearanceList').html($('#clearanceList').html() +
                                                        `<div class="row" id="clearanceItem${clearanceItemId}">
                                                            <div class="col-9">
                                                                <li class="p-2" style="font-size: 12px">${$('#clearanceInput').val()}</li>
                                                            </div>
                                                            <div class="col text-center">
                                                                <button class="btn btn-outline-danger rounded-circle border-0" onclick="removeItem('clearanceItem${clearanceItemId}')"><i class="bi bi-x h5"></i></button>
                                                            </div>
                                                        </div>`)
                                                        clearanceItemId += 1
                                                        $('#clearanceHidden').val(JSON.stringify(clearanceItemArray))
                                                        $('#clearanceInput').val('')
                                                    }
                                                }

                                                function removeItem(itemId){
                                                    document.getElementById(itemId).remove();
                                                    clearanceItemArray.splice(itemId,1)
                                                    $('#clearanceHidden').val(JSON.stringify(clearanceItemArray))
                                                }
                                            </script>
                                        </div>
                                        <div class="col p-2">
                                            <button class="btn btn-danger w-100 p-3" onclick="$('#clearanceInput').val('')">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col p-2">
                                <h6 class="w-100 text-center m-0 alert-light p-3">Clearance List</h6>
                                <hr class="m-0">
                                <ul class="mx-2" id="clearanceList" style="height: 200px;overflow-y:scroll;">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <div class="row w-100 text-center">
                        <div class="col-3">
                            <div class="border border-secondary rounded text-center pt-2">
{!! Form::open(['action'=>'App\Http\Controllers\Staff\StaffInsertController@InsertOffboardee', 'method'=>'POST', 'id'=>'modal_offboarding_form']) !!}
                                {{ Form::label('chk', 'Notifications', ['class' => 'control-label']) }}
                                {!! Form::checkbox('chk', 'value', true,['class'=>'form-check-input']) !!}
                            </div>
                        </div>
                        <div class="col">
                                {!! Form::hidden('clearanceHidden', '[]', ['id'=>'clearanceHidden']) !!}
                                {!! Form::hidden('term_type', '', ['id'=>'term_type']) !!}
                                {!! Form::hidden('emp_id', '', ['id'=>'emp_id']) !!}
                                {!! Form::submit('', ['id'=>'confirm_btn', 'class' => ' w-100 btn btn-outline-danger p-4']) !!}
{!! Form::close() !!}
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-danger w-100 p-4" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @section('script')
    <script>
        $('#edit_modal').on('hidden.bs.modal', function () {
            clearanceItemId = 0
            clearanceItemArray = []
            $('#clearanceInput').val('')
            $('#clearanceList').html('')
            $('#clearanceHidden').val('')
        })

    function offboarding(offboarding_type,emp_id,picture,fullname,dept,pos,phone,email,resignedId, resignedStatus){

        if(resignedId){
            $('#modal_offboarding_form').html($('#modal_offboarding_form').html()
                +
                `<input type="hidden" name="resignedId" value="${resignedId}">`
            )
        }

        $('#emp_picture').attr('src',picture)

        $('#emp_details').html(`
            <h2>${fullname}</h2>
            <h5>Department: ${dept}</h5>
            <h5>Position: ${pos}</h5>`)

        $('#contact_detail').html(`
            <b>Contact Details</b>
            <h5>Phone</h5>${phone}
            <h5>Email Address</h5>${email}`)

        $('#confirm_btn').val(`Confirm ${offboarding_type}`)

        var txt_cls = ''
        if(offboarding_type == 'Termination'){
            txt_cls ='danger'
        }
        if(offboarding_type == 'Retirement'){
            txt_cls ='secondary'
        }
        if(offboarding_type == 'Resignation'){
            txt_cls ='warning'
        }

        $('#term_type').val(offboarding_type)
        $('#emp_id').val(emp_id)

        var today = new Date();

        $('#term_detail').html(`
            <h5>Employee For</h5>
            <h2 class='display-2 text-${txt_cls}'>${offboarding_type}</h2>
            <hr>
            <h5>Offboarding Date: ${today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()}</h5>
        `)
    }
    </script>
    @endsection
