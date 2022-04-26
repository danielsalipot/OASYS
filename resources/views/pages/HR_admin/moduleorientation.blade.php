@extends('layout.admin_app')
    @section('content')
    <div class="row">
        <div class="col-1" style="width:6vw"></div>
        <div class="col">
            <h1 class="section-title mt-5 pb-2">Orientation Module</h1>

            <div class="row border border-secondary rounded w-75">
                <div class="d-flex w-50 p-2">
                    <div class="col">
                        <input type="text" class="rounded-left w-75" placeholder="Search">
                        <button class="btn btn-primary rounded-0 rounded-end"><i class="bi bi-search"></i></button>
                    </div>

                    <div class="col">
                        {!! Form::open() !!}
                        {!! Form::submit(' Add lesson', ['class'=>'btn btn-primary justify-content-end ']) !!}
                    {!! Form::close() !!}
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
                        {!! Form::submit('Edit', ['class'=>'btn btn-success w-50 mt-3 p-2']) !!}
                        </div>
                        <div class="col-4">
                        {!! Form::submit('Delete', ['class'=>'btn btn-danger w-100 mt-3 p-2']) !!}
                        </div>
                        </div>
                    {!! Form::close() !!}
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
                        {!! Form::submit('Edit', ['class'=>'btn btn-success w-50 mt-3 p-2']) !!}
                        </div>
                        <div class="col-4">
                        {!! Form::submit('Delete', ['class'=>'btn btn-danger w-100 mt-3 p-2']) !!}
                        </div>
                        </div>
                    {!! Form::close() !!}
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
                        {!! Form::submit('Edit', ['class'=>'btn btn-success w-50 mt-3 p-2']) !!}
                        </div>
                        <div class="col-4">
                        {!! Form::submit('Delete', ['class'=>'btn btn-danger w-100 mt-3 p-2']) !!}
                        </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
            </div>


                {{-- <div class="col border">
                    <div class="row">
                        <h1>HAHAHA</h1>
                    </div>
                </div> --}}

@endsection
