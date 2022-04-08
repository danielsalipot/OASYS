@extends('layout.applicant_app')
    @section('content')
    <div style="overflow-y:hidden; overflow-x:hidden; height:100vh">
    <div class='row'>
        <div class ='col ps-5 pt-3'>
            <div class='col'>
                
                    <div class='row pt-5'>
                        <div class='col-4'>
                            <img style='height:200px; width:200px;' class='shadow rounded-circle'>
                        </div>
                        <div class='col'>
                            <div class='row'>
                                <h1 class="h4">#134455BA3</h1>
                               
                            </div>

                            <div class='row text-left text-secondary'>
                                
                                    <p class="h2">Juan Dela Cruz</p>
                                   
                            </div>

                            <div class='row text-left'>    
                                <p class="h4">Utility Staff</p>
                            </div>

                            <div class='row text-left'>    
                                <p class="h3">Regular Employee</p>
                            </div>
                            <div class="row">
                                <a href="" class="btn btn-primary w-50 text-left"> Download Resume </a>
                            </div>
                        </div>
                    </div>
                
                <div class="row">
                    <div class="col">
                        <div class='row text-primary p-5 table-responnsive-sm '>
                            <div class='card shadow h-50 m-4 border border-secondary rounded p-4'>
                            <table class="table">
                        {{-- //Calendar --}}
                                <h1>Time Card</h1>
                                <thead>
                                  <tr>
                                    <th scope="col">Deduction Name</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <th scope="row">Car Loan</th>
                                    <td>12,000</td>
                                    <td>Otto</td>
                                    
                                  </tr>
                                  <tr>
                                    <th scope="row">Pag-ibig</th>
                                    <td>3,000</td>
                                    <td>Thornton</td>
                      
                                  </tr>
                                  <tr>
                                    <th scope="row">Phil Health</th>
                                    <td>5,000</td>
                                    <td>the Bird</td>             
                                  </tr>
                                </tbody>
                              </table>          
                        </div>   
                    </div>  
                    </div>
               
                </div>            
                    
                </div>
            </div>

        <div class ='col text-center '>
            <div class='row m-auto text-secondary pt-5'>
                <h1 class='h1'>Performance Dasboard</h1>
                <div class='col'>
                    <h4>Attendance</h4>
                    <img style='height:75px; width:75px;' class='shadow rounded-circle'>
                </div>
                <div class='col'>
                    <h4>Character</h4>
                    <img style='height:75px; width:75px;' class='shadow rounded-circle'>
                </div>
                <div class='col'>
                    <h4>Performance</h4>
                    <img style='height:75px; width:75px;' class='shadow rounded-circle'>
                </div>
                <div class='col'>
                    <h4>Cooperation</h4>
                    <img style='height:75px; width:75px;' class='shadow rounded-circle'>
                </div>
                <div class="row pt-3">
                    <a href="" class="btn btn-primary w-50 m-auto"> View Performance History</a>
                </div>

                <div class="row pt-3">
                    <a href="" class="btn btn-danger w-50 m-auto"> Resign</a>
                </div>   
            </div>  
            
            
        </div>
    </div>
    

</div>

    @endsection

    