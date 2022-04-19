@extends('layout.payroll_app')
    @section('content')
        <!-- ======= About Section ======= -->
        <section id="about" class="about">
        <div class="ms-5 ps-5">
            <h1 class="section-title mt-5 pb-5">Deductions</h1>

            <div class="row">
                <div class="col">
                    <div class="row p-4">
                        <div class="col-5 d-flex">
                            <input type="text" class="rounded-left w-100" placeholder="Search">
                            <button class="btn btn-primary rounded-0 rounded-end"><i class="bi bi-search"></i></button>
                        </div>
                    <div class="col"></div>
                   
                </div>

                <table class="table table-striped table-dark">
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

            <div class="col-5 border rounded me-4">
                <h1 class="h1 w-100 text-center text-primary p-3">Add new</h1>
                <div class="d-flex w-50 m-auto">
              
                </div>  
                <div class="ps-5 pe-5 pt-4">
                    <h3 class="w-100">Deduction Name</h3>
                    <input type="text" class="mb-3 p-1 w-100 rounded" placeholder="Position Name">
                    <h3 class="w-100">Deduction Amount</h3>
                    <input type="text" class="mb-3 p-1 w-100 rounded" placeholder="Deduction Amount">
                </div>
                <div class="row text-center ps-5 pe-5 pb-2">
                    <div class="col pt-5">
                        <button class="btn btn-success w-75">Save</button>
                    </div>
                    <div class="col pt-5">
                        <button class="btn btn-danger w-75">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
