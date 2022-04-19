@extends('layout.employee_app')
    @section('content')
    <div class="row mt-4">
        <div class="col-1" style="width:6vw"></div>
        <div class="col">
            <div class="container w-100 p-2">
                <h1 class="section-title mt-2 pb-1">Employee Dashboard</h1>

                <div class ="row">
                    <div class ="col ">
                        <div class='m-3 border border-primary p-2 '>
                            <h4 class="text-primary text-center">Time In</h4>
                            <div class="row m-auto text-center">
                                <div class ="col">
                                    <h6> Schedule </h6>
                                </div>
                                <div class ="col">
                                    <h6> Time </h6>
                                </div>
                                <div class ="col">
                                    <h6> Date </h6>
                                </div>
                            </div>
                            <div class="row m-auto text-center">
                                <div class ="col">
                                    <h6> 7:00 am </h6>
                                </div>
                                <div class ="col">
                                    <h6 id="clocktimein"> </h6>
                                </div>
                                <div class ="col">
                                    <h6 id="datein">  </h6>
                                </div>
                            </div>
                            {!! Form::open() !!}
                            {!! Form::submit('Time In', ['class'=>'btn btn-primary w-100 mt-3 ']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div class ="col">
                        <div class=' m-3 border border-success p-2'>
                            <h4 class="text-success text-center">Time Out</h4>
                            <div class="row m-auto text-center">
                                <div class ="col">
                                    <h6> Schedule </h6>
                                </div>
                                <div class ="col">
                                    <h6> Time </h6>
                                </div>
                                <div class ="col">
                                    <h6> Date </h6>
                                </div>
                            </div>
                            <div class="row m-auto text-center">
                                <div class ="col">
                                    <h6> 7:00 am </h6>
                                </div>
                                <div class ="col">
                                    <h6 id="clocktimeout">  </h6>
                                </div>
                                <div class ="col">
                                    <h6 id="dateout">  </h6>
                                </div>
                                {!! Form::open() !!}
                                {!! Form::submit('Time Out', ['class'=>'btn btn-success w-100 mt-3 ']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class ="col m-3 border border-secondary" style='overflow-y:scroll;'>
                            <h4 class="text-primary text-center pt-2"> Attendance History</h4>
                        <div class="col m-3 border border-secondary m-auto pb-2">
                            <div class ="col border-secondary bg-light text-center border-bottom">
                                <h6>Mon, 3/14/2022</h6>
                            </div>
                            <div class="row m-auto text-center">
                                <div class ="col">
                                    <p> Schedule </p>
                                </div>
                                <div class ="col">
                                    <p> Time in </p>
                                </div>
                                <div class ="col">
                                    <p> Date </p>
                                </div>
                                <div class ="col">
                                    <p> Time out </p>
                                </div>
                            </div>
                            <div class="row m-auto text-center">
                                <div class ="col">
                                    <h6> 7:00am </h6>
                                </div>
                                <div class ="col">
                                    <h6 id="clocktimeout">  </h6>
                                </div>
                                <div class ="col">
                                    <h6 id="dateout">  </h6>
                                </div>
                                <div class ="col">
                                    <h6 id="dateout"> 5:30pm  </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class ="col m-3 border border-secondary" style='overflow-y:scroll;'>
                            <h4 class="text-primary text-center pt-2"> Payslips History</h4>
                            <div class="col border border-secondary">
                                <div class="row">
                                <div class="col">
                                    <p class="text-center pt-2" style='font-size:11px;'>Payslip 03/14/2022 - 03/30/2022</p>
                                </div>
                                <div class="col-4 pt-1">
                                    {!! Form::open() !!}
                                    {!! Form::submit('Download', ['class'=>'btn btn-primary btn-sm ']) !!}
                                    {!! Form::close() !!}
                                </div>
                                </div>
                            </div>
                    </div>

                    <div class ="col m-3 border border-secondary" style='overflow-y:scroll;'>
                            <h4 class="text-primary text-center pt-2"> Notification</h4>
                            <div class="col border border-secondary p-3">
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

                    document.getElementById("clocktimein").innerText = time;
                    document.getElementById("clocktimeout").innerText = time;
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
                    document.getElementById("datein").innerHTML = formatDate(datetoday);
                    document.getElementById("dateout").innerHTML = formatDate(datetoday);
                </script>


@endsection
