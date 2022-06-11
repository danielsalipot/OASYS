<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OASYS</title>
</head>
<body>
    @if (!session()->has('user_id') && !session()->get('user_type') == 'employee')
        {!! '<script>window.location.replace("/logout");</script>' !!}
    @endif

    @include('inc.navincludes')
    @include('inc.employee_navbar')
    @include('inc.alerts.employee_alerts')
    @yield('content')

</body>
</html>
