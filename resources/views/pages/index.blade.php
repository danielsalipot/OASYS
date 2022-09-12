@extends('layout.app')
    @section('content')
    <style>
        body{
            overflow: hidden;
        }
    </style>
    <div class="row m-3 p-0 rounded bg-white" style="height: 95vh">
        <div class="index col justify-content-center text-center text-primary">
            <h1 class="pt-5 mt-3 mb-0" style="font-size: 80px">OASYS</h1>
            <hr class="m-0 p-0 m-auto w-50">
            <p class="text-secondary">Overall Administering System</p>

            <p class="m-auto w-75 mt-5 pt-2 mb-5 ">A Human Resource Records and Information Management System.
                a tool that is designed to assist firms in meeting their key Human
                Resource requirements while also increasing the efficiency of
                both management and staff.
            </p>

            <div class="row h-25">
                <div class="col">
                    <a href="/login" class="btn btn-outline-primary border-0  w-100 h-100 m-2"><i class="bi bi-door-open" style="font-size:80px"></i><br>Login to Oasys</a>
                </div>
                <div class="col">
                    <a  href="/applicant/signup"class="btn btn-outline-primary border-0 w-100 h-100 m-2"><i class="bi bi-file-earmark-text-fill"style="font-size:80px"></i><br>Send Application</a>
                </div>
            </div>

            <div class="row h-25 mt-3">
                <div class="col">
                    <hr class="w-50 mx-auto mt-1">
                    <a  href="/request/employment" class=" m-auto h-100 m-2 text-decoration-none text-secondary ms-3" style="font-size:13px">Request for COE <i class="bi bi-arrow-right-short"></i></a>
                </div>
                <div class="col">
                </div>
            </div>
        </div>

        <div class="col-6 p-0 h-100 m-0" >
            <div class="row h-100">
                <img class="rounded-end h-100 m-0 w-100" src="https://cdn.dribbble.com/users/5508583/screenshots/14363324/media/dd7e3060eeb472c9a882e203403cca21.gif" style="clip-path: circle(70.7% at 71% 50%)" >
            </div>
        </div>

        <style>
            body{
                background-color: #004e82;
            }
            .cloud{
                height:50px;
                width:50px;
                border-radius: 50%;
                position:absolute;
                background-color:  #004e82;
            }
        </style>
        <div class="cloud shadow-sm" style="top: 85vh; right:-1vw; height:200px; width:200px;"></div>
        <div class="cloud shadow-sm" style="top: 82vh; right:7vw; height:180px; width:180px;"></div>
        <div class="cloud shadow-sm" style="top: 70vh; right:-1vw; height:180px; width:180px;"></div>
        <div class="cloud shadow-sm" style="top: 65vh; right:-9vw; height:200px; width:200px;"></div>
        <div class="cloud shadow-sm" style="top: 82vh; right:15vw; height:150px; width:150px;"></div>
        <div class="cloud shadow-sm" style="top: 90vh; right:20vw; height:180px; width:180px;"></div>
        <div class="cloud shadow-sm" style="top: 85vh; right:20vw; height:200px; width:200px;"></div>
        <div class="cloud shadow-sm" style="top: 93vh; right:28vw; height:130px; width:130px;"></div>


        <div class="cloud shadow-sm" style="top: 51vh; right:-1vw; height:150px; width:150px;"></div>
        <div class="cloud shadow-sm" style="top: 61vh; right:2vw; height:120px; width:120px;"></div>
        <div class="cloud shadow-sm" style="top: 69vh; right:7vw; height:120px; width:120px;"></div>
        <div class="cloud shadow-sm" style="top: 73vh; right:13vw; height:100px; width:100px;"></div>
        <div class="cloud shadow-sm" style="top: 81vh; right: 21vw; height:100px; width:100px;"></div>
    </div>
    @endsection
