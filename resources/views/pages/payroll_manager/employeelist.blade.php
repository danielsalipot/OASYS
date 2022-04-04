@extends('layout.payroll_app')
    @section('content')
        <!-- ======= About Section ======= -->
        <section id="about" class="about">
          <div class="ms-5 ps-5">
            <h1>Employee List</h1>

            <div class="row p-4">
              <div class="col-3 d-flex">
                <input type="text" class="rounded-left w-100" placeholder="Search">
                <button class="btn btn-primary rounded-0 rounded-end"><i class="bi bi-search"></i></button>
              </div>
              <div class="col"></div>
              <div class="col-2 d-flex">
                <button class="btn w-100 btn-primary">Edit Rate</button>
              </div>
            </div>

            <div class="row w-100">
              <table class="table table-striped table-dark w-100 ">
                <thead>
                  <tr class="text-center">
                    <th scope="col">Employee ID</th>
                    <th scope="col">Picture</th>
                    <th scope="col">Employee Details</th>
                    <th scope="col">Department</th>
                    <th scope="col">Rate/hr</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">Employement Status</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>

                  @foreach ($employees as $employee)
                  <tr class="text-center">
                    <th>{{$employee->employee_id}}</th>
                    <td><img src="{{$employee->picture}}" class="rounded-circle" style="height: 50px; width:50px;"></td>
                    <td>
                      {{$employee->fname}} {{$employee->mname}} {{$employee->lname}} <br>
                      {{$employee->position }}
                    </td>
                    <td>{{$employee->position}}</td>
                    <td>₱{{ $employee->rate }}</td>
                    <td>{{ $employee->created_at }}</td>
                    <td>{{ $employee->employment_status }}</td>
                    <td><a href="" class="btn btn-primary mt-1 p-2">></a></td>
                  </tr>
                  @endforeach

                </tbody>
              </table>
              {{$employees->links()}}
            </div>
          </div>
        </div>
          </div>
@endsection
 