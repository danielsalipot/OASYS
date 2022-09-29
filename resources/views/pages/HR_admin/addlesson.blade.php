@extends('layout.admin_app')
    @section('content')
        <h1 class="section-title mt-3 pb-2">{{ ucfirst($category) }} Module</h1>

        <div class="card m-2 shadow-lg alert alert-primary p-0">
            <h5 class="w-100 alert alert-light text-primary m-0 rounded-0 rounded-top"> Add new Lesson</h5>
            <div class="row w-100">
                <div class="col" id="video_display" >
                    <video class="w-100 h-100 p-0 m-0" controls></video>
                </div>
                <div class="col p-2">

                    <form id="fileUploadForm" method="POST" action="{{ url('/insertLesson') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-2">
                        <label for="video" class="form-label h6 pt-3">Upload Video</label>
                        <div class="form-group">
                        <input class="form-control form-control-lg h-100 " name="video_file" type="file" id="video" class=" " onchange="displayVideo(event)" multiple>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                            </div>
                        </div>

                        {!! Form::hidden('category', $category) !!}

                        {!! Form::label('title','Lesson Title', ['class'=>'form-label h6 pt-3']) !!}
                        {!! Form::text('title','', ['class'=>'form-control form-control-lg','placeholder'=>'Lesson Title']) !!}

                        {!! Form::label('description','Lesson Description', ['class'=>'form-label h6 pt-3']) !!}
                        {!! Form::textarea('description','', ['class'=>'form-control form-control-lg','placeholder'=>'Lesson Description','rows'=>'6']) !!}
                    </div>

                    <div class="row">
                        <div class="col">
                            {!! Form::submit('Submit', ['class'=>'btn btn-lg btn-success w-50']) !!}
                        </div>
                        <div class="col-4">
                            <a  class='btn btn-lg btn-danger w-100'href="./module">Cancel</a>
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
                            if(data == 'upload success'){
                                alert(data)
                                window.location.href = "/admin/{{$category}}/module";
                            }else{
                                console.log(data)
                                alert('Some Fields Are Missing')
                            }
                        }
                    });
                });
            });
        </script>

@if ($category == 'orientation')
<style>
    body{
        background-color: rgb(244, 255, 230);
    }
</style>
@endif
@if ($category == 'training')
<style>
    body{
        background-color: rgb(224, 251, 255);
    }
</style>
@endif
@if ($category == 'correction')
<style>
    body{
        background-color: rgb(255, 230, 228);
    }
</style>
@endif
    @endsection
