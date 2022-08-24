@extends('layout.app')
    @section('content')
    <div class="row p-5"></div>
    <div class="container w-100 p-4">
        <h5 class=" w-100 text-center">Displayed below is your requested certificate of employment</h5>
        <h6 class="alert-light w-100 text-center">To download the file please press the download button</h6>
        <embed src="/{{$path}}" class="w-100" style="height:1200px"/>
    </div>
    @endsection
