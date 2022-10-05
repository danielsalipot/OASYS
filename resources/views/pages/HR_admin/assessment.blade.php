@extends('layout.admin_app')

    @php ($categories = [
        'attendance' => [
            'Based on the information above, rate the quarterly attendance record of employee',
            'Employee applies for leave when intending to go absent',
            'Employee follows their time in and time out schedule',
        ],
        'performance' => [
            'Complies with company policies and procedures',
            'Employee’s work is of high quality',
            'Employee stays focused on tasks at hand',
            'Employee knows how to prioritize tasks',
            'Employee gets assignments in on time'
        ],
        'character' => [
            'Handles stressful situations with tact',
            'Communicates clearly and intelligently with coworkers',
            'Employee shows an examplar characteristics of a good employee',
            'Employee exhibit being a moral person.',
            'Employee shows dependability, honesty, loyalty, and integrity.'
        ],
        'cooperation' => [
            "how often does the employee connect with his/her colleagues outside the workplace",
            "Employee's capability to listen to colleagues' ideas and give them a proper feedback",
            "How well does the employee work in pairs or in a group?",
            "Employee shows great interpersonal communication skills: active listening, openness, decision making, conflict resolution, etc.",
            "Employee exhibits proper etiquette in the workplace"
        ]
    ])

    @section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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

        <form action="/addAssessment" method="POST">
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

                <div class="card m-3 alert-light text-center border-secondary shadow-sm p-5" id="select_date_prompt">
                    <h1><i class="bi bi-calendar" style="font-size:100px"></i></h1>
                    <h1>Please select a Date of assessment</h1>
                </div>

                @foreach ($recorded_assessment as $key => $assessment)
                @if (isset($assessment[0]->quarter))

                <div class="recorded_assessment d-none row m-3" id="recorded_assessment_{{$assessment[0]->quarter}}">
                    @foreach ($assessment as $item)
                        <div class="col-6 my-4">
                            <h5 class="p-3 alert-primary w-25 text-center m-0 rounded-top">{{ ucfirst($item->assessment_type) }}</h5>
                            <div class="card w-100 p-3 rounded-0 rounded-bottom rounded-end shadow-sm">
                                <div class="row mx-2">
                                    <div class="col-4 ">
                                        <div class="row p-3 text-center alert-success rounded shadow-sm py-5 h-50 mb-3">
                                            <h6>Score</h6>
                                            <h1 style="font-size: 40px">{{ round($item->score) }}%</h1>
                                        </div>
                                        <div class="row p-1 text-center alert-light rounded shadow-sm h-25">
                                            <h6 class="w-100 p-2 pb-0 mt-3 mb-0 text-center">Date of Assessment</h6>
                                            <h5 class="mt-0 p-0">{{ date('Y-m-d',strtotime($item->created_at))}}</h5>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h6 class="w-100 alert-light p-3 rounded shadow-sm m-0">Feedback</h6>
                                        <textarea name="" class="w-100 form-control" rows="15" disabled>{{ $item->feedback }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <button type="button" onclick="delete_assessment([{{$assessment[0]->id}},{{$assessment[1]->id}},{{$assessment[2]->id}},{{$assessment[3]->id}}])" class="btn btn-lg btn-outline-danger w-50 mx-auto"><i class="bi bi-trash h1"></i><br>Delete Assessment</button>
                </div>
                @endif
                @endforeach

                <div class="row mx-3 mt-4 d-none" id="assessment_div">
                    <ul class="nav nav-tabs">
                    @foreach ($categories as $category_name => $category)
                        @if($category_name == 'attendance')
                            <li class="active"><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#{{$category_name}}_tab">{{ucfirst($category_name)}}</a></li>
                        @else
                            <li><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#{{$category_name}}_tab">{{ucfirst($category_name)}}</a></li>
                        @endif
                    @endforeach
                    </ul>

                    <div class="tab-content p-0">
                    @foreach ($categories as $category_name => $category)
                    @if($category_name == 'attendance')
                        <div id="{{$category_name}}_tab" class="tab-pane in active">
                    @else
                        <div id="{{$category_name}}_tab" class="tab-pane in">
                    @endif
                            <div class="container p-3 w-100 bg-white border shadow-sm">
                                <div class="row card p-5 m-1">
                                    <div class="row">
                                        <div class="col-2 text-center">
                                            <h6 class="text-secondary">Lowest</h1>
                                        </div>
                                        <div class="col"></div>
                                        <div class="col-2 text-center">
                                            <h6 class="text-secondary">Highest</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-2 text-center">
                                            <h1>1</h1>
                                        </div>
                                        <div class="col"></div>
                                        <div class="col-2 text-center">
                                            <h1>5</h1>
                                        </div>
                                    </div>
                                </div>

                                @if ($category_name == 'attendance')
                                <div class="row w-100 ms-1 mb-5 ">
                                    <div class="col-7 card p-5 text-center alert-success">
                                        <div class="row mt-5">
                                            <div class="col">
                                                <h4 class="display-6">On Time Record</h4>
                                                <h1 class="p-3" style="font-size:45px;" id="on_time_record_value">1</h1>
                                            </div>
                                            <div class="col">
                                                <h4 class="display-6">On Time Percentage</h4>
                                                <h1 class="p-3" style="font-size:45px;" id="on_time_record_percentage">100%</h1>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="col">
                                        <div class="row card p-3 h-50 text-center alert-warning">
                                            <div class="row">
                                                <div class="col">
                                                    <p style="font-size:15px">Late Record</p>
                                                    <h1 class="p-3" id="late_record_value">1</h1>
                                                </div>
                                                <div class="col">
                                                    <p style="font-size:15px">Late Percentage</p>
                                                    <h1 class="p-3" id="late_record_percentage">100%</h1>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row card p-3 h-50 text-center alert-danger">
                                            <div class="row">
                                                <div class="col">
                                                    <p style="font-size:15px">Absent Record</p>
                                                    <h1 class="p-3" id="absent_record_value">1</h1>
                                                </div>
                                                <div class="col">
                                                    <p style="font-size:15px">Absent Percentage</p>
                                                    <h1 class="p-3" id="absent_record_percentage">100%</h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                @foreach ($category as $key => $item)
                                <div class="shadow-sm p-5 rounded">
                                    <p style="font-size:15px">
                                        {{ $key + 1 }}. {{ $item }}
                                    </p>
                                    <div class="row text-center">
                                        <div class="col">
                                            <label  class="h1" for="html">1</label><br>
                                            <input type="radio" id="html" name="{{$category_name}}_{{$key}}" value="1" required>
                                        </div>
                                        <div class="col">
                                            <label  class="h1" for="html">2</label><br>
                                            <input type="radio" id="html" name="{{$category_name}}_{{$key}}" value="2">
                                        </div>
                                        <div class="col">
                                            <label  class="h1" for="html">3</label><br>
                                            <input type="radio" id="html" name="{{$category_name}}_{{$key}}" value="3">
                                        </div>
                                        <div class="col">
                                            <label  class="h1" for="html">4</label><br>
                                            <input type="radio" id="html" name="{{$category_name}}_{{$key}}" value="4">
                                        </div>
                                        <div class="col">
                                            <label  class="h1" for="html">5</label><br>
                                            <input type="radio" id="html" name="{{$category_name}}_{{$key}}" value="5">
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                                <h4 class="rounded-top p-3 alert-success w-25 m-0 mt-4 text-center">Feedback</h4>
                                <textarea name="{{$category_name}}_feedback" class="form-control w-100 m-0 rounded-0 rounded-bottom rounded-end" rows="10"></textarea>
                            </div>
                        </div>
                    @endforeach
                    </div>

                    {{-- SUBMIT ASSESSMENT CONTROLS --}}
                    <div class="row my-4">
                        <div class="col-8">
                            <button type="submit" class="w-100 p-4 btn btn-outline-success">Submit</button>
                        </div>
                        <div class="col">
                            <button type="button" class="w-100 p-4 btn btn-danger" onclick="location.reload()">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    @endsection

    @section('script')
    <script>
        var assessment_ids = []

        function dateonchange(select){
            var start = document.getElementById('start_date')
            var end = document.getElementById('end_date')
            var submit = document.getElementById('submit_assessment')
            var id = document.getElementById('employee_id_txt')

            var assessment_div = document.getElementById('assessment_div')
            var select_date_prompt = document.getElementById('select_date_prompt')

            var date_period = []
            switch (select.value) {
                case "1":
                    date_period[0] = '{{$carbon->month(1)->startOfQuarter()->format("Y-m-d")}}'
                    date_period[1] = '{{$carbon->month(1)->endOfQuarter()->format("Y-m-d")}}'
                    break;

                case "2":
                    date_period[0] = '{{$carbon->month(4)->startOfQuarter()->format("Y-m-d")}}'
                    date_period[1] = '{{$carbon->month(4)->endOfQuarter()->format("Y-m-d")}}'
                    break;

                case "3":
                    date_period[0] = '{{$carbon->month(7)->startOfQuarter()->format("Y-m-d")}}'
                    date_period[1] = '{{$carbon->month(7)->endOfQuarter()->format("Y-m-d")}}'
                    break;

                case "4":
                    date_period[0] = '{{$carbon->month(10)->startOfQuarter()->format("Y-m-d")}}'
                    date_period[1] = '{{$carbon->month(10)->endOfQuarter()->format("Y-m-d")}}'
                    break;
                default:
                    assessment_div.classList.add('d-none')
                    $('.recorded_assessment').addClass('d-none');
                    select_date_prompt.classList.remove('d-none')
                    return;
                    break;
            }

            select_date_prompt.classList.add('d-none')
            var rec_ass = document.getElementById(`recorded_assessment_${select.value}`)
            if(rec_ass){
                $('.recorded_assessment').addClass('d-none');
                rec_ass.classList.remove('d-none')
                assessment_div.classList.add('d-none')
            }else{
                $('.recorded_assessment').addClass('d-none');
                assessment_div.classList.remove('d-none')
            }

            start.value = date_period[0]
            end.value = date_period[1]

            $.get(`/getQuarterlyAttendance/1/${date_period[0]}/${date_period[1]}`, function( data ) {
                var on_time =[$("#on_time_record_value"),$("#on_time_record_percentage")]
                var late =[$("#late_record_value"),$("#late_record_percentage")]
                var absent =[$("#absent_record_value"),$("#absent_record_percentage")]

                on_time[0].html(data.ontime)
                late[0].html(data.late)
                absent[0].html(data.absent)
                on_time[1].html(data.ontime_percentage + '%')
                late[1].html(data.late_percentage + '%')
                absent[1].html(data.absent_percentage + '%')
            })
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

        function delete_assessment(assessment_ids){
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
