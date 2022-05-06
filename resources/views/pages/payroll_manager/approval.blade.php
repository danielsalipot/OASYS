@extends('layout.payroll_app')

@section('title')
    <h1 class="section-title mt-5 pb-5">Approval</h1>
@endsection

@section('content')
<div class="container w-100 p-2">

    <div class="progress">
        <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
    </div>

    <div class='row m-auto pt'>
        <h1>Attach your E-Signature</h1>
        <input type="file" name="esignature" class="input-resume m-auto" id="esignature">
    </div>

</div>
@endsection
