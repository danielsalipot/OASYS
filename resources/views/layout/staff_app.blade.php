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
    @include('inc.loader')

    @if (!session('user_id') || session('user_type') != 'staff')
        {!! '<script>window.location.replace("/logout");</script>' !!}
    @else
        @include('inc.profile')
    @endif

    @include('inc.staff_navbar')

    <div class="row mt-4">
        <div class="col">
            <div class="container">
                @include('inc.alerts.admin_alerts')
                @yield('title')
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
