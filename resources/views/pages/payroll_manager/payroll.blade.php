@extends('layout.payroll_app')
@section('title')
    <h1 class="section-title mt-5 pb-5">Payroll Management</h1>
@endsection

@section('content')

    <div class="shadow-lg ps-3 py-1 my-5">
        <h4 class="w-100 text-center display-4 p-4">Payroll Progress Confirmation</h4>
        <div class="progress me-3">
            <div class="progress-bar" role="progressbar" style="width:0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">0%</div>
        </div>

        <div class="row my-3 px-3">
            <div class="col">
                <h4 class="text-primary w-100">Employee Salary Rate</h4>
                <div class="row">
                    <div class="col p-0">
                        <button class="btn btn-outline-primary w-100 p-3">Confirm</button>
                    </div>
                    <div class="col-3 p-0 pe-3">
                        <a href="/payroll/employeelist" class="btn btn-primary w-100 p-3"><i class="bi bi-caret-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="col">
                <h4 class="text-dark">Employee Deductions</h4>
                <div class="row">
                    <div class="col p-0">
                        <button class="btn btn-outline-dark w-100 h1 p-3">Confirm</button>
                    </div>
                    <div class="col-3 p-0 pe-3">
                        <a href="/payroll/deductions" class="btn btn-dark w-100 p-3"><i class="bi bi-caret-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="col">
                <h4 class="text-success ">Overtime Payments</h4>
                <div class="row">
                    <div class="col p-0">
                        <button class="btn btn-outline-success w-100 p-3">Confirm</button>
                    </div>
                    <div class="col-3 p-0 pe-3">
                        <a href="/payroll/overtime" class="btn btn-success w-100 p-3"><i class="bi bi-caret-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="col">
                <h4 class="text-info">Cash Advance</h4>
                <div class="row">
                    <div class="col p-0">
                        <button class="btn btn-outline-info w-100 p-3">Confirm</button>
                    </div>
                    <div class="col-3 p-0 pe-3">
                        <a href="/payroll/cashadvance" class="btn btn-info w-100 p-3"><i class="bi bi-caret-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="col">
                <h4 class="text-dark">Contributions</h4>
                <div class="row">
                    <div class="col p-0">
                        <button class="btn btn-outline-light text-dark w-100 p-3">Confirm</button>
                    </div>
                    <div class="col-3 p-0 pe-3">
                        <a href="/payroll/contributions" class="btn btn-light w-100 p-3"><i class="bi bi-caret-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="col">
                <h4 class="text-warning">Employee Bonus</h4>
                <div class="row">
                    <div class="col p-0">
                        <button class="btn btn-outline-warning w-100 p-3">Confirm</button>
                    </div>
                    <div class="col-3 p-0 pe-3">
                        <a href="/payroll/bonus" class="btn btn-warning w-100 p-3"><i class="bi bi-caret-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="col">
                <h4 class="text-danger">Double/Triple Pay</h4>
                <div class="row">
                    <div class="col p-0">
                        <button class="btn btn-outline-danger w-100 p-3">Confirm</button>
                    </div>
                    <div class="col-3 p-0 pe-3">
                        <a href="/payroll/doublepay" class="btn btn-danger w-100 p-3"><i class="bi bi-caret-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>
    <div class="row w-100 mt-5">
        <div class="col-md-2"><p class="text-center py-2 my-2 border border-primary rounded shadow" id="cutOffDate">Cut Off Date: </p></div>
        <div class="col-md-1 border border-primary rounded p-2">
            <button type="button" name="payroll" id="payroll" class="btn p-4 w-100 btn-primary rounded">Payroll</button>
            {!! Form::open(['action'=>'App\Http\Controllers\Payroll\PayrollPAYROLLPDFController@payrollPdf','method'=>'POST',  'target'=>"_blank", 'id'=>'payroll_form']) !!}
                <div id="payroll_pdf_actions" class="row d-none">
                    <div class="col">
                        {!! Form::submit('PDF', ['class'=>'btn h-100 px-3 btn-danger rounded', 'id'=>'payrollGenerate']) !!}
                    </div>
                    <div class="col">
                        <button type="button" id="payroll_cancel" class="btn btn-outline-danger p-4">x</button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
        <div class="col-md-1 border border-success mx-1 rounded p-2">
            <button type="button" name="payslip" id="payslip" class="btn p-4 w-100 btn-success rounded">Payslip</button>
            {!! Form::open(['action'=>'App\Http\Controllers\Payroll\PayrollPAYSLIPPDFController@payslipPdf','method'=>'POST',  'target'=>"_blank", 'id'=>'payslip_form']) !!}
                <div id="payslip_pdf_actions" class="row d-none">
                    <div class="col">
                        {!! Form::submit('PDF', ['class'=>'btn h-100 px-3 btn-danger rounded', 'id'=>'payslipGenerate']) !!}
                    </div>
                    <div class="col">
                        <button type="button" id="payslip_cancel" class="btn btn-outline-danger p-4">x</button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
        <div class="col-6"></div>
        <div class="col">
            <a href="/payroll/history" class="btn btn-outline-warning w-100 p-4">View Payroll History</a>
        </div>
    </div>

    @include('inc.date_filter')
    <br>
        <table class="table text-center table-dark table-bordered table-striped" id="payroll_table">
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Employee Details</th>
                    <th>Total Hours</th>
                    <th>Rate</th>
                    <th>Bonus</th>
                    <th>Gross Pay</th>
                    <th>Taxes</th>
                    <th>SSS</th>
                    <th>Deductions</th>
                    <th>Cash Advance</th>
                    <th>Net Pay</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('script')
    <script>
        function generatePostForm(table,col){
            $(table).html(
                $(table).html()
                    + `<input type="hidden" id="${col[0]}" name="${col[0]}" value="">`
                    + `<input type="hidden" id="${col[1]}" name="${col[1]}" value="">`
            )
        }

        generatePostForm('#payroll_form',['pr_col1','pr_col2']);
        generatePostForm('#payslip_form',['ps_col1','ps_col2',]);

        $('#payslipGenerate').click(()=>{
            $('#payslip').removeClass('d-none');
            $('#payslip_pdf_actions').addClass('d-none')
        })

        $('#payrollGenerate').click(()=>{
            $('#payroll').removeClass('d-none');
            $('#payroll_pdf_actions').addClass('d-none')
        })

        $('#payroll_cancel').click(()=>{
            $('#payroll_pdf_actions').addClass('d-none');
            $('#payroll').removeClass('d-none')
        })

        $('#payslip_cancel').click(()=>{
            $('#payslip').removeClass('d-none');
            $('#payslip_pdf_actions').addClass('d-none')
        })


        $('#payslip').click(()=>{
            $('#payslip_pdf_actions').removeClass('d-none');
            $('#payslip').addClass('d-none')

            $.ajax({
                url: '/payrolljson',
                type: 'get',
                data: {from_date: $('#from_date').val(),to_date: $('#to_date').val()},
                success: function(response){
                    $('#ps_col1').val(JSON.stringify(response))
                    $('#ps_col2').val(`${$('#from_date').val()} - ${$('#to_date').val()}`)
                }
            });
        })

        $('#payroll').click(()=>{
            $('#payroll_pdf_actions').removeClass('d-none');
            $('#payroll').addClass('d-none')

            $.ajax({
                url: '/payrolljson',
                type: 'get',
                data: {from_date: $('#from_date').val(),to_date: $('#to_date').val()},
                success: function(response){
                    $('#pr_col1').val(JSON.stringify(response))
                    $('#pr_col2').val(`${$('#from_date').val()} - ${$('#to_date').val()}`)
                }
            });
        })

        // DATATABLES FUNCTIONS
        $(document).ready(function(){
            $('.input-daterange').datepicker({
                todayBtn:'linked',
                format:'yyyy-mm-dd',
                autoclose:true
            });

            let { start_date, end_date } = getDateToday();

            $('#cutOffDate').html(`Current Cut Off Duration: <br> <b> ${start_date} - ${end_date}</b>`)
            $('#from_date').val(start_date);
            $('#to_date').val(end_date);

            load_data(start_date,end_date);

            function load_data(from_date = '', to_date = ''){
                $('#cutOffDate').html(`Current Cut Off Duration: <br> <b> ${from_date} - ${to_date}</b>`)
                $('#payroll_table').DataTable({
                    processing: true,
                    serverSide: false,
                    ajax: {
                        url: '/payrolljson',
                        data: {
                            from_date: from_date,
                            to_date: to_date
                        },dataSrc:''
                    },
                    columns: [
                        { data: 'employee_id',
                            render : (data,type,row)=>{
                                return `<b>${data}</b>`
                            }
                        },
                        { data: 'full_name',
                            render : (data,type,row)=>{
                                return `<b class="h6">${data}</b><br>
                                        ${row.position}<br>
                                        ${row.department}
                                        `
                            }
                        },
                        { data: 'complete_hours',
                            render : (data,type,row)=>{
                                return `<h5 class="text-warning">${data}</h5><br>`
                            }
                        },
                        { data: 'rate',
                            render : (data,type,row)=>{
                                return `<b class="h5 text-info">₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</b>`
                            }
                        },
                        { data: 'total_bonus',
                            render : (data,type,row)=>{
                                return `<b class="text-info">₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</b>`
                            }
                        },
                        { data: 'gross_pay',
                            render : (data,type,row)=>{
                                return `<b class="h5 text-success">₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</b>`
                            }
                        },
                        { data: 'tax_deduction',
                            render : (data,type,row)=>{
                                return `<b>${row.taxes.tax_amount}</b><br>
                                        <b class="text-danger">₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</b>`
                            }
                        },
                        { data: 'total_sss',
                            render : (data,type,row)=>{
                                return `<b class="text-danger">₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</b>`
                            }
                        },
                        { data: 'total_deduction',
                            render : (data,type,row)=>{
                                return `<b class="text-danger">₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</b>`
                            }
                        },
                        { data: 'total_cash_advance',
                            render : (data,type,row)=>{
                                return `<b class="text-danger">₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</b>`
                            }
                        },
                        { data: 'net_pay',
                            render : (data,type,row)=>{
                                return `<b class="h5 text-success">₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</b>`
                            }
                        }
                    ]
                });
            }

            $('#filter').click(function(){
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                if(from_date != '' &&  to_date != ''){
                    $('#payroll_table').DataTable().destroy();
                    load_data(from_date, to_date);
                }else{
                    alert('Both Date is required');
                }
            });

            $('#refresh').click(function(){
                let { start_date, end_date } = getDateToday();
                $('#from_date').val(start_date);
                $('#to_date').val(end_date);
                $('#payroll_table').DataTable().destroy();
                load_data(start_date,end_date);
            });
        });

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
    </script>
@endsection

