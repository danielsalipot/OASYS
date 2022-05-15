@extends('layout.staff_app')
    @section('title')
        <h1 class="section-title mt-2 pb-1">Interview Management</h1>
    @endsection

    @section('content')
    <div class="container">
        <table class="table w-100 text-center" id="applicant_table">
            <thead>
            <tr>
                <th scope="col">Picture</th>
                <th scope="col">Employee Name</th>
                <th scope="col">Applying for</th>
                <th scope="col">Education</th>
                <th scope="col">Application Date</th>
                <th scope="col">First Interview</th>
                <th scope="col">Second Interview</th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <!-- The Modal -->
    <div class="modal" id="edit_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <div class="modal-title w-100 h3">Feedback on the Interview</div>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4 text-center">
                            <img src="" class="w-75 m-3 rounded" id="app_pic">
                            <h4 id="app_name"></h4>
                            <hr>
                            <h6 class="text-secondary">Interview Date:</h6>
                            <h6 id="int_date" class="card p-2 text-secondary shadow-sm"></h6>
                        </div>
                        <div class="col">
                            <h3>Add Feedback</h3>
                            <hr>
                            {!! Form::open(['action'=>'App\Http\Controllers\Staff\StaffUpdateController@WithResponseInterview', 'method'=>'GET']) !!}
                            <select class="btn btn-outline-primary w-100 p-3 h3" name="score" id="score">
                                <option value="Passed">Passed</option>
                                <option value="Failed">Failed</option>
                            </select>
                            <textarea name="feedback" id="feedback" rows="12" class="w-100"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <div class="row w-100 text-center">
                        <div class="col">
                                {!! Form::hidden('interview_id','', ['id'=>'interview_id']) !!}
                                {!! Form::submit('Confirm', ["class"=>"btn w-75 btn-success p-2"]) !!}
                            {!! Form::close() !!}
                        </div>
                        <div class="col">
                            <button class="btn w-75 btn-danger p-2">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


     <!-- The Modal -->
     <div class="modal" id="view_model">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <div class="modal-title w-100 h3">Feedback on the Interview</div>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4 text-center">
                            <img src="" class="w-75 m-3 rounded" id="view_app_pic">
                            <h4 id="view_app_name"></h4>
                            <hr>
                            <h6 class="text-secondary">Interview Date:</h6>
                            <h6 id="view_int_date" class="card p-2 text-secondary shadow-sm"></h6>
                        </div>
                        <div class="col">
                            <h3>Add Feedback</h3>
                            <hr>
                            <div id="view_score"></div>
                            <textarea name="view_feedback" readonly id="view_feedback" rows="12" class="w-100"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer text-center">
                    <button class="btn w-25 btn-danger p-2">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @section('script')
        <script>
        $(document).ready(function(){
            $('#applicant_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/interviewjson',
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
                                    <h5>Sex: ${row.sex}</h5>
                                    <h5>Age: ${row.age}</h5>`
                        }
                    },
                    { data: 'Applyingfor',
                        render : (data,type,row)=>{
                            return `${data}`
                        }
                    },
                    { data: 'educ',
                        render : (data,type,row)=>{
                            return `${data}`
                        }
                    },
                    { data: 'date',
                        render : (data,type,row)=>{
                            return `${data}`
                        }
                    },
                    { data: 'first',
                        render : (data,type,row)=>{
                            return `<b>${data}</b>`
                        }
                    },
                    { data: 'second',
                        render : (data,type,row)=>{
                            return `<b>${data}</b>`
                        }
                    }
                ]
            });
        })

        function modal_update(app_pic,int_id,app_name,int_date){
            $('#app_pic').attr('src',app_pic)
            $('#interview_id').val(int_id)
            $('#app_name').html(app_name)
            $('#int_date').html(int_date)
        }

        function modal_view(app_pic,app_name,int_date,score,feedback){
            $('#view_app_pic').attr('src',app_pic)
            $('#view_app_name').html(app_name)
            $('#view_int_date').html(int_date)
            if(score == "Passed"){
                $('#view_score').html(`<h5 class='p-3 bg-success rounded w-100 text-center text-white'>${score}</h5>`)
            }else{
                $('#view_score').html(`<h5 class='p-3 border border-danger rounded w-100 text-center text-danger'>${score}</h5>`)
            }

            $('#view_feedback').html(feedback)
        }

    </script>
    @endsection
