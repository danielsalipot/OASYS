@extends('layout.applicant_app')
@include('inc.datatables')
    @section('content')
    @if(Session::get('success'))
        <div class="alert alert-success w-50 m-auto">{{Session::get('success')}}</div>
    @endif
    <style>
        body{
                background-color: #d2edff;
            }
    </style>
    <div class="card shadow-lg p-5 m-0" style="height: 100vh">
        <div class='row m-auto w-100 mt-5 m-0'>
            <div class="row rounded p-0 ">
                <div class="border border-primary col bg-primary p-3 shadow-sm m-0 rounded-start"></div>
                <div class="border border-primary col-1 p-1 bg-primary shadow-sm">Step 1</div>
                <div class="border border-primary col bg-primary p-3 shadow-sm m-0"></div>
                <div class="border border-primary col-1 p-1 bg-primary shadow-sm">Step 2</div>
                <div class="border-top border-bottom border-primary col bg-light p-3 shadow-sm"></div>
                <div class="border-top border-bottom border-end border-primary col-1 p-1 bg-light text-secondary rounded-end shadow-sm"> Step 3</div>
            </div>
            <h1 class='section-title my-5 text-primary w-100 text-center'>Introduce Your Self</h1>
        </div>


        <form action="/applicant/crudintroduce" class="h-75"  method="post">
            @csrf
            <div class='row m-auto w-75'>
                <hr>
            <div class="row p-5">
                <div class="col">
                    <label class="text-secondary h6">First Name</label>
                    <input type="text" class="form-control form-control-lg" name="fname" placeholder="First name" value="{{old('fname')}}">
                    <span class="text-danger">@error('fname'){{$message}}@enderror</span>
                </div>

            <div class="col-2">
                <label class="text-secondary h6" for="inputState">Gender</label>
                <select id="inputState" name="sex" class="form-select form-select-lg">
                @if(old('sex') == "Male" || !old('sex') == "Female")
                    <option selected>Male</option>
                    <option>Female</option>
                @else
                    <option>Male</option>
                    <option selected>Female</option>
                @endif
                </select>
            </div>

            <div class="col-6">
                <label class="text-secondary h6">Contact Number</label>
                <input type="text" class="form-control form-control-lg" name="cnum" placeholder="Contact Number" value="{{old('cnum')}}">
                <span class="text-danger">@error('cnum'){{$message}}@enderror</span>
            </div>
        </div>

        <div class="row p-5">
            <div class="col-4">
                <label class="text-secondary h6">Middle Name</label>
                <input type="text" class="form-control form-control-lg" name="mname" placeholder="Middle name" value="{{old('mname')}}">
                <span class="text-danger">@error('mname'){{$message}}@enderror</span>
            </div>
            <div class="col"></div>
            <div class="col-7">
                <label class="text-secondary h6">Email Address</label>
                <input type="text" class="form-control form-control-lg" name="email" placeholder="Email Address" value="{{old('email')}}">
                <span class="text-danger">@error('email'){{$message}}@enderror</span>
            </div>
        </div>

        <div class="row p-5">
            <div class="col-4">
                <label class="text-secondary h6">Last Name</label>
                <input type="text" class="form-control form-control-lg" name="lname" placeholder="Last name" value="{{old('lname')}}">
                <span class="text-danger">@error('lname'){{$message}}@enderror</span>
            </div>
            <div class="col">
                <label class="text-secondary h6" for="inputState">Educational Attainment</label>
                <input type="text" class="form-control form-control-lg" name="educ" placeholder="Educational Attainment" value="{{old('educ')}}">
                <span class="text-danger">@error('educ'){{$message}}@enderror</span>
            </div>

            <div class="col form-group">
                <label class="text-secondary h6" for="inputState">Birthday</label>
                <input type='date' onchange="changeAge(this)" name="bday" id="bday" class="form-control form-control-lg" value="{{old('bday')}}" />
                <span class="text-danger">@error('bday'){{$message}}@enderror</span>
            </div>
            <div class="col-1">
                <label class="text-secondary h6" for="inputState">Age</label>
                <input type="text" id="age" class="form-control form-control-lg" name="age" placeholder="Age" value="{{old('age')}}">
                <span class="text-danger">@error('age'){{$message}}@enderror</span>
            </div>
        </div>
        <hr>
        <div class="row text-center p-5">
            <div class="col">
                <button type="submit" class="btn btn-outline-primary shadow-sm w-25 p-4 m-auto">Submit Personal Details</button>
            </div>
        </div>
    </div>
    </form>
</div>

<script>
    function changeAge(input){
        var age = document.getElementById("age")
        age.value = getAge(input.value)
    }

    function getAge(dateString)
    {
        var today = new Date();
        var birthDate = new Date(dateString);
        var age = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate()))
        {
            age--;
        }
        return age;
    }
</script>
@endsection


