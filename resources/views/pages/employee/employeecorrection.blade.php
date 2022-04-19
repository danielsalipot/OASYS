@extends('layout.employee_app')
    @section('content')
    <div class="row mt-4">
        <div class="col-1" style="width:6vw"></div>
        <div class="col">
            <div class="container w-100 p-2">
                <h1 class="section-title mt-2 pb-1">Correction Module</h1>
                <div class="col-5 pb-2 w-100">
                    <h4>Orientation Progress</h4>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                </div>
                </div>


                <div class="row border border-secondary rounded">
                    <div class="col">
                    <img class="w-100 h-100" src="https://www.timeshighereducation.com/unijobs/getasset/68fdfdc4-4442-449a-8ad5-2a994eff3e57/" alt="">
                    </div>

                    <div class="col pt-5">
                        <h3 class="text-secondary">1. Introduction</h3>
                        <p> This video serves as an Introduction to the subject matter</p>

                        {!! Form::open() !!}
                        <div class='row'>
                            <div class='col'>
                            {!! Form::submit('Start Video', ['class'=>'btn btn-success w-50 mt-3 p-2']) !!}
                            </div>
                            <div class="col-4">
                            {!! Form::submit('Mark Complete', ['class'=>'btn btn-primary w-100 mt-3 p-2']) !!}
                            </div>
                            </div>
                        {!! Form::close() !!}
                    </div>

                </div>

                <br>

                <div class="row border border-secondary rounded">
                    <div class="col">
                    <img class="w-100 h-100" src="https://www.timeshighereducation.com/unijobs/getasset/68fdfdc4-4442-449a-8ad5-2a994eff3e57/" alt="">
                    </div>

                    <div class="col pt-5">
                        <h3 class="text-secondary">2.Rules and Regulation</h3>
                        <p> This video serves as an Introduction to the subject matter</p>

                        {!! Form::open() !!}
                        <div class='row'>
                            <div class='col'>
                            {!! Form::submit('Start Video', ['class'=>'btn btn-success w-50 mt-3 p-2']) !!}
                            </div>
                            <div class="col-4">
                            {!! Form::submit('Mark Complete', ['class'=>'btn btn-primary w-100 mt-3 p-2']) !!}
                            </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>



@endsection
