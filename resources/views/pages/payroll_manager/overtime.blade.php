@extends('layout.payroll_app')
    @section('content')
        <!-- ======= About Section ======= -->
        <section id="about" class="about">
            <div class="container">
                <h1>Overtime Management</h1>

                <div class="row p-4">
                    <div class="col-3 d-flex justify-content-center">
                        <button class="btn w-75 btn-primary me-1">Pay Overtime</button>
                        <button class="btn w-75 btn-danger ms-1">Reject</button>
                    </div>
                    <div class="col-3 d-flex"></div>
                    <div class="col-3 d-flex">
                        <input type="text" class="rounded-left w-100" placeholder="Search">
                        <button class="btn btn-primary rounded-0 rounded-end"><i class="bi bi-search"></i></button>
                    </div>
                    <div class="col-3 d-flex">
                        <select id="inputState" name="position" class="border-secondary p-1 w-100 rounded ">
                            <option class="dropdown-item" selected>Monday, March 14, 2022</option>
                            <option class="dropdown-item">Tuesday, March 15, 2022</option>
                            <option class="dropdown-item">Wednesday, March 16, 2022</option>
                        </select>
                    </div>
                </div>

                <div class="card shadow border border-secondary p-2">
                    <table class="table table-striped table-dark">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">Picture</th>
                                <th scope="col">Employee Details</th>
                                <th scope="col">Department</th>
                                <th scope="col">Time in</th>
                                <th scope="col">Time out</th>
                                <th scope="col">Total Overtime Hours</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr>
                                <td><img src="pictures/1.png" class="rounded-circle" style="height: 100px; width:100px;"></td>
                                <td>
                                    ID: 123 <br>
                                    Juan Dela Cruz <br>
                                    Architect
                                </td>
                                <td>Marketing Department</td>
                                <td>
                                    <h5 class="text-success">6:56</h5>
                                    <h6>Schedule</h6>
                                    <p>7:00 am</p>
                                </td>
                                <td>
                                    <h5 class="text-success">8:00</h5>
                                    <h6>Schedule</h6>
                                    <p>7:00pm</p>
                                </td>
                                <td>1 hour</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
@endsection
