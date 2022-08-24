@extends('layout.app')
    @section('content')
    <div class="row p-5"></div>
    <div class="row text-center w-75 mx-auto">
        <h3 style="width: 100%; background-color:rgb(231, 231, 231); color:rgb(48, 48, 48);padding:15px">Forgot Password</h3>
        <p class="w-100 text-center">An email has been sent to the email address of your account, please check your email. If the email has not been received yet you can submit another form by click the button</p>
        <button class="btn btn-primary w-25 mx-auto" onclick="location.reload()">Resend Email</button>
    </div>
    @endsection
