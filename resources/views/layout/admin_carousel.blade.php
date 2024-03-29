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
    @if (!session('user_id') || session('user_type') != 'admin')
        {!! '<script>window.location.replace("/logout");</script>' !!}
    @else
        @include('inc.profile')
    @endif

    @include('inc.admin_navbar')
    <div class="row mt-2">
        <div class="col-1" style="width:6vw"></div>
        <div class="col">
            <div class="container p-0 mx-auto w-100">
            @yield('title')

            <ul class="nav nav-tabs">
                @yield('controls')
            </ul>

            <div class="tab-content">
                <div id="home" class="tab-pane in active">
                    <div class="container p-5 bg-white border shadow-lg">
                        @yield('first')
                    </div>
                </div>
                <div id="menu1" class="tab-pane">
                    <div class="container p-5 border bg-white shadow-lg">
                        @yield('second')
                    </div>
                </div>
                <div id="menu2" class="tab-pane">
                    @yield('third')
                </div>
            </div>
        </div>
    </div>

@yield('script')
<script src="{{ URL::asset('https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js')}}" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
