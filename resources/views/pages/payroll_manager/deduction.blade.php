@extends('layout.payroll_app')
    @section('content')
        <!-- ======= About Section ======= -->
        <section id="about" class="about">
        <div class="ms-5 ps-5">
            <h1>Deduction Management</h1>

            <div class="row">
                <div class="col">
                    <div class="row p-4">
                        <div class="col-5 d-flex">
                            <input type="text" class="rounded-left w-100" placeholder="Search">
                            <button class="btn btn-primary rounded-0 rounded-end"><i class="bi bi-search"></i></button>
                        </div>
                    <div class="col"></div>
                    <div class="col-3 d-flex">
                        <button class="btn w-100 btn-danger">Delete</button>
                    </div>
                </div>

                <table class="table table-striped table-dark">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Employee Details</th>
                            <th scope="col">Deduction Name</th>
                            <th scope="col">Deduction Date</th>
                            <th scope="col">Deduction Amount</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($employeeDeductions as $record)
                        <tr>
                            <td>
                                {{ $record->employee_id }}<br>
                                {{ $record->fname }} {{ $record->mname }} {{ $record->lname }}<br>
                                {{ $record->position }}
                            </td>
                            <td>{{ $record->deduction_name }}</td>
                            <td>{{ $record->created_at }}</td>
                            <td>{{ $record->deduction_amount }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $employeeDeductions->links() }}
            </div>

            <div class="col-5 border rounded me-4">
                <h1 class="h1 w-100 text-center text-primary p-3">Add new Deduction</h1>
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
                    <h3 class="w-100">Deduction Name</h3>
                    <select id="inputState" name="position" class="border-secondary p-1 w-100 rounded ">
                        <option class="dropdown-item" selected>Teacher</option>
                        <option class="dropdown-item">Staff</option>
                        <option class="dropdown-item">Principal</option>
                    </select>
                    <h3 class="mt-3">Deduction Amount</h3>
                    <input type="text" class="mb-3 p-1 w-100 rounded" placeholder="Amount">
                </div>
                <div class="row text-center ps-5 pe-5 pb-2">
                    <div class="col">
                        <button class="btn btn-success w-75">Save</button>
                    </div>
                    <div class="col">
                        <button class="btn btn-danger w-75">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
