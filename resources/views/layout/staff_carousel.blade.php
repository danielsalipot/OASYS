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
    @if (!session()->has('user_id') && !session()->get('user_type') == 'payroll')
        {!! '<script>window.location.replace("/logout");</script>' !!}
    @endif

    @include('inc.profile')

    @include('inc.staff_navbar')
    <div class="row mt-5">
        <div class="col-1" style="width:6vw"></div>
        <div class="col">
            <div class="container">
            @yield('Title')
            @if(Session::get('success'))
                <div class="alert alert-success w-100 m-auto my-3">{{Session::get('success')}}</div>
            @endif

            <div id="myCarousel" class="carousel carousel-dark slide" data-interval="false" data-ride="carousel">

                <a class="carousel-control-prev" href="#myCarousel" style="height:0px;margin-top:55px;margin-left:20vw" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#myCarousel" style="height:0px;margin-top:55px;margin-right:20vw" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        @yield('first')
                    </div>

                    @yield('extra')

                    <div class="item">
                        @yield('second')
                    </div>
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
