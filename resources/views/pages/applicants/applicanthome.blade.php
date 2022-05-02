@extends('layout.applicant_app')
    @section('content')

    @if (!session()->has('user_id') && !session()->get('user_type') == 'applicant')
        {!! '<script>window.location.replace("/logout");</script>' !!}
    @endif

    <div style="overflow-y:hidden; overflow-x:hidden; height:100vh">
    <div class='row'>
        <div class ='col ps-5 pt-3'>
            <div class='row m-auto'>
                <h1 class='section-title'>Applicant Dasboard</h1>
            </div>
            <div class='col'>
                <div class='card shadow h-50 m-4 border border-primary rounded p-4'>
                    <div class='row'>
                        <div class='col-4'>
                            <img style='height:200px; width:200px;' class='shadow rounded-circle' src="{{ URL::asset($user->picture)}}">
                        </div>
                        <div class='col'>
                            <div class='row text-primary'>
                                <h1 class="h4">Full Name</h1>
                                <p class='display-6 text-justify text-dark' name='name'>{{$user->fname}} {{$user->mname}} {{$user->lname}}</p>
                            </div>
                            <div class='row text-left text-primary'>
                                <div class='col'>
                                    <p class="h4">Sex</p>
                                    <p class='display-6 text-justify text-dark' name='sex'>{{$user->sex}}</p>
                                </div>
                                <div class='col'>
                                    <p class="h4">Age</p>
                                    <p class='display-6 text-justify text-dark' name='age'>{{$user->age}}</p>
                                </div>
                                <div class='col-6'>
                                    <p class="h4">Birthday</p>
                                    <p class='display-6 text-justify text-dark' name='age'>{{$user->bday}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class='row text-primary pb-2'>
                            <h4>Educational Attainment</h4>
                            <p class='display-6 text-justify text-dark' name='educational'>{{$user->educ}}</p>
                        </div>

                        <div class='row text-primary pb-2'>
                            <h4>Contact Number</h4>
                            <p class='display-6 text-justify text-dark' name='cpnum'>{{$user->cnum}}</p>
                        </div>

                        <div class='row text-primary'>
                            <h4>Email Address</h4>
                            <p class='text-justify text-dark' style="font-size:20px;"name='email'>{{$user->email}}</p>
                        </div>
                    </div>
                    <div class="col text-center">
                        <div class="row">
                            <h2 class="text-primary">Applying for</h2>
                            <h2 class="display-6 text-justify text-dark pb-4" name='position'>{{$user->Applyingfor}}</h2>
                        </div>
                        <div class="row">
                            <a href="/#" class="btn btn-primary w-50 m-auto"> Download Resume </a>
                        </div>
                    </div>
                </div>

                </div>
            </div>

        <div class ='col text-center '>
            <div class='p-5'></div>

            <div style="overflow-y:auto; overflow-x:hidden; height:60vh"  class='m-auto card w-75 shadow bg-white border border-primary'>
                <div class='row'>
                    <div class='col'>
                        <h2 class="text-center text-white w-100 bg-primary p-2">
                            Notification
                        </h2>
                        @foreach ($notif as $item)
                        <div class="card shadow border border-secondary rounded m-2">
                            <h4 class="h6 text-white m-1 rounded bg-secondary p-1">{{$item->message->title}}</h4>
                            <p class="m-1 text-start text-secondary">Date sent: {{$item->message->created_at}}</p>
                            <p class="m-1 text-start">{!!$item->message->message!!}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class='row pt-5 m-auto'>
                <div class="col">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Delete Application
                    </button>
                </div>
                <div class="col">
                    <a href='/logout' type="submit" class="btn btn-primary text-center w-50 m-1 ps-2 pe-2">LOGOUT</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Deletion of Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Do you want to delete your application?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <a href="/applicant/deleteApplication" type="button" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>
</div>

    @endsection

