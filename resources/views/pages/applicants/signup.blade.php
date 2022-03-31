@extends('layout.applicant_app')
    @section('content')
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

            <h1 class="display-3 p-3">Create your Account</h1>
            <h6>step 1 out of 3</h6>

            <form class="p-1 mt-4" action="crudsignup" method="post">
                @csrf
                <input class="m-auto form-control w-25 mt-3 p-2" type="text" name="user" placeholder="Username" value="{{old('user')}}">
                <span class="text-danger">@error('user'){{"This Field is required"}}@enderror</span>

                <input class="m-auto form-control w-25 mt-3 p-2" type="password" name="pass" placeholder="Password" value="{{old('pass')}}">
                <span class="text-danger">@error('pass'){{"This Field is required"}}@enderror</span>

                <input class="m-auto form-control w-25 mt-3 p-2" type="password" name="repass" placeholder="Confirm Password" value="{{old('repass')}}">
                <span class="text-danger">@error('repass'){{"This Field is required"}}@enderror</span><br>

                <button type="submit" class="btn btn-primary w-25 mt-3 ">Sign up</button>
                <br><a href="/" class="btn btn-outline-primary w-25 mt-1 ">Cancel</a>
            </form>
        </div>
    @endsection