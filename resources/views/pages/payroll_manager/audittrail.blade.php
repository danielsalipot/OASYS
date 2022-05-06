@extends('layout.payroll_app')

@section('title')
    <h1 class="section-title mt-5 pb-5">Audit Trail</h1>
@endsection

@section('content')
<div class="container w-100 p-2">
    <table class="table table-striped table-dark text-center w-100" id="employee_table">
        <thead>
            <tr class="text-center">
                <th scope="col">Employee ID</th>
                <th scope="col">Picture</th>
                <th scope="col">Employee Details</th>
                <th scope="col">Department</th>
                <th scope="col">Position</th>
                <th scope="col">Rate/hr</th>
                <th scope="col">Start Date</th>
                <th scope="col">Employement <br>Status</th>
                <th scope="col">Edit</th>
            </tr>
        </thead>
    </table>
</div>
@endsection
