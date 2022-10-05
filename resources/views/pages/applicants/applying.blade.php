    @extends('layout.applicant_app')
    @include('inc.datatables')

    @section('content')
    <style>
        body{
                background-color: #d2edff;
            }
    </style>
    <div class="row w-100 p-5"></div>
    <div class='row mx-auto w-75'>
        <div class="col text-center card rounded-0 rounded-start rounded-bottom border-0 p-5">
            <form action="/applicant/crudapply" method="post" enctype="multipart/form-data">
            @csrf
                <div class='row m-auto text-primary'>
                <div class="row rounded p-0 mb-3">
                    <div class="border border-primary col bg-primary p-3 shadow-sm m-0 rounded-start"></div>
                    <div class="border border-primary col-1 p-1 bg-primary shadow-sm">Step 1</div>
                    <div class="border border-primary col bg-primary p-3 shadow-sm m-0"></div>
                    <div class="border border-primary col-1 p-1 bg-primary shadow-sm">Step 2</div>
                    <div class="border-top border-bottom border-primary col bg-primary p-3 shadow-sm"></div>
                    <div class="border-top border-bottom border-end border-primary col-1 p-1 bg-primary rounded-end shadow-sm"> Step 3</div>
                </div>
                <h1 class='section-title mb-5'>I am applying for</h1>

                <div class='row m-auto w-75 p-0 text-start my-4'>
                    <h3 class='text-secondary p-0 m-0'>Choose a position</h3>
                    <p class="p-0 m-0 text-warning mb-3" style="font-size: 10px">Choose the position you want to apply for</p>
                    <select id="inputState" name="position" class="form-select form-select-lg p-3 shadow-sm">
                        @foreach ($positions as $data)
                        <option class="dropdown-item" >{{ $data->position_title }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">@error('position'){{"This Field is required"}}@enderror</span>
                    </div>
                </div>

                <div class='row m-auto mt-4 mb-3 shadow-sm w-75 p-5'>
                    <h3 class='text-secondary m-0 p-0'>Send us your resume</h3>
                    <p class="p-0 m-0 w-100 text-center text-warning" style="font-size: 10px">The resume should be in PDF format</p>

                    <div class='w-75 mx-auto p-3'>
                        <input type="file" name="resume" class="input-resume m-auto" accept="application/pdf" id="resume">
                        <br>
                        <span class="text-danger">@error('resume'){{"This Field is required"}}@enderror</span>
                    </div>
                </div>
        </div>
        <div class="col text-center p-0">
            <div class="card rounded-0 rounded-end  border-0 p-5">
                <div class="w-100 text-center">
                    <img src="https://st3.depositphotos.com/23594922/31822/v/600/depositphotos_318221368-stock-illustration-missing-picture-page-for-website.jpg" style="object-fit: cover;" id="output" height="300px" width="300px" class="rounded-circle border border-primary"/>

                    <div class='row text-center m-auto pt-4'>
                        <h3 class='text-secondary p-0 m-0'>Upload your picture</h3>
                        <p class="p-0 m-0 text-warning mb-3" style="font-size: 10px">Upload picture for identification</p>

                        <div class="w-50 ps-5 mx-auto">
                            <input type="file" accept="image/*" name="picinput" id="picinput" onchange="loadFile(event)">
                            <br>
                            <span class="text-danger">@error('picinput'){{"This Field is required"}}@enderror</span>
                        </div>
                    </div>
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
                        <button type="submit" class="btn btn-outline-success p-4 w-100 shadow-sm">Complete Application</button>
                    </div>
                    <div class="col"></div>
                </div>
            </form>
        </div>
    </div>
    @endsection
