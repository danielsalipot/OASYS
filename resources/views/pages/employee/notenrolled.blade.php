@extends('layout.employee_app')
@section('content')
    <div class="row">
        <div class="col">
            <h1 class="section-title mt-2 pb-1">{{ucfirst($category)}} Module</h1>
        </div>
        <div class="col pt-5 mt-3">
        </div>
    </div>
    <h1 class="w-100 text-center" style="font-size: 300px;color:rgb(255, 193, 61)"><i class="bi bi-cone-striped"></i> </h1>
    <h1 class="display-2 w-100 text-center">You are not enrolled yet on this module</h1>
@endsection
