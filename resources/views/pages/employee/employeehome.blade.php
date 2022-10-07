@extends('layout.employee_app')
    @section('content')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css">

    @php ($health_check_assets = [
        ['icon' => '🤢' , 'description' => 'Sick'],
        ['icon' => '😷'  , 'description' => 'Bad'],
        ['icon' => '😕' , 'description' => 'Unpleasant'],
        ['icon' => '😐' , 'description' => 'Neutral'],
        ['icon' => '🙂' , 'description' => 'Good'],
        ['icon' => '😀' , 'description' => 'Better'],
        ['icon' => '😁' , 'description' => 'Best'],
    ])

        <div class="container w-100 p-2">
            <div class="row">
                <div class="col d-none d-md-block">
                    <h1 class="section-title mt-2 pb-1 ">Employee Dashboard</h1>
                </div>
                @if($health_check_count)
                <div class="col card me-4 shadow-sm p-0">
                    <h4 class="w-100 m-0 rounded-top alert-warning p-2 text-center">Health Condition Today</h4>
                    @if($health_check->score <= 3)
                        <div class="row alert-danger w-100 mx-auto">
                    @elseif($health_check->score == 4)
                        <div class="row w-100 mx-auto">
                    @else
                        <div class="row alert-success w-100 mx-auto" >
                    @endif
                        @if ($health_check->score == 0)
                            <div class="col text-center card m-2 p-0">
                                <h5 class="w-100 alert-primary text-center p-2 m-0 rounded-top">Score</h5>
                                <h3 class="mt-2 display-6">Sick</h3>
                            </div>
                            <div class="col-3 text-end card m-2">
                                <h1 class="display-1">🤢</h1>
                            </div>
                        @endif
                        @if ($health_check->score == 1)
                            <div class="col text-center card m-2 p-0">
                                <h5 class="w-100 alert-primary text-center p-2 m-0 rounded-top">Score</h5>
                                <h3 class="mt-2 display-6">Bad</h3>
                            </div>
                            <div class="col-3 text-end card m-2">
                                <h1 class="display-1">😷</h1>
                            </div>
                        @endif
                        @if ($health_check->score == 2)
                            <div class="col text-center card m-2 p-0">
                                <h5 class="w-100 alert-primary text-center p-2 m-0 rounded-top">Score</h5>
                                <h3 class="mt-2 display-6">Unpleasant</h3>
                            </div>
                            <div class="col-3 text-end card m-2">
                                <h1 class="display-1">😕</h1>
                            </div>
                        @endif
                        @if ($health_check->score == 3)
                            <div class="col text-center card m-2 p-0">
                                <h5 class="w-100 alert-primary text-center p-2 m-0 rounded-top">Score</h5>
                                <h3 class="mt-2 display-6">Neutral</h3>
                            </div>
                            <div class="col-3 text-end card m-2">
                                <h1 class="display-1">😐</h1>
                            </div>
                        @endif
                        @if ($health_check->score == 4)
                            <div class="col text-center card m-2 p-0">
                                <h5 class="w-100 alert-primary text-center p-2 m-0 rounded-top">Score</h5>
                                <h3 class="mt-2 display-6">Good</h3>
                            </div>
                            <div class="col-3 text-end card m-2">
                                <h1 class="display-1">🙂</h1>
                            </div>
                        @endif
                        @if ($health_check->score == 5)
                            <div class="col text-center card m-2 p-0">
                                <h5 class="w-100 alert-primary text-center p-2 m-0 rounded-top">Score</h5>
                                <h3 class="mt-2 display-6">Better</h3>
                            </div>
                            <div class="col-3 text-end card m-2">
                                <h1 class="display-1">😀</h1>
                            </div>
                        @endif
                        @if ($health_check->score == 6)
                            <div class="col text-center card m-2 p-0">
                                <h5 class="w-100 alert-primary text-center p-2 m-0 rounded-top">Score</h5>
                                <h3 class="mt-2 display-6">Best</h3>
                            </div>
                            <div class="col-3 text-end card m-2">
                                <h1 class="display-1">😁</>
                            </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>

            @if(isset($health_check_count) && !$health_check_count)
            <div class="modal" id="myModal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header row">
                        <div class="col">
                            <h4 class="modal-title">Health Check</h4>
                        </div>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="/insertHealthCheck" method="POST">
                        @csrf
                        {!! Form::hidden('attendance_id',$attendance->attendance_id) !!}
                        <h1 class="p-4">Do you now have any of the following symptoms, or have you had any in the last 14 days? </h1>
                            @php ($choices = [
                                ['question' => 'Shortness of breath or difficulty breathing'],
                                ['question' => 'Fever'],
                                ['question' => 'Nausea, diarrhea, vomiting'],
                                ['question' => 'Cough or Sore throat'],
                                ['question' => 'New loss of taste or smell '],
                                ['question' => 'Chills'],
                                ['question' => 'Head or muscle aches '],
                            ])

                            @foreach($choices as $key => $value)
                                <div class="row ms-5">
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="choice_{{$key}}" id="{{$key}}1" value="-1">
                                            <label class="form-check-label" for="{{$key}}1">
                                                Yes
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="choice_{{$key}}" id="{{$key}}2" value="1">
                                            <label class="form-check-label" for="{{$key}}2">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-10"><h5>{{ $value['question'] }}</h5></div>
                                </div>
                            @endforeach
                        <h1 class="p-4">Based on the scale below, How are you feeling today?</h1>
                        <div class="row">
                            @foreach ($health_check_assets as $key => $item)
                            <div class="col text-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="health_check_option" id="health_check_option{{$key}}" value="{{$key}}">
                                    <label class="form-check-label" for="health_check_option{{$key}}">
                                        <h1 style="font-size: 50px">{{ $item['icon'] }}</h1>
                                        <h5>{{ $item['description'] }}</h5>
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success p-4 btn-lg w-50">Submit</button>
                    </form>
                        <button type="button" class="btn btn-outline-danger w-25 p-4 btn-lg" onclick="location.reload();">Reset</button>
                    </div>

                    </div>
                </div>
            </div>

            <script>
                    $(document).ready(function(){
                        $("#myModal").modal('show');
                    });
            </script>
            @endif

            <div class ="row">
                @if($employee->today)
                    <div class="card h1 text-center p-5 alert-primary shadow-sm m-4 mx-auto">
                        No Schedule today <i class="bi bi-calendar-event h1" style="font-size: 100px"></i>
                    </div>
                @else
                    <div class ="col">
                        @if ($attendance == null)
                        <div class='m-3 border border-primary p-2 '>
                            <h4 class="text-primary text-center">Time In</h4>
                            <div class="row m-auto text-center">
                                <div class ="col">
                                    <h6> Schedule </h6>
                                    <h6> 7:00 am </h6>
                                </div>
                                <div class ="col">
                                    <h6> Time </h6>
                                    <h6 id="clocktimein"> </h6>
                                </div>
                                <div class ="col">
                                    <h6> Date </h6>
                                    <h6 id="datein">  </h6>
                                </div>
                            </div>

                            {!! Form::open(['action'=>'App\Http\Controllers\Employee\EmployeeInsertController@TimeInInsert', 'method'=>'POST']) !!}
                                {!! Form::hidden('time_in',0,['id'=>'time_in_hidden']) !!}
                                {!! Form::hidden('time_in_date',0,['id'=>'time_in_date_hidden']) !!}
                                {!! Form::submit('Time In', ['class'=>'btn btn-primary w-100 mt-3 ']) !!}
                            {!! Form::close() !!}
                        </div>
                        @else
                            <div class="card m-3 border border-primary">
                                <h5 class="text-center w-100 alert alert-primary rounded-0 rounded-top p-2">Time In</h5>
                                <div class="row mx-2 text-center">
                                    <div class="col">
                                        <h6>Schedule:</h6>
                                        <p>{{ $attendance->schedule_Timein }}</p>
                                    </div>
                                    <div class="col">
                                        <h6>Timed in at:</h6>
                                        <p>{{ $attendance->time_in }}</p>
                                    </div>
                                    <div class="col">
                                        <h6>Date:</h6>
                                        <p>{{ $attendance->attendance_date }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class ="col">
                        @if ($attendance == null)
                        <div class=' m-3 border border-success p-2'>
                            <h4 class="text-success text-center">Time Out</h4>
                            <div class="row m-auto text-center">
                                <div class ="col">
                                    <h6> Schedule </h6>
                                    <h6> 7:00 am </h6>
                                </div>
                                <div class ="col">
                                    <h6> Time </h6>
                                    <h6 id="clocktimeout">  </h6>
                                </div>
                                <div class ="col">
                                    <h6> Date </h6>
                                    <h6 id="dateout">  </h6>
                                </div>
                            </div>
                            <button disabled class='btn btn-success w-100 mt-3 '>Time Out</button>

                        @else
                            @if ($attendance->time_out == null)
                                <div class=' m-3 border border-success p-2'>
                                    <h4 class="text-success text-center">Time Out</h4>
                                    <div class="row m-auto text-center">
                                        <div class ="col">
                                            <h6> Schedule </h6>
                                            <h6> 7:00 am </h6>
                                        </div>
                                        <div class ="col">
                                            <h6> Time </h6>
                                            <h6 id="clocktimeout">  </h6>
                                        </div>
                                        <div class ="col">
                                            <h6> Date </h6>
                                            <h6 id="dateout">  </h6>
                                        </div>
                                    </div>

                                    {!! Form::open(['action'=>'App\Http\Controllers\Employee\EmployeeInsertController@TimeOutInsert', 'method'=>'POST']) !!}
                                        {!! Form::hidden('att_id', $attendance->attendance_id) !!}
                                        {!! Form::hidden('time_out',0,['id'=>'time_out_hidden']) !!}
                                        {!! Form::submit('Time Out', ['class'=>'btn btn-success w-100 mt-3 ']) !!}
                                    {!! Form::close() !!}
                                @else
                                    <div class="card m-3 border border-success">
                                        <h5 class="text-center w-100 alert alert-success rounded-0 rounded-top p-2">Time Out</h5>
                                        <div class="row mx-2 text-center">
                                            <div class="col">
                                                <h6>Schedule:</h6>
                                                <p>{{ $attendance->schedule_Timeout }}</p>
                                            </div>
                                            <div class="col">
                                                <h6>Timed Out at:</h6>
                                                <p>{{ $attendance->time_out }}</p>
                                            </div>
                                            <div class="col">
                                                <h6>Date:</h6>
                                                <p>{{ $attendance->attendance_date }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <div class="row p-0 my-3" style="height: 730px">
                <div class="col-7 m-3 p-0 border shadow-sm h-100">
                    <h1 class="w-100 bg-primary text-white rounded-top p-3">This Week Schedule</h1>
                    <div class="container p-5">
                        <div id="calendar"></div>
                    </div>
                </div>
                <div class="col h-100" style="overflow-y: scroll">
                    @if (isset($employee->clearance))
                    <div class="border rounded m-3 shadow-sm alert-danger">
                        <h4 class="text-center bg-danger text-white rounded-top p-2 mb-3"> Offboarding Clearance List</h4>
                        <div class="card p-3 m-2 shadow-sm bg-white">
                            @foreach($employee->clearance as $key => $value)
                                @if ($value->clearance_status)
                                    <div class="h5 m-2 border-bottom alert-success p-4 rounded">
                                @else
                                    <div class="h5 m-2 border-bottom p-4 rounded">
                                @endif
                                    <div class="row">
                                        <div class="col">
                                            {{$key + 1}}. {{$value->clearance_name}}
                                        </div>
                                        <div class="col-5 text-center">
                                            @if ($value->clearance_status)
                                                <h5>Accomplished On:</h5>
                                                <h6>{{$value->date_cleared}}</h6>
                                            @else
                                                <h5>To be Accomplished</h5>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    <div class="border rounded m-3 shadow-sm p-3">
                        <h4 class="text-primary text-center pt-2 mb-3"> Attendance History</h4>

                        {{ $attendance_history->links() }}
                        @foreach ($attendance_history as $key => $item)
                        @if ($item->attendance_status == 1)
                        <div class="col m-3 border border-secondary alert-success m-auto mb-2 shadow-sm pb-2">
                        @elseif($item->attendance_status == 2)
                        <div class="col m-3 border border-secondary alert-primary m-auto mb-2 shadow-sm pb-2">
                        @else
                        <div class="col m-3 border border-secondary alert-danger m-auto mb-2 shadow-sm pb-2">
                        @endif
                            <div class ="col border-secondary bg-light text-center border-bottom">
                                <h6>{{ $item->attendance_date}} </h6>
                            </div>
                            <div class="row m-auto text-center">
                                <div class ="col">
                                    <p> Schedule Time In</p>
                                    <h6> {{ $item->schedule_Timein }} </h6>
                                </div>
                                <div class ="col">
                                    <p> Time in </p>
                                    <h6>{{ $item->time_in }}</h6>
                                </div>
                                <div class ="col">
                                    <p> Schedule Time Out</p>
                                    <h6> {{ $item->schedule_Timeout }} </h6>
                                </div>
                                <div class ="col">
                                    <p> Time out </p>
                                    <h6>{{ $item->time_out }}</h6>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        {{ $attendance_history->links() }}
                    </div>
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                var calendar_data = {!! json_encode($sched_arr, JSON_HEX_TAG) !!}
                var calendarEl = document.getElementById('calendar');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    events: calendar_data
                });

                calendar.render();
            });
            </script>

            <div class="row">
                <div class ="col m-3 border border-secondary" style='overflow-y:scroll; height:500px;'>
                    <h4 class="text-primary text-center pt-2 mb-4"> Payslips History</h4>

                    @foreach ($payslips as $item)
                    <div class="row border border-secondary m-0 p-0 rounded">
                        <div class="col-3 text-center p-0 alert-primary rounded-start p-1" style='font-size:11px;'>
                            <b>Cut Off Date:</b>
                            <br>
                            {{ $item->payroll_date }}
                        </div>
                        <div class="col text-center">
                            <h6 style='font-size:11px;' class="my-2">{{ $item->file_name }}</h6>
                        </div>
                        <div class="col-3 p-0">
                            <form action="/payroll/history/payslip"  class="w-100 h-100 m-0 p-0" target="_blank" method="GET">
                                <input type="hidden" id="path" name="path" value="/{{ $item->file_path }}">
                                <button type="submit" class="btn btn-primary w-100 h-100 m-0 rounded-0 rounded-end" style="font-size: 10px"><i class="bi bi-file-earmark"></i> Open </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class ="col m-3 border border-secondary" style='overflow-y:scroll;  height:500px;'>
                        <h4 class="text-primary text-center pt-2 mb-4"> Notification</h4>


                        @if (count($notif))
                            {{ $notif->links() }}
                            @foreach ($notif as $item)
                            <div class="card shadow border border-secondary rounded m-1">
                                <h6 class="h6 alert alert-primary rounded-0 rounded-top m-0">{{$item->message->title}}</h6>
                                <div class="w-100 shadow-sm m-0 py-2">
                                    <h6 class="m-0 mx-1 text-start text-dark px-1" style="font-size:13px">From: {{ $item->sender->fname }} {{ $item->sender->mname }} {{ $item->sender->lname }}</h6>
                                    <h6 class="m-0 mx-1 text-start text-secondary px-1" style="font-size:13px">Date sent: {{$item->message->created_at}}</h6>
                                    <hr class="my-2">
                                    <h6 class="text-decoration-none m-0 mx-1 text-dark text-secondary px-1 my-0">{!!$item->message->message!!}</h6>
                                </div>

                                {!! Form::open(['action'=>'App\Http\Controllers\PagesController@notification_acknowledgement_insert','method'=>'GET']) !!}
                                {!! Form::hidden('notif_receiver_id', $item->id) !!}
                                @if ($item->acknowledgements > 0)
                                {!! Form::submit('Acknowledgement Sent', ['disabled',"class"=>"btn btn-success rounded-0 w-100 rounded-bottom"]) !!}
                                @else
                                {!! Form::submit('Send Acknowledgement', ["class"=>"btn btn-outline-primary rounded-0 w-100 rounded-bottom"]) !!}
                                @endif
                                {!! Form::close() !!}
                            </div>
                            @endforeach
                        {{ $notif->links() }}

                        @else
                            <h6 class="display-6 text-secondary w-100 text-center"> No Notifications</h6>
                        @endif
                </div>
            </div>
        </div>
<script>

//Time Today Script
function currentTime() {
    let date = new Date();
    let hh = date.getHours();
    let mm = date.getMinutes();
    let ss = date.getSeconds();
    let session = "AM";


    if(hh > 12){
        session = "PM";
    }

    hh = (hh < 10) ? "0" + hh : hh;
    mm = (mm < 10) ? "0" + mm : mm;
    ss = (ss < 10) ? "0" + ss : ss;

    let time = hh + ":" + mm + ":" + ss;

    if(document.getElementById("clocktimein")){
        document.getElementById("clocktimein").innerText = time;
    }

    var timeout = document.querySelectorAll('*[id^="clocktimeout"]');
    timeout.forEach(element => {
        element.innerHTML = time
    });


    if(document.getElementById("time_in_hidden")){
        document.getElementById("time_in_hidden").value = time;
    }

    if(document.getElementById("time_out_hidden")){
        document.getElementById("time_out_hidden").value = time;
    }


    let t = setTimeout(function(){ currentTime() }, 1000);
}
currentTime();


//Date Today Scrpit
const datetoday = new Date().toDateString();;

const formatDate = (date) => {
    let d = new Date(date);
    let month = (d.getMonth() + 1).toString();
    let day = d.getDate().toString();
    let year = d.getFullYear();

    if (month.length < 2) {
        month = '0' + month;
        }
    if (day.length < 2) {
        day = '0' + day;
        }
    return [year, month, day].join('-');
}

if(document.getElementById('time_in_date_hidden')){
    document.getElementById('time_in_date_hidden').value = formatDate(datetoday)
}
if(document.getElementById('time_out_date_hidden')){
    document.getElementById('time_out_date_hidden').value = formatDate(datetoday)
}

if(document.getElementById("datein")){
    document.getElementById("datein").innerHTML = formatDate(datetoday);
}

document.getElementById("dateout").innerHTML = formatDate(datetoday);
</script>


@endsection
