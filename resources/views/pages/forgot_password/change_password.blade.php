@extends('layout.app')
    @section('content')
    <div class="row p-5"></div>
    <div class="container w-100 p-4">
        @if (session('confirmation'))
            <h5 class="alert-danger p-3 rounded w-75 mx-auto shadow-sm">{{ session('confirmation') }}</h1>
        @endif

        @if (session('success'))
            <h5 class="alert-success p-3 rounded w-75 mx-auto shadow-sm">{{ session('success') }}</h1>
        @endif

        @if (session('forgotPassCheck'))
        @php
            session()->reflash();
        @endphp
        <form action="/forgotPassword" method="POST">
            @csrf
            <div class="alert-primary w-75 mx-auto p-3 h3 mb-0 border rounded-top shadow-lg">Enter New Password</div>
            <div class="card w-75 mx-auto p-3 shadow-lg rounded-0 rounded-bottom">
                <div class="row mb-5 w-100 mx-auto">
                    {!! Form::hidden('id', $id) !!}
                    {!! Form::hidden('date', $date) !!}
                    <div class="row p-4">
                        <div class="col">
                            <div class="alert-light w-100 p-1 h6">New Password</div>
                            <input type="password" name="newpass" class="form-control" value="">
                            <span class="text-danger">@error('newpass'){{$message}}@enderror</span>
                        </div>
                        <div class="col">
                            <div class="alert-light w-100 p-1 h6">Re-enter New Password</div>
                            <input type="password" name="confirmpass" class="form-control" value="">
                            <span class="text-danger">@error('confirmpass'){{$message}}@enderror</span>
                        </div>
                    </div>
                    <div class="row mb-0 px-4">
                        <div class="col">
                            <button type="submit" class="btn btn-success w-100 btn-sm p-2">Confirm Changes</button>
                        </div>
                        <div class="col"></div>
                        <div class="col">
                            <button type="button" class="btn btn-danger w-100 btn-sm p-2" onclick="location.reload()">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @else
        <div class="row text-center m-4">
            <p class="w-100 text-center display-6">The link has expired</p>
            <a href="/">Go to Home</a>
        </div>
        @endif

    @endsection
