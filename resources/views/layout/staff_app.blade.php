<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OASYS</title>

    @include('inc.navIncludes')

</head>
<body>
    @if (!session()->has('user_id') && !session()->get('user_type') == 'staff')
        {!! '<script>window.location.replace("/logout");</script>' !!}
    @endif

    @include('inc.staff_navbar')
    @yield('content')

</body>
</html>
