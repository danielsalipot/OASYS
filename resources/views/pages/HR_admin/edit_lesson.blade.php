@extends('layout.admin_app')
    @section('content')
        <h1 class="section-title mt-3 pb-2">{{ ucfirst($category) }} Module</h1>

        <div class="card m-2 shadow-lg alert alert-success p-0">
            <h5 class="w-100 alert alert-light text-success m-0 rounded-0 rounded-top"> Edit Lesson</h5>
            <div class="row w-100 p-0">
                <div class="col" id="video_display" >
                    <video class="w-100 h-100 p-0 m-0" controls>
                        <source src="/{{$video->path}}" type="video/mp4">
                    </video>
                </div>
                <div class="col p-2">
                    <form id="fileUploadForm" method="POST" action="{{ url('/editLesson') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-2">
                        <label for="video" class="form-label h6 pt-3">Upload Video</label>
                        <input class="form-control form-control-lg m-0" name="video_file" type="file" id="video" onchange="displayVideo(event)" multiple>
                        <div class="form-group p-0 m-0">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                            </div>
                        </div>

                        {!! Form::hidden('category', 'orientation') !!}

                        {!! Form::hidden('id', $video->id) !!}

                        <div class="row mt-3">
                            <div class="col-1">
                                {!! Form::label('order','Order', ['class'=>'form-label h6 pt-2']) !!}
                            </div>
                            <div class="col-4">
                                {!! Form::number('order',$video->order, ['class'=>'form-control','min'=>'1','placeholder'=>'Lesson Title']) !!}
                            </div>
                            <div class="col"></div>
                        </div>


                        {!! Form::label('title','Lesson Title', ['class'=>'form-label h6 pt-3']) !!}
                        {!! Form::text('title',$video->title, ['class'=>'form-control','placeholder'=>'Lesson Title']) !!}

                        {!! Form::label('description','Lesson Description', ['class'=>'form-label h6 pt-3']) !!}
                        {!! Form::textarea('description',$video->description, ['class'=>'form-control','placeholder'=>'Lesson Description','rows'=>'6']) !!}
                    </div>

                    <div class="row">
                        <div class="col-9">
                            {!! Form::submit('Save Changes', ['class'=>'btn p-3 w-25 btn-success']) !!}
                        </div>
                        <div class="col">
                            <a href='/admin/{{$category}}/module' class="w-100 btn p-3 btn-danger">Cancel</a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection

    @section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
        <script>
            function displayVideo(input){
                $('#video_display').html('')

                $('#video_display').html(`
                    <video class="w-100 h-100 p-0 m-0" controls>
                        <source src="${ URL.createObjectURL(input.target.files[0]) }" type="video/mp4">
                    </video>`)
            }

            $(function () {
                $(document).ready(function () {
                    $('#fileUploadForm').ajaxForm({
                        beforeSend: function () {
                            var percentage = '0';
                        },
                        uploadProgress: function (event, position, total, percentComplete) {
                            var percentage = percentComplete;
                            $('.progress .progress-bar').css("width", percentage+'%', function() {
                                return $(this).attr("aria-valuenow", percentage) + "%";
                            })
                        },
                        success: function(data){
                            if(data == 'edit success'){
                                alert(data)
                                window.location.href = "/admin/{{$category}}/module";
                            }
                        }
                    });
                });
            });
        </script>

@if ($category == 'orientation')
<style>
    body{
        background-color: rgb(213, 255, 150);
    }
</style>
@endif
@if ($category == 'training')
<style>
    body{
        background-color: rgb(150, 243, 255);
    }
</style>
@endif
@if ($category == 'correction')
<style>
    body{
        background-color: rgb(255, 155, 150);
    }
</style>
@endif
    @endsection
