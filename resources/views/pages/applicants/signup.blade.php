@extends('layout.applicant_app')
@include('inc.datatables')
    @section('content')
    <style>
        body{
                background-color: #d2edff;
            }
    </style>
    <div class="p-2"></div>
        <div class="text-center text-primary m-auto" style="height: 95vh;">
            <div class="row h-100" style="padding-top:4vh">
                <div class="col">

                </div>
                <div class="col border border-primary bg-white h-100 shadow-lg p-5 me-5 rounded">
                    <div class="h-25">
                        <h1 class="section-title">Create your Account</h1>
                        <h5 class="text-secondary pt-3">Step 1 out of 3</h5>
                    </div>
                    <div class="h-50">
                        @if(Session::get('taken'))
                            <div class="alert alert-danger w-100 m-auto">{{Session::get('taken')}}</div>
                        @endif
                        @if(Session::get('fail'))
                            <div class="alert alert-danger w-100 m-auto">{{Session::get('fail')}}</div>
                        @endif
                        @if(Session::get('pass'))
                            <div class="alert alert-danger w-100 m-auto">{{Session::get('pass')}}</div>
                        @endif

                        <form class="p-1 mt-4" action="/applicant/crudsignup" method="post">
                            @csrf
                            <input class="m-auto form-control w-75 mt-3 p-2" type="text" name="user" placeholder="Username" value="{{old('user')}}">
                            <span class="text-danger">@error('user'){{$message}}@enderror</span>

                            <input class="m-auto form-control w-75 mt-3 p-2" type="password" name="pass" placeholder="Password" value="{{old('pass')}}">
                            <span class="text-danger">@error('pass') {{$message}} @enderror</span>

                            <input class="m-auto form-control w-75 mt-3 p-2" type="password" name="repass" placeholder="Confirm Password" value="{{old('repass')}}">
                            <span class="text-danger">@error('repass'){{$message}}@enderror</span>

                            <br>

                            <div class="row w-75 mx-auto">
                                <div class="col-1 text-end p-0 pt-1 pe-2">
                                    <input type="checkbox"id="data_privacy_chk" name="data_privacy_chk" value="1">
                                </div>
                                <div class="col-5 text-start p-0 pt-2">
                                    <p for="data_privacy_chk" class=" text-dark text-decoration-none p-0 m-0"> I voluntarily consent to the use of my data.</p>
                                </div>
                                <div class="col"></div>
                                <div class="col-4">
                                    <button type="button" class="btn btn-outline-secondary shadow-sm border-0 border-bottom" data-toggle="modal" data-target="#data_privacy">
                                        Read Data Privacy Terms
                                    </button>
                                </div>
                            </div>


                            <div class="row w-75 mx-auto mt-3">
                                <div class="col-1 text-end p-0 pt-1 pe-2">
                                    <input type="checkbox"id="data_privacy_chk" name="data_privacy_chk" value="1">
                                </div>
                                <div class="col-5 text-start p-0 pt-2">
                                    <p for="data_privacy_chk" class=" text-dark text-decoration-none p-0 m-0"> I agree to the terms and condition</p>
                                </div>
                                <div class="col"></div>
                                <div class="col-4">
                                    <button type="button" class="btn btn-outline-secondary shadow-sm border-0 border-bottom" data-toggle="modal" data-target="#term_conditions">
                                        Read Terms and Condition
                                    </button>
                                </div>
                            </div>
                    </div>

                    <div class="h-25">
                        <div class="row">
                            <button type="submit" class="btn btn-primary w-50 mx-auto mt-3 p-4">Sign up</button>
                        </div>
                        <div class="row">
                            <a href="/" class="btn btn-outline-primary w-50 mt-1 mx-auto">Cancel</a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- The Modal -->
        <div class="modal" id="data_privacy">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                    <h4 class="modal-title w-100">Data Privacy Terms</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">

                        <p style="font-size:15px">
                            Your privacy is important to us, and we are committed to protecting it.
                            To maintain the privacy of your personal information, we will be processing your
                            data in accordance with RA 10173, also known as the Data Protection Act of 2012 (DPA of 2012),
                            and its Implementing Rules and Regulations. However, no technique of internet transmission or method
                            of computer storage is completely safe.
                        </p>

                        <p style="font-size:15px">
                            Purpose. This form is intended to collect information provided by the applicant that has been gathered throughout the entire process of registering for the system and utilizing its functions.
                            By filling up this form you are consenting to the collection, processing and use of the information in accordance to this privacy notice. The following are the personal data that we will collect:
                        </p>

                        <div class="row">
                            <div class="col">
                                <ul>
                                    <li>E-mail</li>
                                    <li>Name</li>
                                    <li>Birthday</li>
                                    <li>Contact Number</li>
                                    <li>Age</li>
                                </ul>
                            </div>
                            <div class="col">
                                <ul>
                                    <li>Gender</li>
                                    <li>Picture</li>
                                    <li>Resume</li>
                                    <li>System Activities</li>
                                </ul>
                            </div>
                        </div>


                        <p style="font-size:15px">Your information is used for a variety of objectives, including access provision, attendance, monitoring, evaluation, documentation, and communication. Google is in charge of gathering and storing the data.</p>
                        <p style="font-size:15px">Data Protection. To secure your personal data, the University will take reasonable and suitable organizational, physical, and technical security measures. The data gathered and processed must only be accessed by authorized personnel.</p>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>


        <!-- The Modal -->
        <div class="modal" id="term_conditions">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                    <h4 class="modal-title w-100">Terms and Condition</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                    Modal body..
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
    @endsection
