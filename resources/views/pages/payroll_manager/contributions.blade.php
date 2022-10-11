@extends('layout.pr_carousel')

@section('Title')
    <h1 class="section-title mt-4 pb-1 text-center w-100">Employee Contributions</h1>
@endsection


@section('controls')

    <li class="active"><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#home">SSS Contribution</a></li>
    <li><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#menu1">Pagibig Contribution</a></li>
    <li><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#menu2">Philhealth Contribution</a></li>
@endsection


@section('first')
    <div class="m-auto p-5">
        <div class="row">
            <div class="col-4 card p-0 shadow-sm">
                <h3 class="w-100 text-center alert-primary p-3">SSS Contribution Details</h3>
                {!! Form::open(['action'=>'App\Http\Controllers\Payroll\PayrollUpdateController@edit_sss', 'class'=>'w-100']) !!}
                <div class="row p-4 mx-auto w-100">
                    <div class="row">
                        <div class="col text-center">
                            {!! Form::label('sss_ee_rate', "Employee SSS Rate", []) !!}
                            {!! Form::text('sss_ee_rate',"$sss->employee_contribution",['disabled','id'=>'sss_ee_rate','class'=>'form-control text-center p-3']) !!}
                        </div>
                        <div class="col text-center">
                            {!! Form::label('sss_er_rate', "Employer SSS Rate", []) !!}
                            {!! Form::text('sss_er_rate',"$sss->employer_contribution",['disabled','id'=>'sss_er_rate', 'class'=>'form-control text-center p-3']) !!}
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col text-center">
                            {!! Form::label('sss_low_limit', "Lower Range", []) !!}
                            {!! Form::text('sss_low_limit',"$sss->low_limit",['disabled','id'=>'sss_low_limit','class'=>'form-control text-center p-3']) !!}
                        </div>
                        <div class="col text-center">
                            {!! Form::label('sss_high_limit', "Higher Range", []) !!}
                            {!! Form::text('sss_high_limit',"$sss->high_limit",['disabled','id'=>'sss_high_limit', 'class'=>'form-control text-center p-3']) !!}
                        </div>
                    </div>

                    <div class="row mt-3 ">
                        <div class="col-4 text-center">
                            {!! Form::label('sss_add_low', "Lower Addition", []) !!}
                            {!! Form::text('sss_add_low',"$sss->add_low",['disabled','id'=>'sss_add_low','class'=>'form-control text-center p-3']) !!}
                        </div>
                        <div class="col"></div>
                        <div class="col-4 text-center">
                            {!! Form::label('sss_add_high', "Higher Addition", []) !!}
                            {!! Form::text('sss_add_high',"$sss->add_high",['disabled','id'=>'sss_add_high', 'class'=>'form-control text-center p-3']) !!}
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-row justify-content-center mt-3 p-0 w-100 text-center">
                    <button type="button" id="sss_lock" class="btn btn-outline-primary h-100 px-4 p-3 rounded-0 rounded-start"><i class="bi bi-lock"></i></button>
                    {!! Form::submit('Update SSS Rate', ['disabled','id' =>'sss_update','class'=>'btn btn-success px-5 p-3 w-100 rounded-0']) !!}
                    <button disabled type="button" id="sss_cancel" class="btn btn-outline-danger h-100 px-4 p-3 rounded-0 rounded-end"><i class="bi bi-x-circle"></i></button>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="col p-0">
                <button  onclick="collapseFunction(this, 'collapseCard1')" class="btn btn-lg mt-1 text-warning" style="position: absolute; z-index:300;"><h4><i class="bi bi-question-diamond-fill"></i> Instructions</h4></button>
                <div id="collapseCard1" class="d-none">
                    <h3 class="w-100 text-center alert-primary p-3">Instructions</h3>
                    <div class="row p-4" style="font-size: 15px">
                        <div class="col">
                            <ul>
                                <li class="p-2">Employees must contribute {{$sss->employee_contribution + $sss->employer_contribution}}% of their monthly wage credit (MSC).</li>
                                <li class="p-2">Currently the employee pays {{$sss->employee_contribution}}% of the total contribution (<b>Employee SSS Rate</b>)</li>
                                <li class="p-2">Currently the business contributes {{$sss->employer_contribution}}% of the total contribution of employee (<b>Employer SSS Rate</b>). </li>
                            </ul>
                        </div>
                        <div class="col">
                            <ul>
                                <li class="p-2" >A little payment to the Employee Compensation Program is also included in the overall contribution.</li>
                                <li class="p-2" >For MSCs up to ₱{{ $sss->low_limit }} (<b>Lower Range</b>) the total payment is ₱10.00  (<b>Lower Addition</b>)</li>
                                <li class="p-2" >For an MSC of ₱{{ $sss->high_limit }} (<b>Higher Range</b>) or more, the total payment is ₱30.00  (<b>Higher Addition</b>)</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>
    <br>

    <div class="row">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#sss_home">Employee Contribution Table</a></li>
            <li><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#sss_manage">Employee Contribution Management</a></li>
        </ul>

        <div class="tab-content w-100 p-0">
            <div id="sss_home" class="tab-pane in active">
                <div class="container p-5 bg-white border shadow-sm">
                    <div class="row">
                        @include('inc.date_filter')
                    </div>
                    <table class="table table-striped w-100 text-center" id="sss_table">
                        <thead>
                            <tr class="text-center">
                                <th class="col">Employee Details</th>
                                <th class="col">Employee Rate</th>
                                <th class="col">Monthly Salary</th>
                                <th class="col">Employee Contribution</th>
                                <th class="col">Employer Contribution</th>
                                <th class="col">Total SSS Contibution</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div id="sss_manage" class="tab-pane">
                <div class="container p-5 border bg-white shadow-sm">
                    <table class="table table-striped  text-center w-100" id="sss_employee_table">
                        <thead>
                            <tr class="text-center">
                                <th class="col">Employee ID</th>
                                <th class="col">Picture</th>
                                <th class="col">Employee Details</th>
                                <th class="col">Department</th>
                                <th class="col-2">Position</th>
                                <th class="col">Rate/hr</th>
                                <th class="col">Employement <br>Status</th>
                                <th class="col-2">Edit</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('second')
    <div class="m-auto p-5">
        <div class="row h-100">
            <div class="col-4 card p-0 shadow-sm">
                <h3 class="w-100 text-center alert-primary p-3">Pagibig Contribution Details</h3>
                {!! Form::open(['action'=>'App\Http\Controllers\Payroll\PayrollUpdateController@edit_pagibig']) !!}
                <div class="row p-4 h-100">
                    <div class="row">
                        <div class="col-4 text-center">
                            {!! Form::label('pagibig_ee_min_rate', "Employee Pagibig Low Rate", []) !!}
                            {!! Form::text('pagibig_ee_min_rate',"$pagibig->ee_min_rate",['disabled','id'=>'pagibig_ee_min_rate','class'=>'form-control text-center p-3']) !!}
                        </div>
                        <div class="col-4 text-center">
                            {!! Form::label('pagibig_ee_max_rate', "Employee Pagibig High Rate", []) !!}
                            {!! Form::text('pagibig_ee_max_rate',"$pagibig->ee_max_rate",['disabled','id'=>'pagibig_ee_max_rate','class'=>'form-control text-center p-3']) !!}
                        </div>
                        <div class="col-4 text-center">
                            {!! Form::label('pagibig_er_rate', "Employer Pagibig Rate", []) !!}
                            {!! Form::text('pagibig_er_rate',"$pagibig->er_rate",['disabled','id'=>'pagibig_er_rate', 'class'=>'form-control text-center p-3']) !!}
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col text-center">
                            {!! Form::label('pagibig_max', "Maximum Contribution", []) !!}
                            {!! Form::text('pagibig_max',"$pagibig->maximum",['disabled','id'=>'pagibig_max','class'=>'form-control text-center p-3']) !!}
                        </div>
                        <div class="col text-center">
                            {!! Form::label('pagibig_divider', "Pagibig Salary Division", []) !!}
                            {!! Form::text('pagibig_divider',"$pagibig->divider",['disabled','id'=>'pagibig_divider','class'=>'form-control text-center p-3']) !!}
                        </div>
                    </div>
                    <div class="p-5"></div>
                    <div class="d-flex flex-row justify-content-center mt-3">
                        <button type="button" id="pagibig_lock" class="btn btn-outline-primary h-100 px-4 p-3 rounded-0 rounded-start "><i class="bi bi-lock"></i></button>
                        {!! Form::submit('Update Pagibig Rate', ['disabled','id' =>'pagibig_update','class'=>'btn btn-success px-5 p-3 w-100 rounded-0']) !!}
                        <button disabled type="button" id="pagibig_cancel" class="btn btn-outline-danger h-100 px-4 p-3 rounded-0 rounded-end"><i class="bi bi-x-circle"></i></button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="col p-0">
                <button  onclick="collapseFunction(this, 'collapseCard2')" class="btn btn-lg mt-1 text-warning" style="position: absolute; z-index:300;"><h4><i class="bi bi-question-diamond-fill"></i> Instructions</h4></button>
                <div id="collapseCard2" class="d-none">
                    <h3 class="w-100 text-center alert-primary p-3">Instructions</h3>
                    <div class="row p-4" style="font-size: 15px">
                        <div class="col">
                            <ul>
                                <li class="p-3"> The Employee share is based on their salary.</li>
                                <li class="p-3">If the employee's salary is lower than ₱{{ $pagibig->divider }} (<b>Pagibig Salary Division</b>) then there share will be {{ $pagibig->ee_min_rate }}% of their salary (<b>Employee Pagibig Low Rate</b>)</li>
                                <li class="p-3">If the employee's salary is Higher than ₱{{ $pagibig->divider }} (<b>Pagibig Salary Division</b>) then there share will be {{ $pagibig->ee_min_rate }}% of their salary (<b>Employee Pagibig Low Rate</b>)</li>
                            </ul>
                        </div>
                        <div class="col">
                            <ul>
                                <li class="p-3">The current Maximum contribution of Pag ibig is ₱{{$pagibig->maximum}} (<b>Maximum Contribution</b>) </li>
                                <li class="p-3">The current Pagibig Employer rate is {{ $pagibig->er_rate }}% (<b>Employer Pagibig Rate</b>)</li>
                                <li class="p-3">The total contribution is the sum of the Employee and Employer shares</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>
    <br>

    <div class="row">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#pagibig_home">Employee Contribution Table</a></li>
            <li><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#pagibig_manage">Employee Contribution Management</a></li>
        </ul>

        <div class="tab-content w-100 p-0">
            <div id="pagibig_home" class="tab-pane in active">
                <div class="container p-5 bg-white border shadow-sm">
                    <div class="row">
                        <div class="row mb-3 mt-3 input-daterange" >
                            <div class="col-md-2">
                                <input type="text" name="pagibig_from_date" id="pagibig_from_date" class="form-control p-3 h-100" placeholder="From Date" readonly />
                            </div>
                            <div class="col-md-2">
                                <input type="text" name="pagibig_to_date" id="pagibig_to_date" class="form-control h-100" placeholder="To Date" readonly />
                            </div>
                            <div class="col-2">
                                <button type="button" name="pagibig_filter" id="pagibig_filter" class="btn h-100 w-25 btn-outline-primary">Filter</button>
                                <button type="button" name="pagibig_refresh" id="pagibig_refresh" class="btn h-100 w-25 btn-outline-success">Refresh</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped text-center w-100" id="pagibig_table">
                        <thead>
                            <tr class="text-center">
                                <th class="col">Employee Details</th>
                                <th class="col">Employee Rate</th>
                                <th class="col">Monthly Salary</th>
                                <th class="col">Employee Contribution</th>
                                <th class="col">Employer Contribution</th>
                                <th class="col">Total Pagibig Contibution</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div id="pagibig_manage" class="tab-pane">
                <div class="container p-5 border bg-white shadow-sm">
                    <table class="table table-striped  text-center w-100" id="pagibig_employee_table">
                        <thead>
                            <tr class="text-center">
                                <th class="col">Employee ID</th>
                                <th class="col">Picture</th>
                                <th class="col">Employee Details</th>
                                <th class="col">Department</th>
                                <th class="col-2">Position</th>
                                <th class="col">Rate/hr</th>
                                <th class="col">Employement <br>Status</th>
                                <th class="col-2">Edit</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('third')
<div class="container p-5 border shadow-lg">
    <div class="m-auto p-5">
        <div class="row">
            <div class="col-4 card p-0 shadow-sm">
                <h3 class="w-100 text-center p-3 alert-primary">Philhealth Contribution Details</h3>
                {!! Form::open(['action'=>'App\Http\Controllers\Payroll\PayrollUpdateController@edit_philhealth']) !!}
                <div class="row p-4">
                    <div class="row">
                        <div class="col text-center">
                            {!! Form::label('philhealth_rate', "Philhealth Rate", []) !!}
                            {!! Form::text('philhealth_rate',"$philhealth->ph_rate",['disabled','id'=>'philhealth_rate','class'=>'form-control text-center p-3']) !!}
                        </div>
                        <div class="col text-center">
                            {!! Form::label('philhealth_min_share', "Philhealth Minimum Share", []) !!}
                            {!! Form::text('philhealth_min_share',"$philhealth->minimum_contribution",['disabled','id'=>'philhealth_min_share','class'=>'form-control text-center p-3']) !!}
                        </div>
                        <div class="col text-center">
                            {!! Form::label('philhealth_max_share', "Philhealth Maximum Share", []) !!}
                            {!! Form::text('philhealth_max_share',"$philhealth->ph_cap",['disabled','id'=>'philhealth_max_share','class'=>'form-control text-center p-3']) !!}
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col text-center">
                            {!! Form::label('philhealth_min', "Philhealth Minimum Range", []) !!}
                            {!! Form::text('philhealth_min',"$philhealth->minimum",['disabled','id'=>'philhealth_min','class'=>'form-control text-center p-3']) !!}
                        </div>
                        <div class="col text-center">
                            {!! Form::label('philhealth_max', "Philhealth Maximum Range", []) !!}
                            {!! Form::text('philhealth_max',"$philhealth->maximum",['disabled','id'=>'philhealth_max', 'class'=>'form-control text-center p-3']) !!}
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col text-center">
                            {!! Form::label('philhealth_ee_rate', "Employee Philhealth Share", []) !!}
                            {!! Form::text('philhealth_ee_rate',"$philhealth->ee_rate",['disabled','id'=>'philhealth_ee_rate','class'=>'form-control text-center p-3']) !!}
                        </div>
                        <div class="col text-center">
                            {!! Form::label('philhealth_er_rate', "Employer Philhealth Share", []) !!}
                            {!! Form::text('philhealth_er_rate',"$philhealth->er_rate",['disabled','id'=>'philhealth_er_rate', 'class'=>'form-control text-center p-3']) !!}
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-row justify-content-center mt-3">
                    <button type="button" id="philhealth_lock" class="btn btn-outline-primary h-100 px-4 p-3 rounded-0 rounded-start"><i class="bi bi-lock"></i></button>
                    {!! Form::submit('Update Philhealth Rate', ['disabled','id' =>'philhealth_update','class'=>'btn btn-success px-5 w-100 p-3 rounded-0']) !!}
                    <button disabled type="button" id="philhealth_cancel" class="btn btn-outline-danger h-100 px-4 p-3 rounded-0 rounded-end"><i class="bi bi-x-circle"></i></button>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="col">
                <button  onclick="collapseFunction(this, 'collapseCard3')" class="btn btn-lg mt-1 text-warning" style="position: absolute; z-index:300;"><h4><i class="bi bi-question-diamond-fill"></i> Instructions</h4></button>

            <script>
                function collapseFunction(btn, id){
                    var collapse = document.getElementById(id)
                    collapse.classList.toggle('d-none')

                    if (btn.innerHTML == '<h4><i class="bi bi-question-diamond-fill"></i> Instructions</h4>') {
                        btn.innerHTML = '<h4><i class="bi bi-question-diamond-fill"></i> Hide</h4>'
                    } else {
                        btn.innerHTML = '<h4><i class="bi bi-question-diamond-fill"></i> Instructions</h4>'
                    }
                }
            </script>

            <div id="collapseCard3" class="d-none">
                <h3 class="w-100 text-center alert-primary p-3">Instructions</h3>
                <div class="row p-4" style="font-size: 15px">
                    <div class="col">
                        <ul>
                            <li class="p-3">The current Philhealth Premium Rate is {{ $philhealth->ph_rate }}% (<b>Philhealth Rate</b>)</li>
                            <li class="p-3">The maximum annual contribution is ₱{{ $philhealth->ph_cap }} (<b>Philhealth Maximum Share</b>)</li>
                            <li class="p-3">If the employee's salary is lower than ₱{{ $philhealth->minimum }} (<b>Philhealth Minimum Range</b>) their contribution will be fixed at ₱400</li>
                        </ul>
                    </div>
                    <div class="col">
                        <ul>
                            <li class="p-3">If the employee's salary is higher than ₱{{ $philhealth->maximum }} (<b>Philhealth Maximum Range</b>) their contribution will be fixed at ₱{{ $philhealth->ph_cap }} (<b>Philhealth Maximum Share</b>)</li>
                            <li class="p-3">The Employee and Employer will split the contribution into {{ $philhealth->ee_rate }}/{{ $philhealth->er_rate }} (<b>Employee Philhealth Share</b> / <b>Employer Philhealth Share</b>)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>
    <br>

    <div class="row">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#philhealth_home">Employee Contribution Table</a></li>
            <li><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#philhealth_manage">Employee Contribution Management</a></li>
        </ul>

        <div class="tab-content w-100 p-0">
            <div id="philhealth_home" class="tab-pane in active">
                <div class="container p-5 bg-white border shadow-sm">
                    <div class="row">
                        <div class="row mb-3 mt-3 input-daterange" >
                            <div class="col-md-2">
                                <input type="text" name="philhealth_from_date" id="philhealth_from_date" class="form-control p-3 h-100" placeholder="From Date" readonly />
                            </div>
                            <div class="col-md-2">
                                <input type="text" name="philhealth_to_date" id="philhealth_to_date" class="form-control h-100" placeholder="To Date" readonly />
                            </div>
                            <div class="col-2">
                                <button type="button" name="philhealth_filter" id="philhealth_filter" class="btn h-100 w-25 btn-outline-primary">Filter</button>
                                <button type="button" name="philhealth_refresh" id="philhealth_refresh" class="btn h-100 w-25 btn-outline-success">Refresh</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped text-center w-100" id="philhealth_table">
                        <thead>
                            <tr class="text-center">
                                <th class="col">Employee Details</th>
                                <th class="col">Employee Rate</th>
                                <th class="col">Monthly Salary</th>
                                <th class="col">Employee Contribution</th>
                                <th class="col">Employer Contribution</th>
                                <th class="col">Total Pagibig Contibution</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div id="philhealth_manage" class="tab-pane">
                <div class="container p-5 border bg-white shadow-sm">
                    <table class="table table-striped  text-center w-100" id="philhealth_employee_table">
                        <thead>
                            <tr class="text-center">
                                <th class="col">Employee ID</th>
                                <th class="col">Picture</th>
                                <th class="col">Employee Details</th>
                                <th class="col">Department</th>
                                <th class="col-2">Position</th>
                                <th class="col">Rate/hr</th>
                                <th class="col">Employement <br>Status</th>
                                <th class="col-2">Edit</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
<script>
    $(document).ready(function(){
        $('.input-daterange').datepicker({
            todayBtn:'linked',
            format:'yyyy-mm-dd',
            autoclose:true
        });

        $('#filter').click(function(){
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            if(from_date != '' &&  to_date != ''){
                $('#sss_table').DataTable().destroy();
                load_sss(from_date, to_date);
            }else{
                alert('Both Date is required');
            }
        });

        $('#refresh').click(function(){
            let { start_date, end_date } = getDateToday();
            $('#from_date').val(start_date);
            $('#to_date').val(end_date);
            $('#sss_table').DataTable().destroy();
            load_sss(start_date,end_date);
        });

        let { start_date, end_date } = getDateToday();
        $('#from_date').val(start_date);
        $('#to_date').val(end_date);
        load_sss(start_date,end_date);

        function load_sss(from_date = '', to_date = ''){
        // SSS TABLE
            $('#sss_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ URL::to("/contributionsjson")}}',
                    data:{
                        from_date: from_date,
                        to_date: to_date
                    }
                },
                columns: [
                    { data: 'fname',
                        render : (data,type,row)=>{
                            return `<h4>${data} ${row.mname} ${row.lname}</h4>
                                ${row.department}<br>
                                ${row.position}`
                        }
                    },
                    { data: 'rate',
                        render : (data,type,row)=>{
                            return `<h5 class="text-dark">₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</h5>`
                        }
                    },
                    { data: 'gross_pay',
                        render : (data,type,row)=>{
                            return `<h5 class="text-success">₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</h5>`
                        }
                    },
                    { data: 'employee_contribution',
                        render : (data,type,row)=>{
                            return `<h5 class="text-danger">₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</h5>`
                        }
                    },
                    { data: 'employer_contribution',
                        render : (data,type,row)=>{
                            return `<h5 class="text-danger">₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</h5>`
                        }
                    },
                    { data: 'total_sss',
                        render : (data,type,row)=>{
                            return `<h5 class="text-success">₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</h5>`
                        }
                    }
                ]
            })
        }


        $('#pagibig_filter').click(function(){
            var from_date = $('#pagibig_from_date').val();
            var to_date = $('#pagibig_to_date').val();
            if(from_date != '' &&  to_date != ''){
                $('#pagibig_table').DataTable().destroy();
                load_pagibig(from_date, to_date);
            }else{
                alert('Both Date is required');
            }
        });

        $('#pagibig_refresh').click(function(){
            let { start_date, end_date } = getDateToday();
            $('#pagibig_from_date').val(start_date);
            $('#pagibig_to_date').val(end_date);
            $('#pagibig_table').DataTable().destroy();
            load_pagibig(start_date,end_date);
        });

        $('#pagibig_from_date').val(start_date);
        $('#pagibig_to_date').val(end_date);
        load_pagibig(start_date,end_date);

        function load_pagibig(from_date = '', to_date = ''){
        // Pagibig TABLE
            $('#pagibig_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/pagibigjson',
                    data:{
                        from_date: from_date,
                        to_date: to_date
                    }
                },
                columns: [
                    { data: 'fname',
                        render : (data,type,row)=>{
                            return `<h4>${data} ${row.mname} ${row.lname}</h4>
                                ${row.department}<br>
                                ${row.position}`
                        }
                    },
                    { data: 'rate',
                        render : (data,type,row)=>{
                            return `<h5 class="text-dark">₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</h5>`
                        }
                    },
                    { data: 'gross_pay',
                        render : (data,type,row)=>{
                            return `<h5 class="text-success">₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</h5>`
                        }
                    },
                    { data: 'employee_pagibig_contribution',
                        render : (data,type,row)=>{
                            return `<h5 class="text-danger">₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</h5>`
                        }
                    },
                    { data: 'employer_pagibig_contribution',
                        render : (data,type,row)=>{
                            return `<h5 class="text-danger">₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</h5>`
                        }
                    },
                    { data: 'total_pagibig_contribution',
                        render : (data,type,row)=>{
                            return `<h5 class="text-success">₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</h5>`
                        }
                    }
                ]
            })
        }

        $('#philhealth_filter').click(function(){
            var from_date = $('#philhealth_from_date').val();
            var to_date = $('#philhealth_to_date').val();
            if(from_date != '' &&  to_date != ''){
                $('#philhealth_table').DataTable().destroy();
                load_philhealth(from_date, to_date);
            }else{
                alert('Both Date is required');
            }
        });

        $('#philhealth_refresh').click(function(){
            let { start_date, end_date } = getDateToday();
            $('#philhealth_from_date').val(start_date);
            $('#philhealth_to_date').val(end_date);
            $('#philhealth_table').DataTable().destroy();
            load_philhealth(start_date,end_date);
        });

        $('#philhealth_from_date').val(start_date);
        $('#philhealth_to_date').val(end_date);
        load_philhealth(start_date,end_date);

        function load_philhealth(from_date = '', to_date = ''){
        // Pagibig TABLE
            $('#philhealth_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/philhealthjson',
                    data:{
                        from_date: from_date,
                        to_date: to_date
                    }
                },
                columns: [
                    { data: 'fname',
                        render : (data,type,row)=>{
                            return `<h4>${data} ${row.mname} ${row.lname}</h4>
                                ${row.department}<br>
                                ${row.position}`
                        }
                    },
                    { data: 'rate',
                        render : (data,type,row)=>{
                            return `<h5 class="text-dark">₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</h5>`
                        }
                    },
                    { data: 'gross_pay',
                        render : (data,type,row)=>{
                            return `<h5 class="text-success">₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</h5>`
                        }
                    },
                    { data: 'employee_philhealth_contribution',
                        render : (data,type,row)=>{
                            return `<h5 class="text-danger">₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</h5>`
                        }
                    },
                    { data: 'employer_philhealth_contribution',
                        render : (data,type,row)=>{
                            return `<h5 class="text-danger">₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</h5>`
                        }
                    },
                    { data: 'total_philhealth_contribution',
                        render : (data,type,row)=>{
                            return `<h5 class="text-success">₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</h5>`
                        }
                    }
                ]
            })
        }
    })

    $(document).ready(function(){
        $('#sss_employee_table').DataTable({
            ajax: {
                    url: '/employeelistjson',
                },
            columns: [
                { data: 'employee_id',
                    render : (data,type,row)=>{
                        return `<b>${data}</b>`
                    }
                },
                { data: 'user_detail.picture',
                    render : (data,type,row)=>{
                        return `<img src="{{ URL::asset('${data}') }}" class="rounded" width="50" height="50">`
                    }
                },
                { data: 'user_detail.fname',
                    render : (data,type,row)=>{
                        return  `
                                    <b>${row.user_detail.fname} ${row.user_detail.mname} ${row.user_detail.lname}</b><br>
                                        Sex: ${row.user_detail.sex}<br>
                                        age: ${row.user_detail.age}
                                `
                    }
                },
                { data: 'department',
                    render : (data,type,row)=>{
                        return `<b>${data}</b>`
                    }
                },
                { data: 'position',
                    render : (data,type,row)=>{
                        return `<b>${data}</b>`
                    }
                },
                { data: 'rate',
                    render : (data,type,row)=>{
                        return `<b class="h5">₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</b>`
                    }
                },
                { data: 'employment_status',
                    render : (data,type,row)=>{
                        return `<b>${data}</b>`
                    }
                },
                { data: 'sss_included',
                    render : (data,type,row)=>{
                        if(data){
                            return `
                            <form action="/updateContributionInclude" method="POST">
                                @CSRF
                                <input type="hidden" name="contribution_type" value="sss">
                                <input type="hidden" name="employee_id" value="${row.employee_id}">
                                <input type="hidden" name="included_value" value="0">
                                <button type="submit" class="btn btn-outline-primary w-100 p-4">Included</button>
                            </form>
                            `
                        }else{
                            return `
                            <form action="/updateContributionInclude" method="POST">
                                @CSRF
                                <input type="hidden" name="contribution_type" value="sss">
                                <input type="hidden" name="employee_id" value="${row.employee_id}">
                                <input type="hidden" name="included_value" value="1">
                                <button type="submit" class="btn btn-outline-warning w-100 p-4">Exempted</button>
                            </form>`
                        }
                    }
                },
            ]
        })
    })

    $(document).ready(function(){
        $('#philhealth_employee_table').DataTable({
            ajax: {
                    url: '/employeelistjson',
                },
            columns: [
                { data: 'employee_id',
                    render : (data,type,row)=>{
                        return `<b>${data}</b>`
                    }
                },
                { data: 'user_detail.picture',
                    render : (data,type,row)=>{
                        return `<img src="{{ URL::asset('${data}') }}" class="rounded" width="50" height="50">`
                    }
                },
                { data: 'user_detail.fname',
                    render : (data,type,row)=>{
                        return  `
                                    <b>${row.user_detail.fname} ${row.user_detail.mname} ${row.user_detail.lname}</b><br>
                                        Sex: ${row.user_detail.sex}<br>
                                        age: ${row.user_detail.age}
                                `
                    }
                },
                { data: 'department',
                    render : (data,type,row)=>{
                        return `<b>${data}</b>`
                    }
                },
                { data: 'position',
                    render : (data,type,row)=>{
                        return `<b>${data}</b>`
                    }
                },
                { data: 'rate',
                    render : (data,type,row)=>{
                        return `<b class="h5">₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</b>`
                    }
                },
                { data: 'employment_status',
                    render : (data,type,row)=>{
                        return `<b>${data}</b>`
                    }
                },
                { data: 'philhealth_included',
                    render : (data,type,row)=>{
                        if(data){
                            return `
                            <form action="/updateContributionInclude" method="POST">
                                @CSRF
                                <input type="hidden" name="contribution_type" value="philhealth">
                                <input type="hidden" name="employee_id" value="${row.employee_id}">
                                <input type="hidden" name="included_value" value="0">
                                <button type="submit" class="btn btn-outline-primary w-100 p-4">Included</button>
                            </form>
                            `
                        }else{
                            return `
                            <form action="/updateContributionInclude" method="POST">
                                @CSRF
                                <input type="hidden" name="contribution_type" value="philhealth">
                                <input type="hidden" name="employee_id" value="${row.employee_id}">
                                <input type="hidden" name="included_value" value="1">
                                <button type="submit" class="btn btn-outline-warning w-100 p-4">Exempted</button>
                            </form>`
                        }
                    }
                },
            ]
        })
    })

    $(document).ready(function(){
        $('#pagibig_employee_table').DataTable({
            ajax: {
                    url: '/employeelistjson',
                },
            columns: [
                { data: 'employee_id',
                    render : (data,type,row)=>{
                        return `<b>${data}</b>`
                    }
                },
                { data: 'user_detail.picture',
                    render : (data,type,row)=>{
                        return `<img src="{{ URL::asset('${data}') }}" class="rounded" width="50" height="50">`
                    }
                },
                { data: 'user_detail.fname',
                    render : (data,type,row)=>{
                        return  `
                                    <b>${row.user_detail.fname} ${row.user_detail.mname} ${row.user_detail.lname}</b><br>
                                        Sex: ${row.user_detail.sex}<br>
                                        age: ${row.user_detail.age}
                                `
                    }
                },
                { data: 'department',
                    render : (data,type,row)=>{
                        return `<b>${data}</b>`
                    }
                },
                { data: 'position',
                    render : (data,type,row)=>{
                        return `<b>${data}</b>`
                    }
                },
                { data: 'rate',
                    render : (data,type,row)=>{
                        return `<b class="h5">₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</b>`
                    }
                },
                { data: 'employment_status',
                    render : (data,type,row)=>{
                        return `<b>${data}</b>`
                    }
                },
                { data: 'pagibig_included',
                    render : (data,type,row)=>{
                        if(data){
                            return `
                            <form action="/updateContributionInclude" method="POST">
                                @CSRF
                                <input type="hidden" name="contribution_type" value="pagibig">
                                <input type="hidden" name="employee_id" value="${row.employee_id}">
                                <input type="hidden" name="included_value" value="0">
                                <button type="submit" class="btn btn-outline-primary w-100 p-4">Included</button>
                            </form>
                            `
                        }else{
                            return `
                            <form action="/updateContributionInclude" method="POST">
                                @CSRF
                                <input type="hidden" name="contribution_type" value="pagibig">
                                <input type="hidden" name="employee_id" value="${row.employee_id}">
                                <input type="hidden" name="included_value" value="1">
                                <button type="submit" class="btn btn-outline-warning w-100 p-4">Exempted</button>
                            </form>`
                        }
                    }
                },
            ]
        })
    })

    function getDateToday(){
        var today = new Date();
        var start_date = ''
        var end_date = ''
        if(today.getDate() < 16){
            start_date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+1;
            end_date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+15;
        }
        else{
            start_date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+16;
            end_date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+30;
        }
        return {start_date,end_date};
    }

    $('#sss_lock').click(()=>{
        $('#sss_update').removeAttr("disabled")
        $('#sss_cancel').removeAttr("disabled")
        $('#sss_lock').prop("disabled",true)

        $('#sss_ee_rate').removeAttr("disabled")
        $('#sss_er_rate').removeAttr("disabled")
        $('#sss_low_limit').removeAttr("disabled")
        $('#sss_high_limit').removeAttr("disabled")
        $('#sss_add_low').removeAttr("disabled")
        $('#sss_add_high').removeAttr("disabled")
    })

    $('#sss_cancel').click(()=>{
        location.reload();
    })

    $('#pagibig_lock').click(()=>{
        $('#pagibig_update').removeAttr("disabled")
        $('#pagibig_cancel').removeAttr("disabled")
        $('#pagibig_lock').prop("disabled",true)

        $('#pagibig_ee_max_rate').removeAttr("disabled")
        $('#pagibig_er_rate').removeAttr("disabled")
        $('#pagibig_max').removeAttr("disabled")
        $('#pagibig_divider').removeAttr("disabled")
    })

    $('#pagibig_cancel').click(()=>{
        location.reload();
    })

    $('#philhealth_lock').click(()=>{
        $('#philhealth_update').removeAttr("disabled")
        $('#philhealth_cancel').removeAttr("disabled")
        $('#philhealth_lock').prop("disabled",true)

        $('#philhealth_ee_rate').removeAttr("disabled")
        $('#philhealth_er_rate').removeAttr("disabled")
        $('#philhealth_max').removeAttr("disabled")
        $('#philhealth_min').removeAttr("disabled")

        $('#philhealth_share').removeAttr("disabled")
        $('#philhealth_rate').removeAttr("disabled")
        $('#philhealth_max_share').removeAttr("disabled")
    })

    $('#philhealth_cancel').click(()=>{
        location.reload();
    })

</script>
@endsection
