@extends('layout.payroll_app')
    @section('content')
    <div class="row mt-4">
        <div class="col-1" style="width:6vw"></div>
        <div class="col">
            <div class="container w-100 p-2">
            <h1 class="display-2 pb-5">Messages </h1>

                <div class ="row">
                    <div class="col-3 border rounded me-4">
                        <div class=" w-75 d-flex m-auto pt-3">
                            <input type="text" class="rounded-left w-100" placeholder="Search">
                            <button class="btn btn-primary rounded-0 rounded-end"><i class="bi bi-search"></i></button>
                        </div>
                        <h1 class="pb-5 text-secondary m-auto pt-3 text-center">Employee List </h1>
                    </div>

                    <div class="col rounded me-4" style="padding:0px;">
                        <div class="row border rounded" style="padding:0px; padding-bottom:300px;">
                        <div class='col border rounded d-flex align-items-center' style="width:100%;">
                            <img style='height:50px; width:50px;' class='shadow rounded-circle m-3'>
                            <h4>Employee Name</h4>
                        </div>


                        </div>
                        <div class="row">
                            {!! Form::open() !!}
                            <div>
                                {{Form::label('', '', '')}}
                                {{Form::textarea('body','',['style'=>'height:5px','id'=>'article-ckeditor','class'=>'form-control',
                                    'placeholder'=>'Body Text'])}}
                            </div>
                            {!! Form::submit('send', ['class'=>'btn btn-primary w-25 mt-3 ']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>

                </div>
        </div>
    </div>

    <script src="//cdn.ckeditor.com/4.4.7/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>
@endsection
