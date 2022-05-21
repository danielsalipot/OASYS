@extends('layout.pr_carousel')

@section('Title')
    <h1 class="section-title mt-4 pb-1 text-center w-100">Employee Contributions</h1>
@endsection

@section('first')
    <h1 class="display-4 pb-5 mt-5 text-center w-100">SSS Contribution</h1>

    <div class="shadow-lg m-auto p-5">
        <h3 class="w-100 text-center">SSS Contribution Details</h3>
        {!! Form::open(['action'=>'App\Http\Controllers\Payroll\PayrollUpdateController@edit_sss']) !!}
        <div class="row p-3">
            <div class="row">
                <div class="col"></div>
                <div class="col-2 text-center">
                    {!! Form::label('sss_ee_rate', "Employee SSS Rate", []) !!}
                    {!! Form::text('sss_ee_rate',"$sss->employee_contribution",['disabled','id'=>'sss_ee_rate','class'=>'form-control text-center p-3']) !!}
                </div>
                <div class="col-2 text-center">
                    {!! Form::label('sss_er_rate', "Employer SSS Rate", []) !!}
                    {!! Form::text('sss_er_rate',"$sss->employer_contribution",['disabled','id'=>'sss_er_rate', 'class'=>'form-control text-center p-3']) !!}
                </div>
                <div class="col"></div>
            </div>

            <div class="row mt-3 ">
                <div class="col"></div>
                <div class="col-1 text-center">
                    {!! Form::label('sss_add_low', "Lower Addition", []) !!}
                    {!! Form::text('sss_add_low',"$sss->add_low",['disabled','id'=>'sss_add_low','class'=>'form-control text-center p-3']) !!}
                </div>
                <div class="col-1 text-center">
                    {!! Form::label('sss_add_high', "Higher Addition", []) !!}
                    {!! Form::text('sss_add_high',"$sss->add_high",['disabled','id'=>'sss_add_high', 'class'=>'form-control text-center p-3']) !!}
                </div>
                <div class="col"></div>
            </div>

            <div class="d-flex flex-row justify-content-center mt-3 mx-0">
                <button type="button" id="sss_lock" class="btn btn-outline-primary h-100 me-2 px-4 p-3"><i class="bi bi-lock"></i></button>
                {!! Form::submit('Update SSS Rate', ['disabled','id' =>'sss_update','class'=>'btn btn-success px-5 p-3']) !!}
                <button disabled type="button" id="sss_cancel" class="btn btn-outline-danger h-100 ms-2 px-4 p-3"><i class="bi bi-x-circle"></i></button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

    <br>
    <br>

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
@endsection

@section('second')
<div class="container">
    <h1 class="display-4 pb-5 mt-5 text-center w-100">Pagibig Contribution</h1>

    <div class="shadow-lg m-auto p-5">
        <h3 class="w-100 text-center">Pagibig Contribution Details</h3>
        {!! Form::open(['action'=>'App\Http\Controllers\Payroll\PayrollUpdateController@edit_pagibig']) !!}
        <div class="row p-3">
            <div class="row">
                <div class="col"></div>
                <div class="col-2 text-center">
                    {!! Form::label('pagibig_ee_min_rate', "Employee Pagibig Low Rate", []) !!}
                    {!! Form::text('pagibig_ee_min_rate',"$pagibig->ee_min_rate",['disabled','id'=>'pagibig_ee_min_rate','class'=>'form-control text-center p-3']) !!}
                </div>
                <div class="col-2 text-center">
                    {!! Form::label('pagibig_ee_max_rate', "Employee Pagibig High Rate", []) !!}
                    {!! Form::text('pagibig_ee_max_rate',"$pagibig->ee_max_rate",['disabled','id'=>'pagibig_ee_max_rate','class'=>'form-control text-center p-3']) !!}
                </div>
                <div class="col-2 text-center">
                    {!! Form::label('pagibig_er_rate', "Employer Pagibig Rate", []) !!}
                    {!! Form::text('pagibig_er_rate',"$pagibig->er_rate",['disabled','id'=>'pagibig_er_rate', 'class'=>'form-control text-center p-3']) !!}
                </div>
                <div class="col"></div>
            </div>
            <div class="row mt-3">
                <div class="col"></div>
                <div class="col-2 text-center">
                    {!! Form::label('pagibig_max', "Maximum Contribution", []) !!}
                    {!! Form::text('pagibig_max',"$pagibig->maximum",['disabled','id'=>'pagibig_max','class'=>'form-control text-center p-3']) !!}
                </div>
                <div class="col"></div>
            </div>
            <div class="row my-3">
                <div class="col"></div>
                <div class="col-1 text-center">
                    {!! Form::label('pagibig_divider', "Pagibig Maximum Salary", []) !!}
                    {!! Form::text('pagibig_divider',"$pagibig->divider",['disabled','id'=>'pagibig_divider','class'=>'form-control text-center p-3']) !!}
                </div>
                <div class="col"></div>
            </div>
                <div class="d-flex flex-row justify-content-center mt-3">
                    <button type="button" id="pagibig_lock" class="btn btn-outline-primary h-100 me-2 px-4 p-3"><i class="bi bi-lock"></i></button>
                    {!! Form::submit('Update Pagibig Rate', ['disabled','id' =>'pagibig_update','class'=>'btn btn-success px-5 p-3']) !!}
                    <button disabled type="button" id="pagibig_cancel" class="btn btn-outline-danger h-100 ms-2 px-4 p-3"><i class="bi bi-x-circle"></i></button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

    <br>
    <br>

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
@endsection

@section('extra')
<div class="item">
    <h1 class="display-4 pb-5 mt-5 text-center w-100">Philhealth Contribution</h1>

    <div class="shadow-lg m-auto p-5">
        <h3 class="w-100 text-center">Philhealth Contribution Details</h3>
        {!! Form::open(['action'=>'App\Http\Controllers\Payroll\PayrollUpdateController@edit_philhealth']) !!}
        <div class="row p-3">
            <div class="row">
                <div class="col"></div>
                <div class="col-2 text-center">
                    {!! Form::label('philhealth_rate', "Philhealth Rate", []) !!}
                    {!! Form::text('philhealth_rate',"$philhealth->ph_rate",['disabled','id'=>'philhealth_rate','class'=>'form-control text-center p-3']) !!}
                </div>
                <div class="col-1 text-center"></div>
                <div class="col-2 text-center">
                    {!! Form::label('philhealth_max_share', "Philhealth Maximum Share", []) !!}
                    {!! Form::text('philhealth_max_share',"$philhealth->ph_cap",['disabled','id'=>'philhealth_max_share','class'=>'form-control text-center p-3']) !!}
                </div>
                <div class="col"></div>
            </div>
            <div class="row mt-3">
                <div class="col"></div>
                <div class="col-3 text-center">
                    {!! Form::label('philhealth_min', "Philhealth Minimum Range", []) !!}
                    {!! Form::text('philhealth_min',"$philhealth->minimum",['disabled','id'=>'philhealth_min','class'=>'form-control text-center p-3']) !!}
                </div>
                <div class="col-3 text-center">
                    {!! Form::label('philhealth_max', "Philhealth Maximum Range", []) !!}
                    {!! Form::text('philhealth_max',"$philhealth->maximum",['disabled','id'=>'philhealth_max', 'class'=>'form-control text-center p-3']) !!}
                </div>
                <div class="col"></div>
            </div>
            <div class="row mt-3">
                <div class="col"></div>
                <div class="col-2 text-center">
                    {!! Form::label('philhealth_ee_rate', "Employee Philhealth Rate", []) !!}
                    {!! Form::text('philhealth_ee_rate',"$philhealth->ee_rate",['disabled','id'=>'philhealth_ee_rate','class'=>'form-control text-center p-3']) !!}
                </div>
                <div class="col-2 text-center">
                    {!! Form::label('philhealth_er_rate', "Employer Philhealth Rate", []) !!}
                    {!! Form::text('philhealth_er_rate',"$philhealth->er_rate",['disabled','id'=>'philhealth_er_rate', 'class'=>'form-control text-center p-3']) !!}
                </div>
                <div class="col"></div>
            </div>

            <div class="d-flex flex-row justify-content-center mt-3">
                <button type="button" id="philhealth_lock" class="btn btn-outline-primary h-100 me-2 px-4 p-3"><i class="bi bi-lock"></i></button>
                {!! Form::submit('Update Philhealth Rate', ['disabled','id' =>'philhealth_update','class'=>'btn btn-success px-5 p-3']) !!}
                <button disabled type="button" id="philhealth_cancel" class="btn btn-outline-danger h-100 ms-2 px-4 p-3"><i class="bi bi-x-circle"></i></button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

    <br>
    <br>

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
                load_table(from_date, to_date);
            }else{
                alert('Both Date is required');
            }
        });

        $('#refresh').click(function(){
            let { start_date, end_date } = getDateToday();
            $('#from_date').val(start_date);
            $('#to_date').val(end_date);
            $('#sss_table').DataTable().destroy();
            load_table(start_date,end_date);
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
                load_table(from_date, to_date);
            }else{
                alert('Both Date is required');
            }
        });

        $('#pagibig_refresh').click(function(){
            let { start_date, end_date } = getDateToday();
            $('#pagibig_from_date').val(start_date);
            $('#pagibig_to_date').val(end_date);
            $('#pagibig_table').DataTable().destroy();
            load_table(start_date,end_date);
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
                load_table(from_date, to_date);
            }else{
                alert('Both Date is required');
            }
        });

        $('#philhealth_refresh').click(function(){
            let { start_date, end_date } = getDateToday();
            $('#philhealth_from_date').val(start_date);
            $('#philhealth_to_date').val(end_date);
            $('#philhealth_table').DataTable().destroy();
            load_table(start_date,end_date);
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
