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
    @yield('style')
</head>

<body>
    @if (!session()->has('user_id') && !session()->get('user_type') == 'payroll')
        {!! '<script>window.location.replace("/logout");</script>' !!}
    @endif

    @if(session()->get('user_type') == 'payroll')
        @include('inc.payroll_navbar')
    @endif
    @if(session()->get('user_type') == 'staff')
        @include('inc.staff_navbar')
    @endif
    @if(session()->get('user_type') == 'admin')
        @include('inc.admin_navbar')
    @endif

    @if(session()->get('user_type') == 'employee')
        @include('inc.employee_navbar')
    @endif

    <div class="row mt-4">
        <div class="col-1" style="width:6vw"></div>
        <div class="col">
            <div class="container w-100 p-2">
            <div class="row m-5 p-5"></div>

            @if (session('confirmation'))
                <h5 class="alert-danger p-3 rounded w-75 mx-auto shadow-sm">{{ session('confirmation') }}</h1>
            @endif

            @if (session('incorrect'))
                <h5 class="alert-danger p-3 rounded w-75 mx-auto shadow-sm">{{ session('incorrect') }}</h1>
            @endif

            @if (session('success'))
                <h5 class="alert-success p-3 rounded w-75 mx-auto shadow-sm">{{ session('success') }}</h1>
            @endif

            <form action="/changePassword" method="POST">
                @csrf
                <div class="card w-75 mx-auto">
                    <div class="row mb-5 w-100 mx-auto">


                        <div class="alert-primary w-100 p-3 h3">Change Password</div>
                        <div class="row p-4">
                            <div class="col">
                                <div class="alert-light w-100 p-1 h6">Current Password</div>
                                <input type="password" name="currentpass" class="form-control" value="">
                                <span class="text-danger">@error('currentpass'){{$message}}@enderror</span>
                            </div>
                            <div class="col">
                            </div>
                        </div>
                        <div class="row p-4">
                            <div class="col">
                                <div class="alert-light w-100 p-1 h6">New Password</div>
                                <input type="password" name="newpass" class="form-control" value="">
                                <span class="text-danger">@error('currentpass'){{$message}}@enderror</span>
                            </div>
                            <div class="col">
                                <div class="alert-light w-100 p-1 h6">Re-enter New Password</div>
                                <input type="password" name="confirmpass" class="form-control" value="">
                                <span class="text-danger">@error('currentpass'){{$message}}@enderror</span>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col">
                                <button type="submit" class="btn btn-success w-100 btn-lg p-3">Confirm Changes</button>
                            </div>
                            <div class="col"></div>
                            <div class="col">
                                <button type="button" class="btn btn-danger w-100 btn-lg p-3" onclick="location.reload()">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ URL::asset('https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js')}}" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>
