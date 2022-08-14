@extends('layout.employee_app')
    @section('content')
    <div class="row">
        <div class="col-4">
            <div class="card w-100 p-5 rounded-0 rounded-top shadow-sm">
                <div class="row">
                    <img src="/{{$profile->userDetail->picture}}" class="rounded-circle shadow-sm p-0 m-auto" height="390px" width="390px">
                </div>
                <div class="row text-center mt-5 mb-3">
                    <h6 class="text-secondary p-0 m-0">Employee Name</h6>
                    <h1 class="display-3 p-0 m-0">{{ $profile->userDetail->fname }} {{ $profile->userDetail->mname }} {{ $profile->userDetail->lname }}</h1>
                </div>
                <hr>
                <div class="row my-5 p-0 text-center">
                    <div class="col-3">
                        <h6 class="text-secondary p-0 m-0">Employee ID</h6>
                        <h1 class="display-6 p-0 m-0">{{ $profile->employee_id }}</h1>
                    </div>
                    <div class="col">
                        <h6 class="text-secondary p-0 m-0">Employee Department</h6>
                        <h1 class="display-6 p-0 m-0">{{ $profile->department }}</h1>
                    </div>
                    <div class="col">
                        <h6 class="text-secondary p-0 m-0">Employee Position</h6>
                        <h1 class="display-6 p-0 m-0">{{ $profile->position }}</h1>
                    </div>
                </div>
                <hr>
                <div class="row my-5 mt-2  text-center">
                    <h6 class="text-secondary p-0 m-0">Educational Attainment</h6>
                    <h3 class=" p-0 m-0 text-secondary">{{ $profile->educ }}</h3>
                </div>
                <div class="row mb-5 text-center">
                    <div class="col">
                        <h6 class="text-secondary p-0 m-0">Sex</h6>
                        <h3 class=" p-0 m-0 text-secondary">{{ $profile->userDetail->sex }}</h3>
                    </div>
                    <div class="col">
                        <h6 class="text-secondary p-0 m-0">Age</h6>
                        <h3 class="text-secondary p-0 m-0">{{ $profile->age }}</h3>
                    </div>
                    <div class="col">
                        <h6 class="text-secondary p-0 m-0">Birthdate</h6>
                        <h3 class="text-secondary p-0 m-0">{{ $profile->userDetail->bday }}</h3>
                    </div>
                </div>
                <div class="row my-5 text-center">
                    <div class="col">
                        <h6 class="text-secondary p-0 m-0">Email Address</h6>
                        <h4 class=" p-0 m-0 text-secondary">{{ $profile->userDetail->email }}</h4>
                    </div>
                    <div class="col">
                        <h6 class="text-secondary p-0 m-0">Contact Number</h6>
                        <h4 class="text-secondary p-0 m-0">{{ $profile->userDetail->cnum }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col text-end pt-3">
            <a href="./" class="text-black text-decoration-none h4"><i class="bi bi-chevron-left"></i> Go to Profile</a>
            <form action="/employeeUpdateDetail" method='POST' enctype="multipart/form-data">
            @csrf
            <div class="card shadow-sm p-0 mt-4 text-start">
                <h1 class="alert-primary w-100 m-0 p-4">Update Account Details</h1>
                <div class="p-5">
                    <div class="row mb-5">
                        <div class="alert-light w-100 p-3 h3">Personal Details</div>
                        <div class="col">
                            <div class="alert-light w-100 p-1 h6">Sex</div>
                            <select name="sex" id="" class='form-select p-3'>
                                <option value="{{$profile->userDetail->sex}}" selected class="form-option">{{ucfirst($profile->userDetail->sex)}}</option>
                                @if ($profile->userDetail->sex == 'male')
                                    <option value="Female" class="form-option">Female</option>
                                @else
                                    <option value="Male" class="form-option">Male</option>
                                @endif
                            </select>
                        </div>
                        <div class="col">
                            <div class="alert-light w-100 p-1 h6">Birthday</div>
                            <div class="row input-daterange p-0">
                                <input type="text" name="bday" id="from_date" class="form-control p-4 rounded ms-3" onchange="onchangeBirthday(this)" value="{{$profile->userDetail->bday}}" readonly />
                            </div>
                        </div>
                        <div class="col text-center">
                            <div class="alert-light w-100 p-1 h6">Age</div>
                            <div class="display-6 w-100 p-1 h6" id='age_display'>{{ $profile->age }}</div>
                        </div>
                    </div>
                    <div class="row text-center w-50 mb-5 mx-auto">
                        <div class="alert-light w-100 p-1 h6">Educational Attainment</div>
                        <input type="text" name="educ" class="form-control" value="{{$profile->educ}}">
                        <span class="text-danger">@error('educ'){{$message}}@enderror</span>
                    </div>
                    <hr>
                    <div class="row my-5">
                        <div class="alert-light w-100 p-3 h3">Contact Information</div>
                        <div class="col">
                            <div class="alert-light w-100 p-1 h6">Email Address</div>
                            <input type="text" name="email" class="form-control" value="{{$profile->userDetail->email}}">
                            <span class="text-danger">@error('email'){{$message}}@enderror</span>
                        </div>
                        <div class="col">
                            <div class="alert-light w-100 p-1 h6">Phone Number</div>
                            <input type="text" class="form-control" name="cnum" value="{{$profile->userDetail->cnum}}">
                            <span class="text-danger">@error('cnum'){{$message}}@enderror</span>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-5" style="height: 910px">
                        <div class="col-3">
                            <div class="alert-light w-100 p-3 h3">Resume</div>
                            <h6>Submit new Resume (PDF)</h6>
                            <input class="form-control p-3 m-0" type="file" accept="application/pdf" name='resume' id="formFile">
                        </div>
                        <div class="col">
                            <embed src="/{{$profile->resume}}" class="w-100 h-100" />
                        </div>
                    </div>
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
        </div>
    </div>
    @endsection
    @section('script')
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
