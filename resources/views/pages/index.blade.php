@extends('layout.app')
    @section('content')
    <div class="row">
        <div class="col" style="height: 100vh">
            <img class="w-100 h-100" src="https://www.timeshighereducation.com/unijobs/getasset/68fdfdc4-4442-449a-8ad5-2a994eff3e57/" alt="">
        </div>
        <div class="col justify-content-center text-center text-primary">
            <h1 class="pt-5 mt-5">OASYS</h1>

            <p>Overall Administering System</p>
            <p class="m-auto w-75 mt-5 pt-3 mb-5 ">A Human Resource Records and Information Management System. 
                a tool that is designed to assist firms in meeting their key Human 
                Resource requirements while also increasing the efficiency of 
                both management and staff.</p>
            <a href="/login" class="btn btn-primary w-25 m-1">LOGIN</a>
            <br>
            <a href="/signup" class="btn btn-outline-primary w-25 m-1">SEND APPLICATION</a>
        </div>
        
    </div>
    @endsection