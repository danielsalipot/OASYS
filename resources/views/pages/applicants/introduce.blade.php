@extends('layout.applicant_app')
    @section('content')
    @if(Session::get('success'))
        <div class="alert alert-success w-50 m-auto">{{Session::get('success')}}</div>
    @endif
    <style>
        body{
                background-color: #d2edff;
            }
    </style>
    <div class="p-5"></div>
    <div class="card shadow-lg w-75 p-5  m-auto">
        <div class='row m-auto w-100'>
            <h1 class='section-title text-primary'>Introduce Your Self</h1>
            <h6 class='section-title-3 text-secondary'>Step 2 out of 3</h6>
        </div>

        <hr>
        <form action="/applicant/crudintroduce"  method="post">
            @csrf
            <div class='row m-auto w-100'>
            <div class="row px-3">
                <div class="col">
                    <label>First Name</label>
                    <input type="text" class="form-control" name="fname" placeholder="First name" value="{{old('fname')}}">
                    <span class="text-danger">@error('fname'){{$message}}@enderror</span>
                </div>

            <div class="col-2">
                <label for="inputState">Sex</label>
                <select id="inputState" name="sex" class="form-control">
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
                <label>Contact Number</label>
                <input type="text" class="form-control" name="cnum" placeholder="Contact Number" value="{{old('cnum')}}">
                <span class="text-danger">@error('cnum'){{$message}}@enderror</span>
            </div>
        </div>

        <div class="row p-3">
            <div class="col">
                <label>Middle Name</label>
                <input type="text" class="form-control" name="mname" placeholder="Middle name" value="{{old('mname')}}">
                <span class="text-danger">@error('mname'){{$message}}@enderror</span>
            </div>

            <div class="col-7">
                <label>Email Address</label>
                <input type="text" class="form-control" name="email" placeholder="Email Address" value="{{old('email')}}">
                <span class="text-danger">@error('email'){{$message}}@enderror</span>
            </div>
        </div>

        <div class="row p-3">
            <div class="col-4">
                <label>Last Name</label>
                <input type="text" class="form-control" name="lname" placeholder="Last name" value="{{old('lname')}}">
                <span class="text-danger">@error('lname'){{$message}}@enderror</span>
            </div>

            <div class="col">
                <label for="inputState">Educational Attainment</label>
                <input type="text" class="form-control" name="educ" placeholder="Educational Attainment" value="{{old('educ')}}">
                <span class="text-danger">@error('educ'){{$message}}@enderror</span>
            </div>

            <div class="col form-group">
                <label for="inputState">Birthday</label>
                <input type='date' onchange="changeAge(this)" name="bday" id="bday" class="form-control" value="{{old('bday')}}" />
                <span class="text-danger">@error('bday'){{$message}}@enderror</span>
            </div>
            <div class="col-1">
                <label for="inputState">Age</label>
                <input type="text" id="age" class="form-control" name="age" placeholder="Age" value="{{old('age')}}">
                <span class="text-danger">@error('age'){{$message}}@enderror</span>
            </div>
        </div>
        <hr>
        <div class="row text-center p-2">
            <div class="col">
                <button type="submit" class="btn btn-primary w-50 m-auto">Sign up</button>
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


