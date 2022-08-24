@extends('layout.admin_app')
    @section('content')
    <h1 class="section-title mt-2 pb-1">Admin Dashboard</h1>
    <div class="row py-2">
        <div class="col">
            <div class="row w-100 m-0 p-0">
                @if (!count($videos))
                <div class="col text-center alert-success border border-success p-0 rounded-start">
                    <h4 class="w-100 bg-success text-white m-0 p-2">Orientation Module</h4>
                    <div class="row py-4">
                        <div class="col-1"></div>
                        <div class="col p-0 my-3">
                            <small class="text-secondary" style="font-size: 10px;">TOTAL VIDEOS</small><h1 style="font-size: 30px;" class="text-secondary">00</h1>
                        </div>
                        <div class="col p-0">
                            <h6 style="font-size: 10px;">Number of Enrolled</h6><h1 style="font-size: 50px;">00</h1>
                        </div>
                        <div class="col-1"></div>
                    </div>
                    <a href="/admin/orientation/module" class="btn btn-lg p-3 m-0 btn-outline-success w-100 rounded-0"> <i class="bi bi-journal-bookmark me-2"></i>Edit Orientation Module</a>
                </div>
                <div class="col text-center alert-primary border border-primary p-0 rounded-start">
                    <h4 class="w-100 bg-primary text-white m-0 p-2">Training Module</h4>
                    <div class="row py-4">
                        <div class="col-1"></div>
                        <div class="col p-0 my-3">
                            <small class="text-secondary" style="font-size: 10px;">TOTAL VIDEOS</small><h1 style="font-size: 30px;" class="text-secondary">00</h1>
                        </div>
                        <div class="col p-0">
                            <h6 style="font-size: 10px;">Number of Enrolled</h6><h1 style="font-size: 50px;">00</h1>
                        </div>
                        <div class="col-1"></div>
                    </div>
                    <a href="/admin/training/module" class="btn btn-lg p-3 m-0 btn-outline-primary w-100 rounded-0"> <i class="bi bi-journal-bookmark me-2"></i>Edit Training Module</a>
                </div>
                <div class="col text-center alert-danger border border-danger p-0 rounded-start">
                    <h4 class="w-100 bg-danger text-white m-0 p-2">Correction Module</h4>
                    <div class="row py-4">
                        <div class="col-1"></div>
                        <div class="col p-0 my-3">
                            <small class="text-secondary" style="font-size: 10px;">TOTAL VIDEOS</small><h1 style="font-size: 30px;" class="text-secondary">00</h1>
                        </div>
                        <div class="col p-0">
                            <h6 style="font-size: 10px;">Number of Enrolled</h6><h1 style="font-size: 50px;">00</h1>
                        </div>
                        <div class="col-1"></div>
                    </div>
                    <a href="/admin/correction/module" class="btn btn-lg p-3 m-0 btn-outline-danger w-100 rounded-0"> <i class="bi bi-journal-bookmark me-2"></i>Edit Correction Module</a>
                </div>
                @endif
                @foreach ($videos as $key => $video)
                @switch($video->category)
                    @case("orientation")
                        @php ($color = 'success')
                        @break

                    @case("training")
                        @php ($color = 'primary')
                        @break

                    @case("correction")
                        @php ($color = 'danger')
                        @break
                    @default

                @endswitch
                <div class="col text-center alert-{{$color}} border border-{{$color}} p-0 rounded-start">
                    <h4 class="w-100 bg-{{$color}} text-white m-0 p-2">{{ ucfirst($video->category) }} Module</h4>
                    <div class="row py-4">
                        <div class="col-1"></div>
                        <div class="col p-0 my-3">
                            <small class="text-secondary" style="font-size: 10px;">TOTAL VIDEOS</small><h1 style="font-size: 30px;" class="text-secondary">{{ str_pad(count($video->videos),2, "0", STR_PAD_LEFT) }}</h1>
                        </div>
                        <div class="col p-0">
                            <h6 style="font-size: 10px;">Number of Enrolled</h6><h1 style="font-size: 50px;">{{  str_pad(floor(count($video->learners) / count($video->videos)),2, "0", STR_PAD_LEFT) }}</h1>
                        </div>
                        <div class="col-1"></div>
                    </div>
                    <a href="/admin/{{ $video->category }}/module" class="btn btn-lg p-3 m-0 btn-outline-{{$color}} w-100 rounded-0"> <i class="bi bi-journal-bookmark me-2"></i>Edit {{ ucfirst($video->category) }}  Module</a>
                </div>
                @endforeach
            </div>

            {{-- TIME IN OVERVIEW --}}
            <div class="row border border-dark rounded shadow-lg p-2 mt-3" style="max-height: 400px; overflow-y:scroll">
                <div class="row pb-0">
                    <div class="col-3 pb-0">
                        <h4 class="text-primary">Time in Overview</h4>
                    </div>
                    <div class="col text-center pb-0">
                        <div class="border border-primary rounded w-50 m-auto p-1 shadow-sm alert-primary">
                            <h6 class="text-primary m-0 p-0" style="font-family:Helvetica; font-weight:1000">{{ count($attendance_today) }} / {{ $employee_scheduled_count }} </h6>
                            <p class="m-0 p-0" style="font-size:10px">Employees Timed in Today</p>
                        </div>
                    </div>
                    <div class="col-3 pb-0">
                        <p class="border border-secondary w-100 text-center p-2 shadow-sm rounded ">{{ date('l, Y-m-d') }}</p>
                    </div>
                </div>
                <table class="table text-center" style="height: 300px">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Employee Name</th>
                            <th scope="col">Department</th>
                            <th scope="col">Position</th>
                            <th scope="col">Scheduled Time in</th>
                            <th scope="col">Time in</th>
                            <th scope="col">Health Check</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attendance_today as $item)
                        <tr>
                            <td>
                                <img src="/{{$item->picture}}" class="rounded-circle shadow-sm" width="50px" height="50px">
                            </td>
                            <td>{{ $item->fname }} {{ $item->mname }} {{ $item->lname }}</td>
                            <td>{{ $item->department }}</td>
                            <td>{{ $item->position }}</td>
                            <td>{{ $item->schedule_Timein }}</td>
                            <td>{{ $item->time_in }}</td>
                            @switch($item->healthCheck->score)
                                @case(0)
                                <td><h4 class="m-0 p-0">🤢</h4>Sick</td>
                                    @break

                                @case(1)
                                <td><h4 class="m-0 p-0">😷</h4>Bad</td>
                                    @break

                                @case(2)
                                <td><h4 class="m-0 p-0">😕</h4>Unpleasant</td>
                                    @break

                                @case(3)
                                <td><h4 class="m-0 p-0">😐</h4>Neutral</td>
                                    @break

                                @case(4)
                                <td><h4 class="m-0 p-0">🙂</h4>Good</td>
                                    @break

                                @case(5)
                                <td><h4 class="m-0 p-0">😀</h4>Better</td>
                                    @break

                                @case(6)
                                <td><h4 class="m-0 p-0">😁</h4>Best</td>
                                    @break

                                @default

                            @endswitch


                            @if($item->time_in_status != 'Late')
                                <td>
                                    <h6 class="alert alert-success">{{ $item->time_in_status }}</h6>
                                </td>
                            @else
                                <td>
                                    <h6 class="alert alert-danger">{{ $item->time_in_status }}</h6>
                                </td>
                            @endif

                        </tr>
                        @endforeach
                    </body>
                </table>
            </div>
        </div>
        <div class="col-3">
            <div class="card mx-2" style="height:551px;overflow-y:scroll;overflow-x:hidden;">
                <h3 class="w-100 m-0 rounded-top alert-warning text-center p-2">Regularization Overview</h3>
                @foreach ($onboardees as $data)
                    <a href="./regularization/{{$data->userdetail->fname}} {{$data->userdetail->mname}} {{$data->userdetail->lname}}" class="card shadow-sm m-2 mb-3 text-decoration-none rounded text-wrap">
                        <div class="row text-wrap w-100 p-0 m-0">
                            <div class="col-5 p-0">
                                <img src="/{{$data->userdetail->picture}}" class="p-0 m-0 w-100 h-100 rounded">
                            </div>
                            <div class="col p-0">
                                <h5 class="w-100 bg-primary text-light text-center py-2 rounded-top">{{$data->userdetail->fname}} {{$data->userdetail->mname}} {{$data->userdetail->lname}}</h5>
                                <div class="row py-1 ps-3">
                                    <p><b>Position: </b>{{ $data->position }}</p>
                                    <p><b>Department: </b>{{ $data->department}}</p>
                                    <p><b>Onboarded on: </b>{{ $data->start_date }}</p>
                                </div>
                                <h6 class="w-100 alert-primary m-0 p-2 text-center rounded-bottom">{{ $data->duration->y }} Years {{ $data->duration->m }} Months {{ $data->duration->d }} Days</h6>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
