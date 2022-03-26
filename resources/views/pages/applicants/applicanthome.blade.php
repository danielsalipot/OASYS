@extends('layout.app')
    @section('content')
    <div class='row'>
        <div class ='col p-5'>
            <div class='row m-auto text-primary'>
                <h1 class='h1'>Applicant Dasboard</h1>
            </div>

            <div class='col'>
                <div class='card shadow h-50 m-1 border border-primary rounded p-4 mb-4'>
                    <div class='row'>
                        <div class='col-4'>
                            <img style='height:200px; width:200px;' class='shadow rounded-circle' src="{{$user->picture}}">
                        </div>
                        <div class='col'>
                            <div class='row text-primary'>
                                <h1 class="h4">Full Name</h1>
                                <p class='h3 text-justify text-secondary' name='name'>{{$user->fname}} {{$user->mname}} {{$user->lname}}</p>
                            </div>
                            <div class='row text-left text-primary'>
                                <div class='col'>
                                    <p class="h4">Sex</p>
                                    <p class='h3 text-justify text-secondary' name='sex'>{{$user->sex}}</p>
                                </div>
                                <div class='col'>
                                    <p class="h4">Age</p>
                                    <p class='h3 text-justify text-secondary' name='age'>{{$user->age}}</p>
                                </div>
                                <div class='col-5'>
                                    <p class="h4">Birthday</p>
                                    <p class='h3 text-justify text-secondary' name='age'>{{$user->bday}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>            
                    <div class='row m-auto text-center text-primary pb-2'>
                        <h4>Educational Attainment</h4>
                        <p class='h3 text-justify text-secondary' name='educational'>{{$user->educ}}</p>
                    </div>

                    <div class='row m-auto text-center text-primary pb-2'>
                        <h4>Contact Number</h4>
                        <p class='h3 text-justify text-secondary' name='cpnum'>{{$user->cnum}}</p>
                    </div>

                    <div class='row m-auto text-center text-primary'>
                        <h4>Email Address</h4>
                        <p class='h3 text-justify text-secondary' name='email'>{{$user->email}}</p>
                    </div> 
                </div>
            </div>

        <div class ='col p-5 pe-3'>
            <div class='p-4'>
            </div>
            <h2 class="text-primary pt-4">Applying for</h2>
            <h2 class="text-secondary pb-4" name='position'>{{$user->Applyingfor}}</h2>  
            

            <div class='card shadow h-50 w-75 bg-white border border-primary mb-4'>
                <div class='row'>
                    <div class='col'>
                        <h2 class="text-center text-white w-100 bg-primary p-2">
                            Notification
                        </h2>
                    </div>
                </div>             
            </div>
            
            <div class='row pt-5'>
                <div class="col">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Delete Application
                      </button>
                </div>
                <div class="col">
                    <a href='/logout' type="submit" class="btn btn-primary w-50 m-1 ps-2 pe-2">LOGOUT</a>
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
            <a href="/deleteApplication" type="button" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>

    @endsection

    