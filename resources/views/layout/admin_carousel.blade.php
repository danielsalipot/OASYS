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
    @include('inc.admin_navbar')
    <div class="row">
        <div class="col-1" style="width:6vw"></div>
        <div class="col">
          @yield('title')

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
                <div class="item">
                    @yield('second')
                </div>
            </div>
        </div>

        </div>
    </div>




 <script src="{{ URL::asset('https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js')}}" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
