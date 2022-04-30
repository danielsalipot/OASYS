@extends('layout.messaging')

@section('title')
    <h1 class="section-title mt-5 pb-2">Notification</h1>
@endsection

@section('content')
<div class="row">
    <div class ="col-4">
        <div class=" border rounded me-4">
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
        <div class="row w-100 d-flex text-center">
            {!! Form::open() !!}

            {!! Form::submit('View History', ['class'=>'btn btn-primary w-25 mt-3 p-3']) !!}
            {!! Form::close() !!}

        </div>
    </div>
    <div class="col">
        <div class="row">
            {!! Form::open() !!}
                {!! Form::label('title', 'Notification Title', ['class'=>'h2 text-secondary']) !!}
                {!! Form::text('title', '', ['class'=>'form-control']) !!}

                {{Form::label('body','Notification Message',['class'=>'h2 text-secondary pt-4'])}}
                {{Form::textarea('body','',['id'=>'article-ckeditor','class'=>'form-control',
                    'placeholder'=>'Notification Message'])}}
                <div class='row'>
                <div class='col'>
                {!! Form::submit('Send Notification', ['class'=>'btn btn-primary w-50 mt-3 p-3']) !!}
                </div>
                <div class="col-4">
                {!! Form::submit('Cancel', ['class'=>'btn btn-danger w-100 mt-3 p-3']) !!}
                </div>
                </div>
            {!! Form::close() !!}
    </div>
</div>
@endsection
@section('script')
<script src="//cdn.ckeditor.com/4.4.7/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'article-ckeditor' );
</script>
@endsection
