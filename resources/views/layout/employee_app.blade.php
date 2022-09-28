<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OASYS</title>
</head>
<body>
    @if (!session('user_id') || session('user_type') != 'employee')
        {!! '<script>window.location.replace("/logout");</script>' !!}
    @endif

    @include('inc.datatables')
    @include('inc.navIncludes')
    @include('inc.employee_navbar')
    <div class="row mt-4">
        <div class="col w-100">
            <div class="mx-auto ps-5" style="width: 90vw">
                @include('inc.alerts.employee_alerts')
                @yield('content')
            </div>
        </div>
    </div>

    @yield('script')
</body>
</html>
