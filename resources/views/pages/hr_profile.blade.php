@extends('layout.messaging')
    @section('content')
    @if (session('coe_fail'))
        <div class="alert alert-danger p-3">
            <h3>{{ session('coe_fail') }}</h3>
        </div>
    @endif

        <div class="row">
            <div class="col-4 card p-0 me-2 h-100">
                <div class="row p-5">
                    <img src="/{{$details->picture}}" class="rounded-circle shadow-sm px-0 m-auto" height="390px" width="390px">
                </div>
                <div class="row text-center mt-5 mb-3">
                    <h6 class="text-secondary p-0 m-0">User Name</h6>
                    <h1 class="display-3 p-0 m-0">{{ $details->fname }} {{ $details->mname }} {{ $details->lname }}</h1>
                    <h5 class="p-3 text-secondary pb-0">{{ ucfirst(session('user_type')) }} Manager</h5>
                </div>
                <div class="row mb-5 text-center p-5 pb-0">
                    <hr>
                    <div class="col">
                        <h6 class="text-secondary p-0 m-0">Sex</h6>
                        <h3 class=" p-0 m-0 text-secondary">{{ $details->sex }}</h3>
                    </div>
                    <div class="col">
                        <h6 class="text-secondary p-0 m-0">Age</h6>
                        <h3 class="text-secondary p-0 m-0">{{ $details->age }}</h3>
                    </div>
                    <div class="col">
                        <h6 class="text-secondary p-0 m-0">Birthdate</h6>
                        <h3 class="text-secondary p-0 m-0">{{ $details->bday }}</h3>
                    </div>
                </div>
                <div class="row my-5 px-5 text-center">
                    <div class="col">
                        <h6 class="text-secondary p-0 m-0">Email Address</h6>
                        <h4 class=" p-0 m-0 text-secondary">{{ $details->email }}</h4>
                    </div>
                    <div class="col">
                        <h6 class="text-secondary p-0 m-0">Contact Number</h6>
                        <h4 class="text-secondary p-0 m-0">{{ $details->cnum }}</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <a href="/change_picture" class='btn btn-success p-3 rounded-0 btn-lg w-100 shadow-sm'>Change Picture <i class="bi bi-camera-fill"></i></a>
                    </div>
                    <div class="col">
                        <a href="/password" class='btn btn-primary p-3 rounded-0 btn-lg w-100 shadow-sm'>Change Password</a>
                    </div>
                </div>
            </div>

            <div class="col ms-2 p-0">
                <form action="/managerUpdateAccount" method='POST'>
                    @csrf
                    <div class="col card shadow-sm p-0 ms-2 mt-4 text-start">
                        <h1 class="alert-primary w-100 m-0 p-4">Update Account Details</h1>
                        @if(Session::get('success'))
                            <div class="alert alert-success w-100 m-1">{{Session::get('success')}}</div>
                        @endif
                        <div class="p-5">
                            <div class="row mb-5">
                                <div class="alert-light w-100 p-3 h3">Full Name</div>
                                <div class="row">
                                    <div class="col">
                                        <div class="alert-light w-100 p-1 h6">First Name</div>
                                        <input type="text" name="fname" class="form-control" value="{{$details->fname}}">
                                        <span class="text-danger">@error('fname'){{$message}}@enderror</span>
                                    </div>
                                    <div class="col">
                                        <div class="alert-light w-100 p-1 h6">Middle Name</div>
                                        <input type="text" name="mname" class="form-control" value="{{$details->mname}}">
                                        <span class="text-danger">@error('mname'){{$message}}@enderror</span>
                                    </div>
                                    <div class="col">
                                        <div class="alert-light w-100 p-1 h6">Last Name</div>
                                        <input type="text" name="lname" class="form-control" value="{{$details->lname}}">
                                        <span class="text-danger">@error('lname'){{$message}}@enderror</span>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-5">
                                <div class="alert-light w-100 p-3 h3">Personal Details</div>
                                <div class="col">
                                    <div class="alert-light w-100 p-1 h6">Sex</div>
                                    <select name="sex" id="" class='form-select p-3'>
                                        <option value="{{$details->sex}}" selected class="form-option">{{ucfirst($details->sex)}}</option>
                                        @if ($details->sex == 'Male')
                                            <option value="Female" class="form-option">Female</option>
                                        @else
                                            <option value="Male" class="form-option">Male</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col">
                                    <div class="alert-light w-100 p-1 h6">Birthday</div>
                                    <div class="row input-daterange p-0">
                                        <input type="text" name="bday" id="from_date" class="form-control p-4 rounded ms-3" onchange="onchangeBirthday(this)" value="{{$details->bday}}" readonly />
                                    </div>
                                </div>
                                <div class="col text-center">
                                    <div class="alert-light w-100 p-1 h6">Age</div>
                                    <div class="display-6 w-100 p-1 h6" id='age_display'>{{ $details->age }}</div>
                                </div>
                            </div>
                            <hr>
                            <div class="row my-5">
                                <div class="alert-light w-100 p-3 h3">Contact Information</div>
                                <div class="col">
                                    <div class="alert-light w-100 p-1 h6">Email Address</div>
                                    <input type="text" name="email" class="form-control" value="{{$details->email}}">
                                    <span class="text-danger">@error('email'){{$message}}@enderror</span>
                                </div>
                                <div class="col">
                                    <div class="alert-light w-100 p-1 h6">Phone Number</div>
                                    <input type="text" class="form-control" name="cnum" value="{{$details->cnum}}">
                                    <span class="text-danger">@error('cnum'){{$message}}@enderror</span>
                                </div>
                            </div>
                            <hr>
                            <div class="row mt-5 ">
                                <div class="col">
                                    <button type='submit' class="btn btn-success w-100 p-3 shadow-sm"><i class="bi bi-save h2"></i><br>Save Changes</button>
                                </div>
                                <div class="col"></div>
                                <div class="col">
                                    <button type='button' class="btn btn-outline-danger w-100 h-100 shadow-sm" onclick="location.reload()">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                @if(session('user_type') == 'staff')
                <div class="p-0 mx-auto my-3 card p-4 shadow-sm">
                    <div class="row h-100">
                        <div class="col">
                            <img src="/signature/{{session('user_id')}}.png" class="h-100 w-100 shadow-sm" alt="No file uploaded yet">
                        </div>
                        <div class="col-8">
                            <form action="/signatureUpload" enctype="multipart/form-data" method="POST">
                                @csrf

                                @if (session('signature'))
                                    <div class="alert alert-success">
                                        {{ session('signature') }}
                                    </div>
                                @endif
                                <label for="formFile" class="form-label m-0">Signature upload</label>
                                <input class="form-control form-control-lg" name="signature_input" accept="image/png" type="file" id="formFile">
                                <span class="text-danger">@error('signature_input'){{"This Field is required"}}@enderror</span>

                                <div class="row">
                                    <div class="col">
                                        <button type="submit" class="btn btn-outline-success btn-lg my-3 w-100">Submit</button>
                                    </div>
                                    <div class="col-4">
                                        <button type="button" class="btn btn-outline-danger btn-lg my-3 w-100" onclick="location.reload()">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <script>
            $('.input-daterange').datepicker({
                todayBtn:'linked',
                format:'yyyy-mm-dd',
                autoclose:true
            });

            function onchangeBirthday(input){
                $('#age_display').html(getAge(input.value))
            }

            function getAge(dateString) {
                var today = new Date();
                var birthDate = new Date(dateString);
                var age = today.getFullYear() - birthDate.getFullYear();
                var m = today.getMonth() - birthDate.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                return age;
            }
        </script>
    @endsection
