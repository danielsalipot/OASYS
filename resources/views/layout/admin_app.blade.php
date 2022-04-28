<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OASYS</title>

    @include('inc.navincludes')


</head>
<body>
    @if (!session()->has('user_id') && !session()->get('user_type') == 'admin')
        {!! '<script>window.location.replace("/logout");</script>' !!}
    @endif

    @include('inc.admin_navbar')
    @yield('content')


</body>
</html>
