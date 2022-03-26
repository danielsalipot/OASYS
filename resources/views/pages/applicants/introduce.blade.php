@extends('layout.app')
    @section('content')
    @if(Session::get('success'))
      <div class="alert alert-success w-50 m-auto">{{Session::get('success')}}</div>
    @endif
    <div class='row m-auto w-75 pt-5'>
        <h1 class='text-primary'>Introduce Your Self</h1>
        <h6 class='text-primary'>step 2 out of 3</h6> 
    </div>

    <form action="crudintroduce"  method="post">
      @csrf
      <div class='row m-auto w-75 pt-5'>
        <div class="row p-3">
          <div class="col">
            <label>First Name</label>
            <input type="text" class="form-control" name="fname" placeholder="First name" value="{{old('fname')}}">
            <span class="text-danger">@error('fname'){{"This Field is required"}}@enderror</span>
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
            <span class="text-danger">@error('cnum'){{"This Field is required"}}@enderror</span>
          </div>
        </div>

        <div class="row p-3">
          <div class="col">
            <label>Middle Name</label>
            <input type="text" class="form-control" name="mname" placeholder="Middle name" value="{{old('mname')}}">
            <span class="text-danger">@error('mname'){{"This Field is required"}}@enderror</span>
        </div>

        <div class="col-2">
          <label for="inputState">Age</label>
          <input type="text" class="form-control" name="age" placeholder="Age" value="{{old('age')}}">
          <span class="text-danger">@error('age'){{"This Field is required"}}@enderror</span>
        </div>

        <div class="col-6">
          <label>Email Address</label>
          <input type="text" class="form-control" name="email" placeholder="Email Address" value="{{old('email')}}">
          <span class="text-danger">@error('email'){{"This Field is required"}}@enderror</span>
        </div>
      </div>

      <div class="row p-3">
        <div class="col-4">
          <label>Last Name</label>
          <input type="text" class="form-control" name="lname" placeholder="Last name" value="{{old('lname')}}">
          <span class="text-danger">@error('lname'){{"This Field is required"}}@enderror</span>
        </div>
    
        <div class="col">
          <label for="inputState">Educational Attainment</label>
          <input type="text" class="form-control" name="educ" placeholder="Educational Attainment" value="{{old('educ')}}">
          <span class="text-danger">@error('educ'){{"This Field is required"}}@enderror</span>
        </div>

        <div class="col form-group">
          <label for="inputState">Birthday</label>
          <input type='date' name="bday" class="form-control" />
          <span class="text-danger">@error('bday'){{"This Field is required"}}@enderror</span>
        </div>
      </div>
    </div>
          
            {{-- Buttons --}}
    <div class='d-flex justify-content-around mt-4'>
      <div class="row">
        <div class="col ">
          <button type="submit" class="btn btn-primary w-100 m-1 ps-5 pe-5 ">Sign up</button>
        </div>
        <div class="col">
          <a href="/" class="btn btn-outline-primary w-100 m-1 ps-5 pe-5">CANCEL</a>
        </div>
      </div>
    </div>
  </form>   

@endsection