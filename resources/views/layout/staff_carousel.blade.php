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

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css">
</head>

<body>
    @if (!session('user_id') || session('user_type') != 'staff')
        {!! '<script>window.location.replace("/logout");</script>' !!}
    @else
        @include('inc.profile')
    @endif

    @include('inc.staff_navbar')
    <div class="row mt-5">
        <div class="col-1" style="width:6vw"></div>
        <div class="col">
            <div class="container">
                @include('inc.alerts.admin_alerts')
                @yield('Title')

                <ul class="nav nav-tabs">
                    @yield('controls')
                </ul>

                <div class="tab-content">
                    <div id="home" class="tab-pane in active">
                        <div class="container p-5 border shadow-lg">
                            @yield('first')
                        </div>
                    </div>
                    <div id="menu1" class="tab-pane">
                        <div class="container p-5 border shadow-lg">
                            @yield('second')
                        </div>
                    </div>
                    <div id="menu2" class="tab-pane">
                        @yield('third')
                    </div>
                    @yield('fourth')
                </div>
            </div>
        </div>
    </div>

    @yield('modal')
    @yield('script')
    <link rel="stylesheet" type="text/css" href="/datetimepicker-master/jquery.datetimepicker.css">
    <script src="/datetimepicker-master/build/jquery.datetimepicker.full.min.js"></script>
    <script src="{{ URL::asset('https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js')}}" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>
