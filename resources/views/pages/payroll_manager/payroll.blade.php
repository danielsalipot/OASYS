@extends('layout.payroll_app')
    @section('content')
    <div class="row mt-4">
        <div class="col-1" style="width:6vw"></div>
        <div class="col">
            <h1>Payroll Management</h1>

            {{-- CONTROLS --}}
            <div class="row m-4">
                <div class="col-3 text-center border-dark border">
                    <p class="p-2 m-0"> March 15, 2022 - March 30, 2022</p>
                </div>

                <form action="filterSearch" method="POST" class="col-6 d-flex justify-content-center">
                    @csrf

                    {{ Form::hidden('table_name', 'user_details') }}

                    <select id="inputState" name="field_name">
                        <option value="employee_id">Employee ID</option>
                        <option value="fname">First Name</option>
                        <option value="mname">Middle Name</option>
                        <option value="lname">Last Name</option>
                        <option value="rate">Rate</option>
                    </select>
                    <input type="text" name='filter' class="rounded-left ms-1 w-25" placeholder="Search">
                    <button type="submit" class="btn btn-primary rounded-0 rounded-end"><i class="bi bi-search"></i></button>
                </form>

                <div class="col-3 d-flex justify-content-center">
                    <button class="btn w-50 me-1 btn-success">Payroll</button>
                    <button class="btn w-50 ms-1 btn-primary">Payslip</button>
                </div>
            </div>

            <div class="row w-100">
                <table class="table table-striped table-dark w-100">
                    <thead>
                        <tr>
                            <th scope="col">Employee ID</th>
                            <th scope="col">Picture</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Position</th>
                            <th scope="col">Total Hours</th>
                            <th scope="col">Rate/hr</th>
                            <th scope="col">Gross Pay</th>
                            <th scope="col">Deduction</th>
                            <th scope="col">Cash Advance</th>
                            <th scope="col">Net Pay</th>
                        </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                    <tr>
                        <th scope="row">{{$employee->employee_id}}</th>
                        <td><img src="{{$employee->picture}}" class="rounded-circle" style="height: 50px; width:50px;"></td>
                        <td>{{$employee->fname}} {{$employee->mname}} {{$employee->lname}}</td>
                        <td>{{$employee->position}}</td>
                        <td>60 hours</td>
                        <td>₱{{ $employee->rate }}</td>
                        <td>₱100,000</td>
                        <td>₱2,000</td>
                        <td>₱5,000</td>
                        <td>₱50,000</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$employees->links()}}
            </div>
        </div>
    </div>


    @endsection
