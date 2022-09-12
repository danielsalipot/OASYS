@extends('layout.admin_app')
    @section('content')
    <h1 class="section-title mt-5 pb-2">Performance Assessment</h1>

    <form action="/addAssessment" method="POST">
        @csrf
        {!! Form::hidden('employee_id', $employee->employee_id) !!}
    <div class="row">
        <div class="col-3 p-0 text-center me-4">
            <a href="/admin/performance" class="btn btn-lg btn-outline-danger p-4 rounded-0 w-100">Select new Employee</a>
            <div class="card mt-5 shadow-lg">
                <h1 class="display-6 alert-primary rounded-0 rounded-top p-4 m-0">Employee Details</h1>
                <img src="/{{$employee->userDetail->picture}}" class="mx-auto" style="height: 100%; width:100%;">

                <br>

                <h2 class="h1">{{$employee->userDetail->fname}} {{$employee->userDetail->mname}} {{$employee->userDetail->lname}}</h2>
                <div class="row p-1 mx-4">
                    <div class="col text-end"><h5 class="">Employee ID:</h5></div>
                    <div class="col text-center" id="employee_id_txt">{{ $employee->employee_id }}</div>
                </div>
                <div class="row p-1 mx-4">
                    <div class="col text-end"><h5 class="">Employee Position: </h5></div>
                    <div class="col text-center">{{ $employee->position }}</div>
                </div>
                <div class="row p-1 mx-4">
                    <div class="col text-end"><h5 class="">Employmee Department: </h5></div>
                    <div class="col text-center">{{ $employee->department }}</div>
                </div>
                <a href="/admin/performance/{{$employee->employee_id}}/history" class="btn btn-lg btn-outline-primary rounded-0 rounded-bottom p-4 mt-5 w-100">View Assessment History</a>
            </div>
        </div>

        <div class="col p-0 border rounded shadow-sm">
            <h1 id="state_indicator" class="m-0 w-100 alert-primary text-center p-3 mb-3">Create New Assessment</h1>
            <div class="row alert-light border rounded p-3 pb-4 mx-3 shadow-sm">
                <div class="col-4 text-center">
                    <h1 class="display-5 mt-5 pt-2">Date of Assessment</h1>
                </div>

                <div class="col p-0">
                    <div class="row p-3">
                        <select name="quarter" onchange="dateonchange(this)" class="form-select form-select-lg m-0 w-100" aria-label="Default select example">
                            <option value="0" selected>Select Date of Assessment</option>
                            @if (in_array("1",$quarters))
                                <option value="1" class="alert-success">1st Quarter of {{ date("Y") }} </option>
                            @else
                                <option value="1" >1st Quarter of {{ date("Y") }}</option>
                            @endif

                            @if (in_array("2",$quarters))
                                <option value="2" class="alert-success">2nd Quarter of {{ date("Y") }} </option>
                            @else
                                <option value="2">2nd Quarter of {{ date("Y") }}</option>
                            @endif

                            @if (in_array("3",$quarters))
                                <option value="3" class="alert-success">3rd Quarter of {{ date("Y") }}</option>
                            @else
                                <option value="3">3rd Quarter of {{ date("Y") }}</option>
                            @endif

                            @if (in_array("4",$quarters))
                                <option value="4" class="alert-success">4th Quarter of {{ date("Y") }}</option>
                            @else
                                <option value="4">4th Quarter of {{ date("Y") }}</option>
                            @endif

                        </select>
                    </div>
                    <div class="row p-0">
                        <div class="col">
                            {!! Form::label('start_date','Start Date') !!}
                            {!! Form::text('start_date','', ['class'=>'form-control form-control-lg text-center','readonly', 'id'=>'start_date']) !!}
                        </div>
                        <div class="col">
                            {!! Form::label('end_date', 'End date') !!}
                            {!! Form::text('end_date','', ['class'=>'form-control form-control-lg text-center','readonly', 'id'=>'end_date']) !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row p-4 mx-2">
                <div class="col pe-5">
                    <div class="row">
                        <h2>Attendance</h2>

                        <div class="col-2 py-2 text-end"><h4>Score</h4></div>
                        <div class="col">
                            <input type="number" max="100" min="0" oninput="minMaxNumberInput(this)" name="attendance_score" id="attendance_score" class="form-control rounded-left w-100" placeholder="Score">
                            <span class="text-danger">@error('attendance_score'){{$message}}@enderror</span>
                        </div>

                    </div>
                    <div class="row">
                        <h3>Feedback</h3>
                        {{Form::textarea('attendance_feedback','',['id'=>'attendance_feedback','class'=>'form-control h-25 w-100','style'=>'font-size:15px',
                            'placeholder'=>'Comments and Suggestion'])}}
                        <span class="text-danger">@error('attendance_feedback'){{$message}}@enderror</span>
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <h2>Performance</h2>

                        <div class="col-2 py-2 text-end"><h4>Score</h4></div>
                        <div class="col">
                            <input name="performance_score" id="performance_score" type="number" max="100" min="0" oninput="minMaxNumberInput(this)" class="form-control rounded-left w-100" placeholder="Score">
                            <span class="text-danger">@error('performance_score'){{$message}}@enderror</span>
                        </div>
                    </div>
                    <div class="row">
                        <h3>Feedback</h3>
                        {{Form::textarea('performance_feedback','',['id'=>'performance_feedback','class'=>'form-control h-25 w-100','style'=>'font-size:15px',
                            'placeholder'=>'Comments and Suggestion'])}}
                        <span class="text-danger">@error('performance_feedback'){{$message}}@enderror</span>

                    </div>
                </div>
            </div>

            <div class="row p-4 mx-2">
                <div class="col pe-5">
                    <div class="row">
                        <h2>Character</h2>

                        <div class="col-2 py-2 text-end"><h4>Score</h4></div>
                        <div class="col">
                            <input type="number" max="100" min="0" oninput="minMaxNumberInput(this)" name="character_score" id="character_score" class="form-control rounded-left w-100" placeholder="Score">
                            <span class="text-danger">@error('character_score'){{$message}}@enderror</span>
                        </div>
                    </div>
                    <div class="row">
                        <h3>Feedback</h3>
                        {{Form::textarea('character_feedback','',['id'=>'character_feedback','class'=>'form-control h-25 w-100','style'=>'font-size:15px',
                            'placeholder'=>'Comments and Suggestion'])}}
                            <span class="text-danger">@error('character_feedback'){{$message}}@enderror</span>
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <h2>Cooperation</h2>

                        <div class="col-2 py-2 text-end"><h4>Score</h4></div>
                        <div class="col">
                            <input type="number" max="100" min="0" oninput="minMaxNumberInput(this)" name="cooperation_score" id="cooperation_score" class="form-control rounded-left w-100" placeholder="Score">
                            <span class="text-danger">@error('cooperation_score'){{$message}}@enderror</span>
                        </div>
                    </div>
                    <div class="row">
                        <h3>Feedback</h3>
                        {{Form::textarea('cooperation_feedback','',['id'=>'cooperation_feedback','class'=>'form-control h-25 w-100','style'=>'font-size:15px',
                            'placeholder'=>'Comments and Suggestion'])}}
                        <span class="text-danger">@error('cooperation_feedback'){{$message}}@enderror</span>
                    </div>
                </div>
            </div>
            <div class="row p-3">
                <div class="m-0 p-0 w-100 text-center" id="insert_controls">
                    <button type="submit" class='btn btn-primary btn-lg p-3 w-50 m-auto' id='submit_assessment' disabled><i class="bi bi-pencil-square h3"></i><br>Submit Assessment</button>
                    <button type="button" class="btn btn-outline-danger h-100 px-4" onclick="location.reload()"><i class="bi bi-x-circle h3"></i><br>Cancel</button>
            </form>
                </div>

                <div class="p-0 m-0 text-center w-100 d-none" id="update_controls">
                    <button type="button" class="btn btn-outline-secondary h-100 px-3" onclick="enable_fields(this)"><i class="bi bi-lock h3"></i><br>Enable</button>
                    <button type="button" onclick='update_assessment()' class='btn btn-success btn-lg p-4 w-25 m-auto' style='font-size:15px'>Update Current Assessment</button>
                    <button type="button" class="btn btn-outline-danger h-100 px-3 me-3" onclick="location.reload()"><i class="bi bi-x-circle h3"></i><br>Cancel</button>

                    <button type="button" class="btn btn-danger h-100 px-5 ms-5" onclick="delete_assessment()"><i class="bi bi-trash h3"></i><br>Delete</button>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @section('script')
    <script>
        var assessment_ids = []

        function dateonchange(select){
            var start = document.getElementById('start_date')
            var end = document.getElementById('end_date')
            var submit = document.getElementById('submit_assessment')
            var id = document.getElementById('employee_id_txt')

            if(select.value){
                submit.disabled = false
            }
            else{
                submit.disabled = true
            }

            switch (select.value) {
                case "1":
                    start.value = '{{$carbon->month(1)->startOfQuarter()->format("Y-m-d")}}'
                    end.value = '{{$carbon->month(1)->endOfQuarter()->format("Y-m-d")}}'
                    break;

                case "2":
                    start.value = '{{$carbon->month(4)->startOfQuarter()->format("Y-m-d")}}'
                    end.value = '{{$carbon->month(4)->endOfQuarter()->format("Y-m-d")}}'
                    break;

                case "3":
                    start.value = '{{$carbon->month(7)->startOfQuarter()->format("Y-m-d")}}'
                    end.value = '{{$carbon->month(7)->endOfQuarter()->format("Y-m-d")}}'
                    break;

                case "4":
                    start.value = '{{$carbon->month(10)->startOfQuarter()->format("Y-m-d")}}'
                    end.value = '{{$carbon->month(10)->endOfQuarter()->format("Y-m-d")}}'
                    break;

                default:
                    break;
            }

            $.get(`/getEmployeeAssessment/${select.value}/${id.innerHTML}`, function( data ) {
                // DATA is retreive, update UI na lang tapos edit button and save edit
                var score_arr = [document.getElementById('attendance_score'),document.getElementById('performance_score'),document.getElementById('character_score'),document.getElementById('cooperation_score')]
                var feedback_arr = [document.getElementById('attendance_feedback'),document.getElementById('performance_feedback'),document.getElementById('character_feedback'),document.getElementById('cooperation_feedback')]
                var state_indicator = document.getElementById('state_indicator')
                var insert_controls = document.getElementById('insert_controls')
                var update_controls = document.getElementById('update_controls')

                if(data.length){
                    for (let i = 0; i < 4; i++) {
                        score_arr[i].value = data[i].score
                        feedback_arr[i].value = data[i].feedback

                        score_arr[i].disabled = true
                        feedback_arr[i].disabled = true

                        assessment_ids.push(data[i].id)
                    }
                    state_indicator.classList.remove('alert-primary')
                    state_indicator.classList.add('alert-success')

                    insert_controls.classList.add('d-none')
                    update_controls.classList.remove('d-none')


                    state_indicator.innerHTML = "Edit Current Assessment"
                }
                else{
                    for (let i = 0; i < 4; i++) {
                        score_arr[i].value = ''
                        feedback_arr[i].value = ''

                        score_arr[i].disabled = false
                        feedback_arr[i].disabled = false

                        assessment_ids = []
                    }
                    state_indicator.classList.add('alert-primary')
                    state_indicator.classList.remove('alert-success')

                    insert_controls.classList.remove('d-none')
                    update_controls.classList.add('d-none')

                    state_indicator.innerHTML = "Create New Assessment"
                }
            });
        }

        function enable_fields(btn){
            var score_arr = [document.getElementById('attendance_score'),document.getElementById('performance_score'),document.getElementById('character_score'),document.getElementById('cooperation_score')]
            var feedback_arr = [document.getElementById('attendance_feedback'),document.getElementById('performance_feedback'),document.getElementById('character_feedback'),document.getElementById('cooperation_feedback')]

            for (let i = 0; i < 4; i++) {
                score_arr[i].disabled = !score_arr[i].disabled
                feedback_arr[i].disabled = !feedback_arr[i].disabled
            }
        }

        function update_assessment(){
            var score_arr = [document.getElementById('attendance_score'),document.getElementById('performance_score'),document.getElementById('character_score'),document.getElementById('cooperation_score')]
            var feedback_arr = [document.getElementById('attendance_feedback'),document.getElementById('performance_feedback'),document.getElementById('character_feedback'),document.getElementById('cooperation_feedback')]

            var scores = []
            score_arr.forEach(element => {
                scores.push(element.value)
            });

            var feedbacks = []
            feedback_arr.forEach(element => {
                feedbacks.push(element.value)
            });

            $.post("/updateEmployeeAssessment",
            {
                _token: '{{csrf_token()}}',
                ids: assessment_ids,
                scores: scores,
                feedbacks: feedbacks
            },
            function(data,status){
                location.reload()
            });
        }

        function delete_assessment(){
            $.post("/deleteEmployeeAssessment",
            {
                _token: '{{csrf_token()}}',
                ids: assessment_ids,
            },
            function(data,status){
                location.reload()
            });
        }

        function minMaxNumberInput(input){
            if(input.value > 101){
                input.value = input.value.slice(0,-1)
            }
        }
    </script>
    @endsection
