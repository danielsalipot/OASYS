@extends('layout.messaging')

@section('title')
    <h1 class="section-title mt-5 pb-2">Notification</h1>
@endsection

@section('content')
<div class="row">
    <div class ="col-4">
        <div class=" border rounded me-4 p-2">
            <div class="container w-100">
                <a href="/payroll/notification/views" class="btn btn-primary w-100 mt-3 p-3"> View Sent Notifications</a>
                <hr>
                <table class="table w-100 table-striped text-center table-dark" id="employee_table">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">ID</th>
                            <th scope="col">Picture</th>
                            <th scope="col">Name</th>
                            <th scope="col">Select</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div class="col">
        <h2 class="text-secondary">Sending to:</h2>
        <div id="selected_employee" class="d-flex flex-row flex-wrap mb-4">
        </div>

        <div class="row">
            {!! Form::open(['action'=> 'App\Http\Controllers\Payroll\PayrollInsertController@InsertNotification','method'=>'POST']) !!}
                {!! Form::hidden('ids','',['id'=>'emp_ids']) !!}
                {!! Form::label('title', 'Notification Title', ['class'=>'h2 text-secondary']) !!}
                {!! Form::text('title', '', ['class'=>'form-control']) !!}

                {{Form::label('body','Notification Message',['class'=>'h2 text-secondary pt-4'])}}
                {{Form::textarea('body','',['id'=>'article-ckeditor','class'=>'form-control',
                    'placeholder'=>'Notification Message'])}}
                <div class='row'>
                <div class='col'>
                {!! Form::submit('Send Notification', ['class'=>'btn btn-primary w-50 mt-3 p-3']) !!}
                </div>
                <div class="col-4">
                    <button type="button" onclick="location.reload()" class='btn btn-danger w-100 mt-3 p-3'>Cancel</button>
                </div>
                </div>
            {!! Form::close() !!}
    </div>
</div>
@endsection
@section('script')
<script src="//cdn.ckeditor.com/4.4.7/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'article-ckeditor' );
</script>

<script>
    $(document).ready(function(){
        $('#employee_table').DataTable({
                    processing: true,
                    serverSide: false,
                    ajax: {
                        url: '/notificationjson'
                    },
                    columns: [
                        { data: 'information_id',
                            render : (data,type,row)=>{
                                return `<b>${data}</b>`
                            }
                        },
                        { data: 'information_id',
                            render : (data,type,row)=>{
                                return `<img src="{{ URL::asset('${row.user_detail.picture}')}}" class="rounded" width="50" height="50">`
                            }
                        },
                        { data: 'user_detail.fname',
                            render : (data,type,row)=>{
                                return `<b>${data} ${row.user_detail.mname} ${row.user_detail.lname}</b>`
                            }
                        },
                        { data: 'information_id',
                            render : (data,type,row)=>{
                                return `<button type="button"
                                        onclick="selectEmployee(
                                            this,
                                            '${row.user_detail.information_id}',
                                            '${row.user_detail.picture}',
                                            '${row.user_detail.fname} ${row.user_detail.mname} ${row.user_detail.lname}'
                                            )" class="btn btn-outline-primary">Select</button>`
                            }
                        },
                    ]
                })
    })

    function selectEmployee(btn,info_id,emp_pic,emp_name){
        btn.classList.toggle('btn-outline-primary')
        btn.classList.toggle('btn-success')

        if(btn.innerHTML == 'Select'){
            $('#selected_employee').html(`
            ${$('#selected_employee').html()}
                <div class="col-3  rounded border">
                    <img src="{{ URL::asset('${emp_pic}')}}" class="rounded" width="50" height="50">
                    ${emp_name}
                    </div>
            `)
            $('#emp_ids').val(`${$('#emp_ids').val()}${info_id};`)
            btn.innerHTML = 'Selected'
        }
        else{
            btn.innerHTML = 'Select'
            $('#selected_employee').html($('#selected_employee').html().replace(`<div class="col-3  rounded border">
                    <img src="{{ URL::asset('${emp_pic}')}}" class="rounded" width="50" height="50">
                    ${emp_name}
                    </div>`,''))
            $('#emp_ids').val(`${$('#emp_ids').val().replace(`${info_id};`,'')}`)
        }



    }
</script>
@endsection
