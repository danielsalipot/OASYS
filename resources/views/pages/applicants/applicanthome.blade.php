@extends('layout.applicant_app')
@include('inc.datatables')

    @section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <style>
        body{
            background-color: #ffffff;
        }
    </style>
    @if (!session()->has('user_id') && !session()->get('user_type') == 'applicant')
        {!! '<script>window.location.replace("/logout");</script>' !!}
    @endif

    <div class='row' style="z-index: -100">
        <div class="p-5"></div>
        <div class="row mt-5">
            <div class="col text-center">
                <img style='height:250px; width:250px; ' class='rounded-circle border' src="{{ URL::asset($user->picture)}}">
                <div class="card w-50 shadow-sm mx-auto rounded-0 rounded-top" style="margin-top:-100px; z-index:-999;">
                    <div class="p-5"></div>
                    <div class="p-4"></div>
                    <div class='row text-secondary'>
                        <p class='display-6 p-4 pb-2 w-100 text-dark' name='name'>{{$user->fname}} {{$user->mname[0] . '.'}} {{$user->lname}}</p>
                        <hr class="w-75 mx-auto "><br><br>

                        <div class='row w-75 text-center mb-2 mx-auto text-secondary' >
                            <div class='col'>
                                <p class="h6">Gender</p>
                                <p class=' text-dark' name='sex'>{{$user->sex}}</p>
                            </div>
                            <div class='col'>
                                <p class="h6">Age</p>
                                <p class=' text-dark' name='age'>{{$user->age}}</p>
                            </div>
                            <div class='col'>
                                <p class="h6">Birthday</p>
                                <p class=' text-dark' name='age'>{{$user->bday}}</p>
                            </div>
                        </div>

                        <div class='row w-75 text-center mb-2 mx-auto text-secondary' >
                            <div class='col'>
                                <p class="h6">Email Address</p>
                                <p class=' text-dark' name='sex'>{{$user->email}}</p>
                            </div>
                            <div class='col'>
                                <p class="h6">Contact Number</p>
                                <p class=' text-dark' name='age'>{{$user->cnum}}</p>
                            </div>
                        </div>
                    </div>
                    <hr class="w-75 mx-auto">
                    <div class="row p-3 my-1">
                        <h2 class="text-secondary h6 p-0 m-0">Applying for</h2>
                        <h2 class="display-6 text-center text-secondary pb-4" name='position'>{{$user->Applyingfor}}</h2>
                    </div>
                </div>
                <div class="row w-50 p-0 m-0 mx-auto">
                    <div class="col p-0">
                        <a href='/logout' type="submit" class="btn btn-outline-primary py-3 w-100 rounded-0 rounded-bottom">Logout</a>

                    </div>
                    <div class="col-4 p-0">
                        <button type="button" class="btn btn-danger w-100 m-auto py-3 rounded-0 rounded-bottom" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Delete Application
                        </button>
                    </div>
                </div>

                <div class="p-4"></div>

                <div class="ms-4">
                    <h5 class="text-center w-100 bg-light shadow-sm border p-3 rounded-top m-0">
                        Notification
                    </h5>
                    <div style="overflow-y:auto; overflow-x:hidden; height:320px"  class='m-auto card shadow-sm  border border-light rounded bottom'>
                        <div class='row'>
                            <div class='col'>
                                @if (count($notif))
                                    @foreach ($notif as $item)
                                    <div class="card shadow border border-secondary rounded m-2">
                                        <h6 class="h6 alert alert-light rounded-0 rounded-top m-0">{{$item->message->title}}</h6>
                                        <div class="w-100 shadow-sm m-0 py-2">
                                            <h6 class="m-0 mx-1 text-start text-dark px-1" style="font-size:13px">From: {{ $item->sender->fname }} {{ $item->sender->mname }} {{ $item->sender->lname }}</h6>
                                            <h6 class="m-0 mx-1 text-start text-secondary px-1" style="font-size:13px">Date sent: {{$item->message->created_at}}</h6>
                                            <hr class="my-2">
                                            <h6 class="text-decoration-none m-0 mx-1 text-dark text-secondary px-1 my-0">{!!$item->message->message!!}</h6>
                                        </div>

                                        {!! Form::open(['action'=>'App\Http\Controllers\PagesController@notification_acknowledgement_insert','method'=>'GET']) !!}
                                        {!! Form::hidden('notif_receiver_id', $item->id) !!}
                                        @if ($item->acknowledgements > 0)
                                        {!! Form::submit('Acknowledgement Sent', ['disabled',"class"=>"btn btn-success rounded-0 w-100 rounded-bottom"]) !!}
                                        @else
                                        {!! Form::submit('Send Acknowledgement', ["class"=>"btn btn-outline-primary rounded-0 w-100 rounded-bottom"]) !!}
                                        @endif
                                        {!! Form::close() !!}
                                    </div>
                                    @endforeach
                                @else
                                    <div class="p-4"></div>
                                    <h1 class="w-100 text-center my-5 text-light" style="font-size:120px"><i class="bi bi-bell-slash"></i></h1>
                                    <h4 class=" text-light w-100 text-center"> No Notifications Yet</h4>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col p-4">
                <div class="mx-5">
                    <h4 class="alert-light w-100 p-4 shadow-lg text-center rounded-top m-0">Resume</h4>
                    <div class="p-3 rounded-bottom alert-light shadow-sm">
                        <embed src="/{{$user->resume}}" class="w-100" height="880px" />
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="staticBackdropLabel">Deletion of Account</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-5">
                <div class="display-1 text-warning m-3" style="font-size: 150px"><i class="bi bi-cone-striped"></i></div>
                <div class="display-6 m-3">Do you want to delete your application?</div>
            </div>
            <div class="modal-footer">
                <div class="row w-100">
                    <div class="col text-end">
                        <a href="/applicant/deleteApplication" type="button" class="btn btn-outline-danger p-3 w-75">Delete Application</a>
                    </div>
                    <div class="col text-start">
                        <button type="button" class="btn btn-outline-light text-dark shadow-sm p-3 w-75" data-bs-dismiss="modal">Cancel Deletion</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
