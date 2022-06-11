@extends('layout.employee_app')
    @section('content')
    <div class="row mt-4">
        <div class="col-1" style="width:6vw"></div>
        <div class="col">
            <div class="container w-100 p-2">
                <h1 class="section-title mt-2 pb-1">Employee Dashboard</h1>

                <div class ="row">
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
                </div>

                <div class="row">
                    <div class ="col m-3 border border-secondary" style='height:600px;overflow-y:scroll;'>
                        <h4 class="text-primary text-center pt-2 mb-3"> Attendance History</h4>

                        {{ $attendance_history->links() }}
                        @foreach ($attendance_history as $key => $item)
                        <div class="col m-3 border border-secondary m-auto mb-2 shadow-sm pb-2">
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

                    <div class ="col m-3 border border-secondary" style='overflow-y:scroll;'>
                        <h4 class="text-primary text-center pt-2"> Payslips History</h4>

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

                    <div class ="col m-3 border border-secondary" style='overflow-y:scroll;'>
                            <h4 class="text-primary text-center pt-2"> Notification</h4>


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
