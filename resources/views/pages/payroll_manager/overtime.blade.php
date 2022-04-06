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
                            @foreach ($employeesOvertime as $data)
                                <tr>
                                    <td><img src="{{$data->picture}}" class="rounded-circle" style="height: 100px; width:100px;"></td>
                                    <td>
                                        ID: {{ $data->employee_id }} <br>
                                        {{ $data->fname }} {{ $data->mname }} {{ $data->lname }} <br>
                                        {{ $data->position }}
                                    </td>
                                    <td>{{ $data->department }}</td>
                                    <td>
                                        <h5 class="text-success">{{ $data->Time_in }}</h5>
                                        <h6>Schedule</h6>
                                        <p>{{ $data->schedule_Timein }}</p>
                                    </td>
                                    <td>
                                        <h5 class="text-success">{{ $data->Time_out }}</h5>
                                        <h6>Schedule</h6>
                                        <p>{{ $data->schedule_Timeout }}</p>
                                    </td>
                                    <td>1 hour</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
@endsection
