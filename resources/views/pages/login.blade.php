@extends('layout.app')
    @section('content')
    <style>
        *{
            color: #0063a5;
        }
        body{
                background-color: #d2edff;
            }
    </style>

    <div class="row p-4" style="margin: 1vh"></div>
    <div class="mx-auto w-75" style="height: 35em">
        <div class="row h-100">
            <div class="col p-0 m-0 d-none d-md-block">
                <img src="https://wallpaperaccess.com/full/155741.jpg"  class=" w-100 h-100 " style="clip-path: circle(64.3% at 73% 42%)" alt="">
            </div>
            <div class="col card h-100 rounded-0 rounded-end shadow-lg">
                <div class="text-primary">

                    <h1 class="pt-5 mt-3 mb-0 w-100 text-center" style="font-weight: 700">OASYS</h1>
                    <hr class="w-75 mx-auto">
                    @if(Session::get('fail'))
                        <div class="alert alert-danger w-75 m-auto">{{Session::get('fail')}}</div>
                    @endif
                        <div class='container w-75 mx-auto'>
                        {!! Form::open(['action'=> 'App\Http\Controllers\LoginController@crudlogin','method'=>'POST']) !!}
                            <h6 class="text-secondary m-0 p-0 mt-4">Username</h6>

                            {!! Form::text('user', '', ['class' => 'form-control border-0 border-bottom']) !!}
                            <span class="text-danger">@error('user'){{"This Field is required"}}@enderror</span>

                            <h6 class="text-secondary m-0 p-0 mt-3">Password</h6>
                            {!! Form::password('pass', ['class' =>'form-control  border-0 border-bottom']) !!}
                            <span class="text-danger">@error('pass'){{"This Field is required"}}@enderror</span>
                            <div class="w-100 text-end"><a href="/Password/Forget" class="text-decoration-none text-secondary" style="font-size:13px;">Forgot Password</a></div>


                            <div class="text-left  mx-auto w-75 mt-3 p-0">
                            <input type="checkbox" name="remem" class="form-check-input my-2" id="remem">
                            <label class="form-check-label text-secondary my-1" for="remem">Remember me</label>
                                <br>{!! Form::submit('Login', ['class' => 'btn btn-outline-primary w-100 mx-auto']) !!}
                                <br><a href="/" class="btn btn-outline-primary border-0 w-100 mt-1 ">Cancel</a>
                            </div>

                        {!! Form::close() !!}
                        </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
