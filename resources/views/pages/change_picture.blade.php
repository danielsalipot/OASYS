<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OASYS</title>

    <link href="{{ URL::asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css')}} " rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="{{ URL::asset('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css')}}" rel="stylesheet" >

    @include('inc.datatables')
    @include('inc.navIncludes')
</head>
<body style="overflow-x: hidden">
    @if (!session()->has('user_id') && !session()->get('user_type') == 'payroll')
        {!! '<script>window.location.replace("/logout");</script>' !!}
    @endif

    @if (session('user_type') == 'payroll')
        @include('inc.payroll_navbar')
        @include('inc.profile')
    @endif

    @if (session('user_type') == 'staff')
        @include('inc.staff_navbar')
        @include('inc.profile')
    @endif

    @if (session('user_type') == 'admin')
        @include('inc.admin_navbar')
        @include('inc.profile')
    @endif

        @if (session('user_type') == 'employee')
        @include('inc.employee_navbar');
    @endif


    <div class="row mt-4">
        <div class="col-1" style="width:6vw"></div>
        <div class="col">
            <div class="container w-100 p-2">
                {{-- Title --}}
                <h1 class="section-title mt-5 pb-5">Update Picture</h1>

                <div class="row">
                    <div class="col text-center">
                        <img src="/{{$profile->picture}}" style="object-fit: cover;" class=" border border-5 shadow-lg p-2 rounded-circle" width="400px" height="400px">
                        <h1 class="text-primary m-3">Current Picture</h1>
                    </div>
                    <div class="col-2 text-center">
                        <div class="row" style="padding-bottom:180px"></div>
                        <div class="row">
                            <h1 class="display-1 text-primary"><i class="bi bi-arrow-right"></i></h1>
                        </div>
                        <div class="row" style="padding-bottom:230px"></div>
                        <div class="row">

<form action="/submit_change_picture" method="post" enctype="multipart/form-data">
    @csrf
<button type="submit" class="btn btn-primary p-4 px-5">Save Changes</button>

                        </div>
                    </div>
                    <div class="col text-center">
                        <img src="https://st3.depositphotos.com/23594922/31822/v/600/depositphotos_318221368-stock-illustration-missing-picture-page-for-website.jpg" style="object-fit: cover;" id="output" height="400px" width="400px" class="rounded-circle border border-primary"/>


                        <div class='row m-auto pt-4'>
                            <h5 class='text-primary'>Upload your picture</h5>
                        </div>
<span class="text-danger">@error('user'){{"This Field is required"}}@enderror</span>
<input type="file" accept="image/*" class="mx-auto text-center" name="picinput" id="picinput" onchange="loadFile(event)">
</form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @yield('modal')
    @yield('script')

    {{-- picture preview script--}}
    <script>
        var loadFile = function(event) {
        var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>

    <script src="{{ URL::asset('https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js')}}" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>


