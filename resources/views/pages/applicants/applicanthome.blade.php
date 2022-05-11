@extends('layout.applicant_app')
    @section('content')

    @if (!session()->has('user_id') && !session()->get('user_type') == 'applicant')
        {!! '<script>window.location.replace("/logout");</script>' !!}
    @endif

    <div class="row w-100 p-4"></div>
    <div class='row m-3 card shadow-sm'>
        <div class='row m-auto'>
            <h1 class='section-title W-100 py-3 text-center'>Applicant Dasboard</h1>
        </div>

        <hr>

        <div class="row">
            <div class ='col'>
                <div class="row">
                    <div class="col-4">
                        <img style='height:200px; width:200px;' class='rounded shadow-lg m-3' src="{{ URL::asset($user->picture)}}">
                    </div>
                    <div class="col card shadow-sm my-3 p-3">
                        <div class='row text-secondary'>
                            <h1 class="h6">Full Name</h1>
                            <p class='h3 w-100 text-dark' name='name'>{{$user->fname}} {{$user->mname}} {{$user->lname}}</p>
                        </div>

                        <hr>

                        <div class='row text-left text-secondary'>
                            <div class='col'>
                                <p class="h6">Sex</p>
                                <p class='h3 text-dark' name='sex'>{{$user->sex}}</p>
                            </div>
                            <div class='col'>
                                <p class="h6">Age</p>
                                <p class='h3 text-dark' name='age'>{{$user->age}}</p>
                            </div>
                            <div class='col-6'>
                                <p class="h6">Birthday</p>
                                <p class='h3 text-dark' name='age'>{{$user->bday}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row card shadow mx-3 w-100 mb-5">
                    <h4 class='p-3 w-100 text-center alert-primary'>Applicant Details</h4>

                    <div class="row">
                        <div class="col">
                            <div class="p-4">
                                <div class='row text-secondary pb-2'>
                                    <h6>Educational Attainment</h6>
                                    <p class='h3 text-justify text-dark' name='educational'>{{$user->educ}}</p>
                                </div>

                                <div class='row text-secondary pb-2'>
                                    <h6>Contact Number</h6>
                                    <p class='h3 text-justify text-dark' name='cpnum'>{{$user->cnum}}</p>
                                </div>

                                <div class='row text-secondary'>
                                    <h6>Email Address</h6>
                                    <p class='h3 text-justify text-dark' style="font-size:20px;"name='email'>{{$user->email}}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="p-4">
                                <div class="row text-center w-100">
                                    <h2 class="text-secondary h6">Applying for</h2>
                                    <h2 class="display-6 text-justify text-dark pb-4" name='position'>{{$user->Applyingfor}}</h2>
                                </div>
                                <div class="row text-center w-100">
                                    <h2 class="text-secondary h6">View Submitted Resume</h2>
                                    {!! Form::open(['action'=>'App\Http\Controllers\PagesController@display_resume','method'=>'GET','target'=>'_blank']) !!}
                                    {!! Form::hidden('path',$user->resume) !!}
                                    {!! Form::submit('View Resume', ["class"=>"btn btn-outline-primary m-auto"]) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class ='col'>
                <div style="overflow-y:auto; overflow-x:hidden; height:50vh;width:650px"  class='m-auto card shadow bg-white border border-primary'>
                    <div class='row'>
                        <div class='col'>
                            <h2 class="text-center text-white w-100 bg-primary p-2">
                                Notification
                            </h2>
                            @if (count($notif))
                                @foreach ($notif as $item)
                                <div class="card shadow border border-secondary rounded m-2">
                                    <h4 class="h6 alert alert-primary rounded-0 rounded-top">{{$item->message->title}}</h4>
                                    <h6 class="m-0 mx-1 text-start text-secondary px-1">Date sent: {{$item->message->created_at}}</h6>
                                    <h6 class="text-decoration-none m-0 mx-1 text-dark text-secondary px-1">{!!$item->message->message!!}</h6>
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
                                <h6 class="display-6 text-secondary w-100 text-center"> No Notifications</h6>
                            @endif

                        </div>
                    </div>
                </div>

                <div class='row mt-5 mx-4 m-auto border rounded'>
                    <h4 class='p-1 w-100 text-center alert-info'>Actions</h4>

                    <div class="row py-3">
                        <div class="col"></div>
                        <div class="col-4">
                            <button type="button" class="btn btn-outline-danger w-100 py-2 m-auto" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                Delete Application
                            </button>
                        </div>
                        <div class="col"></div>
                        <div class="col-4">
                            <a href='/logout' type="submit" class="btn btn-primary py-2 w-100">Logout</a>
                        </div>
                        <div class="col"></div>
                    </div>

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

    @endsection
