@extends('layout.admin_app')
    @section('content')
    <div class="row">
        <div class="col-1" style="width:6vw"></div>
        <div class="col">
            <h1 class="section-title mt-5 pb-2">Performance Assessment</h1>

                <div class="row">
                    <div class ="col-5">
                        <div class=" border rounded me-2">
                            <h1 class="h2 w-100 text-center text-secondary p-3 font-weight-bold">Search Employee</h1>
                            <div class="d-flex w-50 m-auto">
                                <input type="text" class="rounded-left w-100" placeholder="Search">
                                <button class="btn btn-primary rounded-0 rounded-end"><i class="bi bi-search"></i></button>
                            </div>
                            <div class="row p-5 d-flex align-items-center">
                                <div class="col">
                                    <img src="pictures/1.png" style="height: 150px; width:150px">
                                </div>
                            <div class="col">
                                <h2 class="display-5">Name</h2>
                                <h5>Employee ID</h5>
                                <h5>Employee Position</h5>
                                <h5>Employment Status</h5>
                            </div>
                            </div>
                        </div>

                    </div>

                    <div class="col ">
                        <div class="row">
                            <h2>Attendance</h2>
                            <h5>Score <input type="text" class="rounded-left w-60" placeholder="Score"></h5>
                        </div>
                        <div class="row">
                            <h3>Feedback</h3>
                            {!! Form::open() !!}
                            {{Form::textarea('body','',['id'=>'article-ckeditor','class'=>'form-control h-25 w-75',
                                'placeholder'=>'Comments and Suggestion'])}}
                                <h2 class="pt-2">Performance</h2>
                                <h5>Score <input type="text" class="rounded-left w-60" placeholder="Score"></h5>
                                <h3>Feedback</h3>
                                {{Form::textarea('body','',['id'=>'article-ckeditor','class'=>'form-control h-25 w-75',
                                'placeholder'=>'Comments and Suggestion'])}}
                                <br>
                                {!! Form::submit('Submit Assessment', ['class'=>'btn btn-primary w-50 ']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>

                    <div class="col">
                        <div class="row">
                            <h2>Character</h2>
                            <h5>Score <input type="text" class="rounded-left w-60" placeholder="Score"></h5>
                        </div>
                        <div class="row">
                            <h3>Feedback</h3>
                            {!! Form::open() !!}
                            {{Form::textarea('body','',['id'=>'article-ckeditor','class'=>'form-control h-25 w-75',
                                'placeholder'=>'Comments and Suggestion'])}}
                                <h2 class="pt-2">Performance</h2>
                                <h5>Score <input type="text" class="rounded-left w-60" placeholder="Score"></h5>
                                <h3>Feedback</h3>
                                {{Form::textarea('body','',['id'=>'article-ckeditor','class'=>'form-control h-25 w-75',
                                'placeholder'=>'Comments and Suggestion'])}}
                                <br>
                                {!! Form::submit('Cancel', ['class'=>'btn btn-danger w-50']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
@endsection
