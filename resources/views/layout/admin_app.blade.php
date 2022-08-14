<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OASYS</title>

    @include('inc.datatables')
    @include('inc.navincludes')
</head>
<body>
    @if (!session()->has('user_id') && !session()->get('user_type') == 'admin')
        {!! '<script>window.location.replace("/logout");</script>' !!}
    @endif

    @include('inc.profile')

    @include('inc.admin_navbar')
    <div class="row">
        <div class="col-1" style="width:6vw"></div>
        <div class="col">
            @include('inc.alerts.admin_alerts')
            <div class="mx-4">
                @yield('content')
            </div>
        </div>
    </div>


    @yield('script')
</body>
</html>
