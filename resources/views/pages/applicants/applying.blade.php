    @extends('layout.applicant_app')
    @section('content')
    <div class="row w-100 p-5"></div>
    <div class='row p-5 mx-5 shadow-lg'>
        <div class="col text-center rounded">
            <form action="/applicant/crudapply" method="post" enctype="multipart/form-data">
            @csrf
                <div class='row m-auto text-primary'>
                <h6 class="s-page text-secondary">Step 3 out of 3</h6>
                <h1 class='section-title'>I am applying for</h1>

                <div class='row m-auto w-50 mt-3 mb-3'>
                    <label for="inputState" class="text-secondary">Choose a position</label>
                    <select id="inputState" name="position" class="border-primary p-3 rounded ">
                        @foreach ($positions as $data)
                        <option class="dropdown-item" >{{ $data->position_title }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">@error('user'){{"This Field is required"}}@enderror</span>
                    </div>
                </div>

                <div class='row m-auto pt-4'>
                    <h3 class='section-title-2'>Send us your resume</h3>
                </div>

                <div class='col justify-content-center'>
                    <input type="file" name="resume" class="input-resume m-auto" id="resume">
                    <span class="text-danger">@error('user'){{"This Field is required"}}@enderror</span>
                </div>

                <div class='mt-2'>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-primary w-50 m-1">PROCEED</button>
                        </div>
                    </div>
                </div>
        </div>
        <div class="col text-center">
            <img src="https://st3.depositphotos.com/23594922/31822/v/600/depositphotos_318221368-stock-illustration-missing-picture-page-for-website.jpg" style="object-fit: cover;" id="output" height="300px" width="300px" class="rounded-circle border border-primary"/>

            <div class='row m-auto pt-4'>
                <h5 class='text-primary'>Upload your picture</h5>
            </div>

            <input type="file" accept="image/*" name="picinput" id="picinput" onchange="loadFile(event)">
            <span class="text-danger">@error('user'){{"This Field is required"}}@enderror</span>

            {{-- picture preview script --}}
            <script>
                var loadFile = function(event) {
                var output = document.getElementById('output');
                    output.src = URL.createObjectURL(event.target.files[0]);
                    output.onload = function() {
                        URL.revokeObjectURL(output.src) // free memory
                    }
                };
            </script>

            </form>
        </div>
    </div>
    @endsection

    {{-- <div class ='col text-center p-5 mt-5'>
        <form action="/applicant/crudapply" method="post" enctype="multipart/form-data">
            @csrf
            <div class='row m-auto text-primary'>
            <h6 class="s-page text-secondary">Step 3 out of 3</h6>
            <h1 class='section-title'>I am applying for</h1>

            <div class='row m-auto w-50 mt-3 mb-3'>
                <label for="inputState">Choose a position</label>
                <select id="inputState" name="position" class="border-primary p-3 rounded ">
                    <option class="dropdown-item" selected>Teacher</option>
                    <option class="dropdown-item">Staff</option>
                    <option class="dropdown-item">Principal</option>
                </select>
                <span class="text-danger">@error('user'){{"This Field is required"}}@enderror</span>
                </div>
            </div>

            <div class='row m-auto pt-4'>
                <h3 class='section-title-2'>Send us your resume</h3>
            </div>

            <div class='col justify-content-center'>
                <input type="file" name="resume" class="input-resume m-auto" id="resume">
                <span class="text-danger">@error('user'){{"This Field is required"}}@enderror</span>
            </div>

            <div class='mt-2'>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-primary w-50 m-1">PROCEED</button>
                    </div>
                </div>
            </div> --}}

            {{-- <img src="https://st3.depositphotos.com/23594922/31822/v/600/depositphotos_318221368-stock-illustration-missing-picture-page-for-website.jpg" style="object-fit: cover;" id="output" height="300px" width="300px" class="rounded-circle border border-primary"/>

                <div class='row m-auto pt-4'>
                    <h5 class='text-primary'>Upload your picture</h5>
                </div>

                <input type="file" accept="image/*" name="picinput" id="picinput" onchange="loadFile(event)">
                <span class="text-danger">@error('user'){{"This Field is required"}}@enderror</span>
                {{-- picture preview script--}}
                {{-- <script>
                    var loadFile = function(event) {
                    var output = document.getElementById('output');
                        output.src = URL.createObjectURL(event.target.files[0]);
                        output.onload = function() {
                            URL.revokeObjectURL(output.src) // free memory
                        }
                    };
                </script> --}}
            {{--  --}}
