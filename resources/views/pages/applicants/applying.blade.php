    @extends('layout.applicant_app')
    @section('content')
    <style>
        body{
                background-color: #d2edff;
            }
    </style>
    <div class="row w-100 p-5"></div>
    <div class='row mx-auto w-75'>
        <div class="col text-center card rounded-0 rounded-start rounded-bottom border-0  p-5">
            <form action="/applicant/crudapply" method="post" enctype="multipart/form-data">
            @csrf
                <div class='row m-auto text-primary'>
                <h6 class="s-page text-secondary">Step 3 out of 3</h6>
                <h1 class='section-title'>I am applying for</h1>

                <div class='row m-auto w-75 my-4'>
                    <h6 class='text-secondary'>Choose a position</h6>
                    <select id="inputState" name="position" class="form-select p-3 shadow-sm">
                        @foreach ($positions as $data)
                        <option class="dropdown-item" >{{ $data->position_title }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">@error('position'){{"This Field is required"}}@enderror</span>
                    </div>
                </div>

                <div class='row m-auto mt-4 mb-3'>
                    <h6 class='text-secondary m-0 p-0'>Send us your resume</h6>
                    <p class="p-0 m-0 w-100 text-center text-warning" style="font-size: 10px">The resume should be in PDF format</p>
                </div>

                <div class='col border w-75 mx-auto p-3 rounded shadow-sm'>
                    <input type="file" name="resume" class="input-resume m-auto" accept="application/pdf" id="resume">
                    <br>
                    <span class="text-danger">@error('resume'){{"This Field is required"}}@enderror</span>
                </div>
        </div>
        <div class="col text-center p-0">
            <div class="card rounded-0 rounded-end  border-0 p-4">
                <div class="w-100 text-center">
                    <img src="https://st3.depositphotos.com/23594922/31822/v/600/depositphotos_318221368-stock-illustration-missing-picture-page-for-website.jpg" style="object-fit: cover;" id="output" height="300px" width="300px" class="rounded-circle border border-primary"/>

                    <div class='row m-auto pt-4'>
                        <h5 class='text-primary'>Upload your picture</h5>
                    </div>

                    <input type="file" accept="image/*" name="picinput" id="picinput" onchange="loadFile(event)">
                    <br>
                    <span class="text-danger">@error('picinput'){{"This Field is required"}}@enderror</span>
                </div>
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
            </div>
                <div class="row mt-4">
                    <div class="col"></div>
                    <div class="col-8">
                        <button type="submit" class="btn btn-outline-primary w-100 shadow-lg">Proceed</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endsection
