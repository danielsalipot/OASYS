@extends('layout.staff_app')
    @section('title')
        <h1 class="section-title mt-2 pb-1">Offboarding Management</h1>
    @endsection

    @section('content')
        <table class="table table-striped table-dark w-100 text-center" id="employee_table">
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
    @endsection

    @section('modal')
        <!-- The Modal -->
    <div class="modal" id="edit_modal">
        <div class="modal-dialog">
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
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <div class="row w-100 text-center">
                        <div class="col-3">
                            <div class="border border-secondary rounded text-center pt-2">
{!! Form::open(['action'=>'App\Http\Controllers\Staff\StaffInsertController@InsertOffboardee', 'method'=>'POST']) !!}
                                {{ Form::label('chk', 'Notifications', ['class' => 'control-label']) }}
                                {!! Form::checkbox('chk', 'value', true,['class'=>'form-check-input']) !!}
                            </div>
                        </div>
                        <div class="col">
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
                        return `${row.retire} ${row.resign} ${row.terminate}`
                    }
                },
            ]
        });
    })

    function offboarding(offboarding_type,emp_id,picture,fullname,dept,pos,phone,email){
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
