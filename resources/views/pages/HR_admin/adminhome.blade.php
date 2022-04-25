@extends('layout.admin_app')
    @section('content')
    <div class="row mt-4">
        <div class="col-1" style="width:6vw"></div>
        <div class="col">
            <div class="container w-100 p-1">
            <div class="d-flex">
        <div class="row d-flex pb-2">
            <div class="col text-center alert-success p-3 m-2" style="border:2px; border-radius:25px;">
                    <h4 class="pb-1">Orientation Module</h4>
                    <div class="row">
                        <div class="col m-auto">
                            <small class="ps-5">TOTAL OF VIDEOS</small>
                        </div>
                        <div class="col">
                            <h1 class="pe-5">04</h1>
                        </div>
                    </div>
                    <div class="col">
                        <a class=' h6 text-danger text-decoration-none' ><button class="btn btn-danger rounded-circle m-2 "> <i class="bi bi-plus"></i> </button>EDIT MODULE </a>
                    </div>
            </div>

            <div class="col text-center alert-info p-3 m-2" style="border:2px; border-radius:25px;">
                    <h4>Training Module</h4>
                    <div class="row">
                        <div class="col m-auto">
                            <small class="ps-5">TOTAL OF VIDEOS</small>
                        </div>
                        <div class="col">
                            <h1>10</h1>
                        </div>
                    </div>
                    <div class="col">
                        <a class=' h6 text-danger text-decoration-none' ><button class="btn btn-danger rounded-circle m-2 "> <i class="bi bi-plus"></i> </button>EDIT MODULE </a>
                    </div>
            </div>

            <div class="col text-center alert-danger p-3 m-2" style="border:2px; border-radius:25px;">
                    <h4>Correction Module</h4>
                    <div class="row">
                        <div class="col m-auto">
                            <small class="ps-5">TOTAL OF VIDEOS</small>
                        </div>
                        <div class="col ">
                            <h1>05</h1>
                        </div>
                    </div>
                    <div class="col">
                        <a class=' h6 text-danger text-decoration-none' ><button class="btn btn-danger rounded-circle m-2 "> <i class="bi bi-plus"></i> </button>EDIT MODULE </a>
                    </div>
            </div>
        </div>

        <div class="col border border-dark pt-2">
            <h5 class="text-primary text-center">Regularization Overview</h5>
            <br>
            <div class="row border rounded">
                <div class='col border rounded d-flex align-items-center' style="width:100%;">
                    <img style='height:50px; width:50px;' class='shadow rounded-circle m-3'>
                    <small>Employee Name</small>
                </div>

                <div class='col border rounded  align-items-center' style="width:100%;">
                    <img style='height:50px; width:50px;' class='shadow rounded-circle m-3'>
                    <small>Employee Name</small>
                </div>
                <div class='col border rounded d-flex align-items-center' style="width:100%;">
                    <img style='height:50px; width:50px;' class='shadow rounded-circle m-3'>
                    <small>Employee Name</small>
                </div>

                </div>
        </div>

            </div>
{{--
        <div class="row">
            <div class="col border border-dark pt-2 w-50">
                <div class="col">
                    <h4 class="text-primary">Attendance Overview</h4>
                </div>
            <div class="col">
                <small>Monday, March 14, 2022</small>
            </div>
            </div>
        </div> --}}

@endsection
