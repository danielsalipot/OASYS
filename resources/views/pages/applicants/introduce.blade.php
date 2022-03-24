@extends('layout.app')
    @section('content')
    @if(Session::get('success'))
      <div class="alert alert-success w-50 m-auto">{{Session::get('success')}}</div>
    @endif
    <div class='row m-auto w-75 pt-5'>
        <h1 class="display-3">Introduce Your Self</h1>
        <h6>step 2 out of 3</h6> 
    </div>

    <form>
    <div class='row m-auto w-75 pt-5'>
        
            <div class="row">
              <div class="col">
                <label>First Name</label>
                <input type="text" class="form-control" placeholder="First name">
              </div>
              <div class="col-2">
                <label for="inputState">Sex</label>
                <select id="inputState" class="form-control">
                  <option selected>Male</option>
                  <option>Female</option>
                </select>
              </div>
              <div class="col-6">
                <label>Contact Number</label>
                <input type="text" class="form-control" placeholder="Contact Number">
              </div>
            </div>
          
    </div>

    <div class='row m-auto w-75 pt-5'>
        
            <div class="row">
              <div class="col">
                <label>Middle Name</label>
                <input type="text" class="form-control" placeholder="Middle name">
              </div>

              <div class="col-2">
                <label for="inputState">Age</label>
                <input type="text" class="form-control" placeholder="Age">
              </div>
              <div class="col-6">
                <label>Email Address</label>
                <input type="text" class="form-control" placeholder="Email Address">
              </div>
            </div>
         
        </div>
          <div class='row m-auto w-75 pt-5'>
            
                <div class="row">
                  <div class="col-4">
                    <label>Last Name</label>
                    <input type="text" class="form-control" placeholder="Last name">
                  </div>
    
                  <div class="col-5">
                    <label for="inputState">Educational Attainment</label>
                    <input type="text" class="form-control" placeholder="Educational Attainment">
                  </div>
                  <div class="col-2">
                    <label class="custom-file-label" for="validatedCustomFile">Picture</label>
                    <input type="file" class="custom-file-input" id="validatedCustomFile" required>
                  </div>
                </div>
            </div>      
        </form>   
    </div>
        


@endsection