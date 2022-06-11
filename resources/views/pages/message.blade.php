@extends('layout.messaging')

@section('style')
@endsection

@section('title')
@endsection

@section('content')
<div class="row">
    <div class="col-3 p-3 border border-secondary rounded ">
        <div class="container">
            <table class="w-100 text-center" id="employee_list">
                <thead>
                    <tr>
                        <h1 class="display-5  w-100 text-center m-2 pb-2">Messages</h1>
                        <th class="display-5 p-2">Employee List</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="col rounded mx-2">
        <div class="row border rounded" style="padding:0px">
            <div class='border rounded d-flex align-items-center' style="width:100%;">
                <img id="emp_pic" style='height:50px; width:50px;' class='shadow rounded-circle m-3'>
                <h4 id="emp_name">Employee Name</h4>
            </div>
            <div class="p-2" id="message_div"  style="height: 500px; overflow-y:scroll ">

            </div>
        </div>

        <div class="row mt-4">
            {!! Form::hidden('', '', ['id'=>'rid']) !!}
            <textarea name="editor1" id="editor1" class="w-100" cols="30" rows="10"></textarea>
            <button onclick="send_click()" class="btn btn-lg btn-primary w-25 mt-3 p-4 ">Send</button>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $('#employee_list').DataTable({
            language: { search: "",searchPlaceholder: "Search..." },
            "dom":'<"m-auto w-50"f><t><"m-auto w-50"p>',
            "bInfo" : false,
            ordering:false,
            "bLengthChange": false,
            processing: true,
            serverSide: true,
            ajax: {
                url: '/chatemployeelistjson'
            },
            columns: [
                { data: 'full_name',
                    render : (data,type,row)=>{
                        return row.btn;
                    }
                }
            ]
        })

        var myInterval;
        function chat_click(btn,name,pic,id){
            clearInterval(myInterval);
            $('#rid').val(id)
            btn.className = "text-dark card w-100 alert-primary shadow-lg text-center p-2 m-2"

            $('#employee_list button').not(btn).prop('class',"text-dark card w-100 shadow-lg text-center p-2 m-2");

            $('#emp_name').html(name)
            $('#emp_pic').attr("src",pic)

            function load_chat(){
                $.ajax({
                url: `/messagejson/${id}`,
                type: 'get',
                success: function(response){

                    $('#message_div').html('')
                    if(!response.length){
                        $('#message_div').html('<h6 class="display-4 w-100 text-center text-secondary">No Message Yet</h6>')
                    }
                    response.forEach(element => {
                        if(element.sender_id == {{session()->get('user_id')}}){
                            $('#message_div').html(`${$('#message_div').html()}
                            <div class="w-50 mt-4" style="margin-left: auto; margin-right: 0;font-size:13px">${element.sender.fname} ${element.sender.mname} ${element.sender.lname}</div>
                            <div class="alert-primary w-50 p-4 rounded shadow-sm"
                                style="margin-left: auto; margin-right: 0;font-size:13px">
                                ${element.message}
                            </div>
                            <div class="w-50 mb-4 text-right"
                                style="margin-left: auto; margin-right: 0;font-size:13px">
                                ${new Date(element.created_at)}
                            </div>`)
                        }
                        else{
                            $('#message_div').html(`${$('#message_div').html()}
                            <div class="w-50 mt-4" style="font-size:13px">${element.sender.fname} ${element.sender.mname} ${element.sender.lname}</div>
                            <div class="alert-secondary w-50 p-4 rounded shadow-sm"
                                style="font-size:13px">
                                ${element.message}
                            </div>
                            <div class="w-50 mb-4 text-right"
                                style="font-size:13px">
                                ${new Date(element.created_at)}
                            </div>`)
                        }

                    });
                }
            });
            }
            load_chat()
            myInterval = setInterval(function(){
                load_chat()
            }, 5000);
        }

        function send_click(){
            $.ajax({
                url: `/sendmessage`,
                type: 'get',
                data: {
                    sid:{{session()->get('user_id')}},
                    rid:$('#rid').val(),
                    msg:$('#editor1').val()},
                success: function(response){
                    $(`#btn${response}`).click();
                    $('#editor1 ').val('')
                }
            })
        }

    </script>
@endsection
