@extends('layout.app')
    @section('content')
        <div class="text-center text-primary m-auto">
            <h1 class="display-3 p-3">Create your Account</h1>
            <h6>step 1 out of 3</h6>

            @if(Session::get('success'))
                <div class="alert alert-success w-50 m-auto">{{Session::get('success')}}</div>
            @endif

            @if(Session::get('fail'))
                <div class="alert alert-success w-50 m-auto">{{Session::get('fail')}}</div>
            @endif


            <form class="p-1 mt-4" action="add" method="post">
                @csrf
                <input class="m-auto form-control w-25 mt-3 p-2" type="text" name="user" placeholder="Username" value="{{old('user')}}">
                <span class="text-danger">@error('user'){{$message}}@enderror</span>

                <input class="m-auto form-control w-25 mt-3 p-2" type="password" name="pass" placeholder="Password" value="{{old('pass')}}">
                <span class="text-danger">@error('pass'){{$message}}@enderror</span>

                <input class="m-auto form-control w-25 mt-3 p-2" type="password" name="repass" placeholder="Confirm Password" value="{{old('repass')}}">
                <span class="text-danger">@error('repass'){{$message}}@enderror</span>

                <button type="submit" class="btn btn-primary w-25 mt-3 ">Sign up</button>
                <br><button type="cancel" class="btn btn-outline-primary w-25 mt-1 ">Cancel</button>
            </form>
        </div>
    @endsection