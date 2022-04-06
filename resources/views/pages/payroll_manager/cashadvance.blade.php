@extends('layout.payroll_app')
    @section('content')
        <!-- ======= About Section ======= -->
        <section id="about" class="about">
        <div class="ms-5 ps-5">
            <h1>Employee Cash Advance</h1>

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
                        <th scope="col">Employee Details</th>
                        <th scope="col">Department</th>
                        <th scope="col">Cash Advance Date</th>
                        <th scope="col">Cash Advance Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                      </tr>
                      <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                      </tr>
                      <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="d-flex justify-content-end pt-5">
                    <button class="btn w-25 btn-danger">Delete</button>
                </div>
            </div>

            <div class="col-5 border rounded me-4">
                <h1 class="h1 w-100 text-center text-primary p-3">Add new Record</h1>
                <div class="d-flex w-50 m-auto">
                    <input type="text" class="rounded-left w-100" placeholder="Search">
                    <button class="btn btn-primary rounded-0 rounded-end"><i class="bi bi-search"></i></button>
                </div>
                <div class="row p-5">
                    <div class="col">
                        <img src="pictures/1.png" style="height: 150px; width:150px">
                    </div>
                <div class="col">
                    <h2>Name</h2>
                    <h5>Employee ID</h5>
                    <h5>Employee Position</h5>
                    <h5>Employment Status</h5>
                </div>

                <div class="ps-5 pe-5 pt-4">
                    <h3 class="w-100">Cash Advance Amount</h3>
                    <input type="text" class="mb-3 p-1 w-100 rounded" placeholder="Cash Advance Amount">
                </div>
                <div class="row text-center ps-5 pe-5 pb-2">
                    <div class="col pt-5">
                        <button class="btn btn-success w-75">Add</button>
                    </div>
                    <div class="col pt-5">
                        <button class="btn btn-danger w-75">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
