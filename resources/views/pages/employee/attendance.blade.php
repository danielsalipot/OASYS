@extends('layout.employee_app')
    @section('content')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css">
        <div class="container w-100 p-2">
            <div class="row p-0 ">
                <div class="col-7 m-3 p-0 border shadow-sm">
                    <h1 class="w-100 bg-primary text-white rounded-top p-3">This Week Schedule</h1>
                    <div class="container p-5">
                        <div id="calendar"></div>
                    </div>
                </div>
                <div class="col m-3 border rounded shadow-sm">
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
        </div>
    @endsection
