@extends('layout.app')
    @section('content')
    <div class="row pt-5">
        <div class="col-7" style="height: 100vh">
            <img class="w-100 mt-5" src="https://miro.medium.com/max/1400/1*u6wsaofSWkZG4_-7vGto2g.png" alt="">
        </div>
        <div class="index col justify-content-center text-center text-primary">
            <h1 class="pt-5 mt-5 mb-0">OASYS</h1>

            <p>Overall Administering System</p>
            <p class="m-auto w-75 mt-5 pt-2 mb-5 ">A Human Resource Records and Information Management System.
                a tool that is designed to assist firms in meeting their key Human
                Resource requirements while also increasing the efficiency of
                both management and staff.</p>
            <a href="/login" class="btn btn-outline-primary w-50 m-2">Login</a>
            <hr class="w-50 m-auto">
            <a href="/applicant/signup" class="w-50 m-2 btn btn-outline-secondary border-0"><i class="bi bi-envelope-open-fill"></i><br>Send Application</a>
        </div>

    </div>
    @endsection
