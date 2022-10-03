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
    @include('inc.loader')

    @if (!session('user_id') || session('user_type') == 'employee' || session('user_type') == 'applicant' )
        {!! '<script>window.location.replace("/logout");</script>' !!}
    @else
        @include('inc.profile')
    @endif

    @if (session('user_type') == 'payroll')
        @include('inc.payroll_navbar')
    @endif
    @if (session('user_type') == 'staff')
        @include('inc.staff_navbar')
    @endif
    @if (session('user_type') == 'admin')
        @include('inc.admin_navbar')
    @endif

    <div class="row mt-4">
        <div class="col">
            <div class="container w-100">
            @include('inc.alerts.admin_alerts')
            @yield('title')
            @yield('content')
        </div>
    </div>

    @yield('modal')
    @yield('script')



    <script src="{{ URL::asset('https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js')}}" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>
