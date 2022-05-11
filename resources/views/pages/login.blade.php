@extends('layout.app')
    @section('content')
    <style>
        body {
            background-image: url("https://pbs.twimg.com/media/E_zSrQbVgAgPidB.jpg");
            background-position: center;
            background-repeat: no-repeat;
            background-size:cover;
        }
    </style>

    <div class="row p-5 w-100"></div>
        <div class="text-center text-primary">
            @if(Session::get('fail'))
                <div class="alert alert-danger w-50 m-auto">{{Session::get('fail')}}</div>
            @endif
            <div class="card w-25 p-5 m-auto rounded shadow-lg">
                <h1 class="h3">Login</h1>
                <div class='container'>
                {!! Form::open(['action'=> 'App\Http\Controllers\LoginController@crudlogin','method'=>'POST']) !!}
                    {!! Form::text('user', '', ['class' => 'm-auto form-control w-100 mt-3 p-2','placeholder' => 'username']) !!}
                    <span class="text-danger">@error('user'){{"This Field is required"}}@enderror</span>

                    {!! Form::password('pass', ['class' =>'m-auto form-control w-100 mt-3 p-2','placeholder' =>'password']) !!}
                    <span class="text-danger">@error('pass'){{"This Field is required"}}@enderror</span>

                    <div class="row p-2"></div>
                    <input type="checkbox" name="remem" class="form-check-input" id="remem">
                    <label class="form-check-label text-secondary" for="remem">Remember me</label>

                    <br>{!! Form::submit('Login', ['class' => 'btn btn-primary w-100 mt-3']) !!}
                    <br><a href="/" class="btn btn-outline-primary w-75 mt-1 ">Cancel</a>
                {!! Form::close() !!}
                </div>
            </div>
        </div>
    @endsection
