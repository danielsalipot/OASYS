@extends('layout.app')
    @section('content')
        <div class="text-center text-primary m-auto">
            @if(Session::get('fail'))
                <div class="alert alert-danger w-50 m-auto">{{Session::get('fail')}}</div>
            @endif
            <h1 class="display-3 p-3">Login</h1>
            <div class='container'>
            {!! Form::open(['action'=> 'App\Http\Controllers\LoginController@crudlogin','method'=>'POST']) !!}
                {!! Form::text('user', '', ['class' => 'm-auto form-control w-25 mt-3 p-2','placeholder' => 'username']) !!}
                <span class="text-danger">@error('user'){{"This Field is required"}}@enderror</span>

                {!! Form::password('pass', ['class' =>'m-auto form-control w-25 mt-3 p-2','placeholder' =>'password']) !!}
                <span class="text-danger">@error('pass'){{"This Field is required"}}@enderror</span>

                <br>{!! Form::submit('Login', ['class' => 'btn btn-primary w-25 mt-3']) !!}
                <br><a href="/" class="btn btn-outline-primary w-25 mt-1 ">Cancel</a>
            {!! Form::close() !!}
            </div>
        </div>
    @endsection
