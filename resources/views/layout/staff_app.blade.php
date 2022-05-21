<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OASYS</title>

    @include('inc.datatables')
    @include('inc.navIncludes')
</head>
<body style="overflow-x:hidden;">
    @if (!session()->has('user_id') && !session()->get('user_type') == 'staff')
        {!! '<script>window.location.replace("/logout");</script>' !!}
    @endif

    @include('inc.profile')
    @include('inc.staff_navbar')

    <div class="row mt-4">
        <div class="col-1" style="width:6vw"></div>
        <div class="col">
            <div class="container">
                @yield('title')
                @if(Session::get('success'))
                    <div class="alert alert-success w-100 m-auto my-3">{{Session::get('success')}}</div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    @yield('modal')

@yield('script')
</body>
<link rel="stylesheet" type="text/css" href="/datetimepicker-master/jquery.datetimepicker.css">
<script src="/datetimepicker-master/build/jquery.datetimepicker.full.min.js"></script>
</html>
