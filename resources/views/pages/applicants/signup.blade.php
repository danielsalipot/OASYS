@extends('layout.applicant_app')
    @section('content')
    <style>
        body{
                background-color: #d2edff;
            }
    </style>
        <div class="text-center text-primary m-auto">
            @if(Session::get('taken'))
                <div class="alert alert-danger w-50 m-auto">{{Session::get('taken')}}</div>
            @endif
            @if(Session::get('fail'))
                <div class="alert alert-danger w-50 m-auto">{{Session::get('fail')}}</div>
            @endif
            @if(Session::get('pass'))
                <div class="alert alert-danger w-50 m-auto">{{Session::get('pass')}}</div>
            @endif

            <div class="row p-2"></div>
            <div class="row" style="padding-top:4vh">
                <div class="col">

                </div>
                <div class="col border border-primary bg-white shadow-lg p-5 rounded">
                    <h1 class="section-title">Create your Account</h1>
                    <h5 class="text-secondary pt-3">Step 1 out of 3</h5>

                    <form class="p-1 mt-4" action="/applicant/crudsignup" method="post">
                        @csrf
                        <input class="m-auto form-control w-75 mt-3 p-2" type="text" name="user" placeholder="Username" value="{{old('user')}}">
                        <span class="text-danger">@error('user'){{$message}}@enderror</span>

                        <input class="m-auto form-control w-75 mt-3 p-2" type="password" name="pass" placeholder="Password" value="{{old('pass')}}">
                        <span class="text-danger">@error('pass') {{$message}} @enderror</span>

                        <input class="m-auto form-control w-75 mt-3 p-2" type="password" name="repass" placeholder="Confirm Password" value="{{old('repass')}}">
                        <span class="text-danger">@error('repass'){{$message}}@enderror</span><br>

                        <button type="submit" class="btn btn-primary w-50 mt-3 ">Sign up</button>
                        <br><a href="/" class="btn btn-outline-primary w-50 mt-1 ">Cancel</a>
                    </form>
                </div>
                <div class="col">

                </div>
            </div>
        </div>
    @endsection
