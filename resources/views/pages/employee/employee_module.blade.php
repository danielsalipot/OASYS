@extends('layout.employee_app')
@section('content')
    <div class="row">
        <div class="col">
            <h1 class="section-title mt-2 pb-1">{{ucfirst($category)}} Module</h1>
        </div>
        <div class="col">
            <div class="card shadow-sm p-2">
                <div class="row mb-4">
                    <div class="col">
                        <div class="card">
                            <h4 class="alert-primary rounded-0 rounded-top p-2">Start Date</h4>
                            <h4 class="text-center w-100">{{ $learner[0]->learner->start_date }}</h4>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <h4 class="alert-danger rounded-0 rounded-top p-2">End Date</h4>
                            <h4 class="text-center w-100">{{ $learner[0]->learner->end_date }}</h4>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="row p-0 w-100 m-0">
                        <div class="col p-0 m-0">
                            <h4 class="alert-success rounded-0 rounded-top-start p-2">{{ucfirst($category)}} Progress</h4>
                            <div class="progress p-0 m-3">
                                <div class="progress-bar" role="progressbar" style="width: {{($progress / count($learner)) * 100}}%;" aria-valuenow="{{($progress / count($learner)) * 100}}" aria-valuemin="0" aria-valuemax="100">{{($progress / count($learner)) * 100}}%</div>
                            </div>
                        </div>
                        <div class="col-1 alert-success p-0 m-0">
                            <h4 class="rounded-end w-100 text-center pt-4 mt-2">{{ $progress }}/{{ count($learner) }}</h4>
                        </div>
                    </div>
                </div>

                @if (isset($learner[0]->learner->completion_date))
                    <div class="card p-0 shadow-sm">
                        <h4 class="bg-success text-white rounded-0 m-0 rounded-top p-2">Completion Date</h4>
                        <h4 class="alert-success text-center w-100 py-3 m-0">{{ $learner[0]->learner->completion_date }}</h4>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @foreach ($learner as $key => $data)
        @if ($key == 0)
            {{-- green pag progress == 1 blue pag hidni --}}
            @if ($data->learner->progress)
                <div class="card shadow-sm alert-success border my-5">
            @else
                <div class="card shadow-sm alert-primary my-5">
            @endif
        @else
            @if ($learner[$key - 1]->learner->progress && !$data->learner->progress)
                <div class="card shadow-sm alert-primary my-5">
            @elseif ($learner[$key - 1]->learner->progress && $data->learner->progress)
                <div class="card shadow-sm alert-success my-5">
            @else
                <div class="card shadow-sm alert-danger my-5">
            @endif
        @endif

            <div class="row">
                <div class="col">
                    @if ($key == 0)
                        <video id="video{{$data->order}}" onloadedmetadata="video_load(this,'video{{$data->order}}',{{$key}})" onended="video_ended('video{{$data->order}}')"  ontimeupdate="progress_tracker('video{{$data->order}}')" controls class="w-100 h-100 p-0 m-0">
                            <source src="/{{$data->path}}" type="video/mp4">
                        </video>
                    @elseif ($learner[$key - 1]->learner->progress)
                        <video id="video{{$data->order}}" onloadedmetadata="video_load(this,'video{{$data->order}}',{{$key}})" onended="video_ended('video{{$data->order}}')"  ontimeupdate="progress_tracker('video{{$data->order}}')" controls class="w-100 h-100 p-0 m-0">
                            <source src="/{{$data->path}}" type="video/mp4">
                        </video>
                    @else
                        <video id="video{{$data->order}}" onloadedmetadata="video_load(this,'video{{$data->order}}',{{$key}})" onended="video_ended('video{{$data->order}}')"  ontimeupdate="progress_tracker('video{{$data->order}}')" class="w-100 h-100 p-0 m-0">
                            <source src="/{{$data->path}}" type="video/mp4">
                        </video>
                    @endif

                </div>
                <div class="col">
                    <div class="card shadow-sm p-3 m-3" >
                        <div class="row w-100 m-0">
                            <div class="col-1 p-0"><h1 class="display-4 rounded-start border text-center w-100 m-0 bg-primary text-white">{{$data->order}}</h1></div>
                            <div class="col p-0"><h1 class="display-6 h-100 rounded-end border m-0">{{$data->title}}</h1></div>
                        </div>
                        <textarea class="form-control rounded-0 rounded-bottom" rows="10" readonly>{{$data->description}}</textarea>

                        <div class="card mt-4 shadow-lg p-2 bg-dark">
                            <div class="progress p-0 m-1">
                                <div class="progress-bar bg-danger m-0" role="progressbar" id='progress_video{{$data->order}}' style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                            </div>
                            <div class="row px-3">
                                <div class="col-7 p-0">
                                    @if ($key == 0)
                                        <button class="btn btn-lg btn-outline-light w-75" onclick="playVideo(this,'video{{$data->order}}')"><i class="bi bi-play h1"></i><br>Play</button>
                                    @elseif ($learner[$key - 1]->learner->progress)
                                        <button class="btn btn-lg btn-outline-light w-75" onclick="playVideo(this,'video{{$data->order}}')"><i class="bi bi-play h1"></i><br>Play</button>
                                    @else
                                        <button class="btn btn-lg btn-outline-danger w-75" onclick="playVideo(this,'video{{$data->order}}')" disabled><i class="bi bi-play h1"></i><br>Finish Previous Video</button>
                                    @endif
                                </div>

                                <div class="col p-0">
                                    @if ($key + 1 == count($learner))
                                        @if ($data->learner->progress)
                                            <button class="btn btn-lg btn-success w-100 h-100" disabled>Completed</button>
                                        @else
                                            <form action="/updateCompleteModule" method="POST">
                                                @csrf
                                                @php ($ids = '')

                                                @foreach ($learner as $item)
                                                    @php ($ids .= $item->id .';')
                                                @endforeach

                                                {!! Form::hidden('learner_ids', $ids)!!}
                                                <button id="complete_video{{$data->order}}" class="btn btn-lg btn-outline-primary w-100 h-100" disabled><h4 id="countdown_video{{$data->order}}">00:00</h4>Complete Module</button>
                                            </form>
                                        @endif
                                    @else
                                        @if ($data->learner->progress)
                                            <button class="btn btn-lg btn-success w-100 h-100" disabled>Completed</button>
                                        @else
                                            <form action="/updateModule" method="POST">
                                                @csrf
                                                {!! Form::hidden('learner_id', $data->learner->id) !!}
                                                <button id="complete_video{{$data->order}}" class="btn btn-lg btn-outline-primary w-100 h-100" disabled><h4 id="countdown_video{{$data->order}}">00:00</h4>Mark Complete</button>
                                            </form>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection

@section('script')
    <script>
        function video_load(video,id,key){
            var complete = document.getElementById(`complete_${id}`)
            if(key+1 == {{count($learner)}}){
                complete.innerHTML = `<h4 id="countdown_${id}">${convertHMS(video.duration)}</h4>Complete Module`
            }
            else{
                complete.innerHTML = `<h4 id="countdown_${id}">${convertHMS(video.duration)}</h4>Mark as Complete`
            }

        }

        function playVideo(btn,id){
            var video = document.getElementById(id)
            var progress = document.getElementById(`progress_${id}`)
            var time = document.getElementById(`time_${id}`)

            if(!video.paused && !video.ended) {
                video.pause();
                btn.innerHTML = '<i class="bi bi-play h1"></i><br>Play'
            }
            else{
                btn.innerHTML = '<i class="bi bi-pause h1"></i><br>Pause'
                video.play()
            }
        }

        function video_ended(id){
            var complete = document.getElementById(`complete_${id}`)
            complete.innerHTML = `<i class="bi bi-check h1"></i><br>Mark as Complete`
            complete.classList.toggle('btn-outline-primary');
            complete.classList.toggle('btn-primary');
            complete.disabled = false
        }

        function progress_tracker(id){
            var video = document.getElementById(id)
            var progress = document.getElementById(`progress_${id}`)
            var countdown_text = document.getElementById(`countdown_${id}`)

            var progress_time = (video.currentTime / video.duration) * 100

            if(countdown_text != null){
                countdown_text.innerHTML = `${convertHMS(video.duration - video.currentTime)}`
            }

            progress.style.width = `${progress_time}%`
            progress.innerHTML = `${progress_time.toFixed(2)}%`

        }

        function convertHMS(value) {
            const sec = parseInt(value, 10); // convert value to number if it's string
            let hours   = Math.floor(sec / 3600); // get hours
            let minutes = Math.floor((sec - (hours * 3600)) / 60); // get minutes
            let seconds = sec - (hours * 3600) - (minutes * 60); //  get seconds
            // add 0 if value < 10; Example: 2 => 02
            if (hours   < 10) {hours   = "0"+hours;}
            if (minutes < 10) {minutes = "0"+minutes;}
            if (seconds < 10) {seconds = "0"+seconds;}
            if(hours != "00"){
                return `${hours}:${minutes}:${seconds}` // Return is HH : MM : SS
            }else{
                return `${minutes}:${seconds}` // Return is HH : MM : SS
            }

        }
    </script>
@endsection
