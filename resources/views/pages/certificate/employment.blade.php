@extends('layout.app')
    @section('content')
    <div class="p-4"></div>
    <div class="card m-5 p-0">
        <h4 class="alert-primary w-100 p-4 ">Request for Certificate of Employment</h4>

        <div class="row">
            @if (session('success'))
                <div class="alert alert-success mx-4 p-2">
                    {{session('success')}}
                </div>
            @endif

            <div class="col">
                <div class="card m-2">

                    <h6 class="alert-light w-100 p-3">Username Option</h6>
                    <p class="text-secondary mx-4">To request for certificate of employment using username, type your First Name, Last Name, and Username You need an active email address associated with your account to receive instructions.</p>

                    @if (session('user_err'))
                        <div class="alert alert-danger mx-4 p-2">
                            {{session('user_err')}}
                        </div>
                    @endif

                    <form action="/sendRequestCOE" method="POST">
                    @csrf
                    <div class="row mx-3 mb-5">
                        <div class="form-group">
                            <label for="exampleInputEmail1">First Name</label>
                            <input type="text" name="fname" class="form-control"  placeholder="Enter First Name">
                        </div>

                        <div class="form-group mt-3">
                            <label for="exampleInputEmail1">Last Name</label>
                            <input type="text" name="lname" class="form-control" placeholder="Enter Last Name">
                        </div>

                        <div class="form-group mt-3">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Enter username">
                        </div>

                        <div class="row w-100 mx-auto mt-3">
                            <div class="col"></div>
                            <div class="col-4">
                                <button class="btn btn-primary w-100">Submit</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <div class="col m-2">
                <div class="card p-0">
                    <h6 class="alert-light w-100 p-3 ">Email Option</h6>
                    <p class="text-dark mx-4">To request for certificate of employment using email, enter your First Name, Last Name, and Email Address to change the password. You need an active email address associated with your account to receive instructions.</p>

                    @if (session('email_err'))
                        <div class="alert alert-danger mx-4 p-2">
                            {{session('email_err')}}
                        </div>
                    @endif

                    <form action="/sendRequestCOE" method="POST">
                        @csrf
                        <div class="row mx-3 mb-5">
                            <div class="form-group">
                                <label for="exampleInputEmail1">First Name</label>
                                <input type="text" name="fname" class="form-control"  placeholder="Enter First Name">
                            </div>

                            <div class="form-group mt-3">
                                <label for="exampleInputEmail1">Last Name</label>
                                <input type="text" name="lname" class="form-control" placeholder="Enter Last Name">
                            </div>

                            <div class="form-group mt-3">
                                <label for="exampleInputEmail1">Email Address</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter Email Address">
                            </div>

                            <div class="row w-100 mx-auto mt-3">
                                <div class="col"></div>
                                <div class="col-4">
                                    <button class="btn btn-primary w-100">Submit</button>
                                </div>
                            </div>
                        </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
