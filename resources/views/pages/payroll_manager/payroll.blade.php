@extends('layout.payroll_app')
@section('title')
    <h1 class="section-title mt-5 pb-5">Payroll Management</h1>
@endsection

@section('content')
    <div class="row w-100">
        <div class="col-3 rounded card p-2 shadow-sm">
            <h4 class="alert-primary shadow-sm p-4 text-center rounded">Payroll Report Generation Buttons</h4>
            @if (session('err'))
                <h6 class="alert-danger text-center w-100 p-2">{{ session('err') }}</h6>
            @endif
            <p class="text-center py-2 my-2 border border-primary rounded shadow" id="cutOffDate">Cut Off Date: </p>
            <button type="button" name="payroll" id="payroll" class="btn p-4 w-100 btn-primary rounded"><i class="h3 bi bi-cash-stack"></i><br>Create Payroll</button>
            <form action="/payrollPDF" method="post" enctype="multipart/form-data" id='payroll_form' target="_blank" onsubmit="setTimeout(function(){window.location.reload();},10);">
                @csrf
                <div id="payroll_pdf_actions" class="row w-100 h-100 d-none">
                    <div class="row m-2 card p-2">
                        <h6>Upload Signature</h6>
                        <input type="file" name="esignature" class="input-resume" accept="image/png" id="esignature">
                    </div>
                    <div class="col ps-3 h-100 w-100">
                        {!! Form::submit('PDF', ['class'=>'btn btn-warning rounded p-4 w-100', 'id'=>'payrollGenerate']) !!}
                    </div>
                    <div class="col p-0 h-100 w-100">
                        <button type="button" id="payroll_cancel" class="btn btn-outline-danger p-4 w-100">x</button>
                    </div>
                </div>
            </form>
                <div class="rounded mt-2">
                    <a href="/payroll/history" class="btn btn-success w-100 p-4">View Payroll History</a>
                </div>
        </div>
        <div class="col ms-3 p-0">
            <button  onclick="collapseFunction(this)" class="btn btn-lg mt-1 text-warning" style="position: absolute; z-index:300;"><h4><i class="bi bi-question-diamond-fill"></i> Instructions</h4></button>

            <script>
                function collapseFunction(btn){
                    var collapse = document.getElementById('collapseCard')
                    collapse.classList.toggle('d-none')

                    if (btn.innerHTML == '<h4><i class="bi bi-question-diamond-fill"></i> Instructions</h4>') {
                        btn.innerHTML = '<h4><i class="bi bi-question-diamond-fill"></i> Hide</h4>'
                    } else {
                        btn.innerHTML = '<h4><i class="bi bi-question-diamond-fill"></i> Instructions</h4>'
                    }
                }
            </script>

            <div id="collapseCard" class="d-none">
                <div class="row w-100 mx-auto h-100 p-0">
                    <div class="col card rounded-0 rounded-start p-0">
                        <h4 class="alert-primary w-100 text-center p-3 m-0 ">Step 1</h6>
                        <ul class="text-justify m-4" style="font-size:13px">
                            <li>Make sure you are generating the intended cutoff duration.</li>
                            <li>The Cutoff duration are indicated above the create payroll button.</li>
                            <li>To change the cutoff duration, use the date filters on the Current Cutoff Overview below.</li>
                            <li>Make sure all the payroll details below are ready such as the overtime, deductions, and etc.</li>
                        </ul>
                    </div>
                    <div class="col card rounded-0 p-0">
                        <h4 class="alert-primary w-100 text-center p-3 m-0 ">Step 2</h6>
                        <ul class="text-justify m-4" style="font-size:13px">
                            <li>When the payroll is ready, click the button "Create Payroll" on the left side. Please refer to the example below:</li>
                        </ul>
                        <button class="btn p-2 w-50 mx-auto btn-primary rounded"><i class="h5 bi bi-cash-stack"></i><br>Create Payroll</button>
                        <h6 class="w-100 text-center text-secondary">*Not the actual button*</h6>
                    </div>
                    <div class="col card rounded-0 rounded-end p-0">
                        <h4 class="alert-primary w-100 text-center p-3 m-0 ">Step 3</h6>
                        <ul class="text-justify m-4" style="font-size:13px">
                            <li>After clicking the "Create Payroll" button, you will be prompted to upload your E-signature.</li>
                            <li>The E-signature should be in <b>.png file format</b></li>
                            <li>After uploading your E-signature click the "PDF" Button to generate the Payroll PDF file</li>
                        </ul>
                        <button class="btn p-3 w-25 mx-auto btn-warning rounded">PDF</button>
                        <h6 class="w-100 text-center text-secondary">*Not the actual button*</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row p-3"></div>
    <div class="row card shadow-sm p-0">
        <h4 class="alert-primary shadow-sm my-1 p-4 m-0 text-center rounded">Current Cutoff Overview</h4>
        <div class="p-4">
            @include('inc.date_filter')
            <table class="table text-center table-bordered table-stripedresponsive w-100" id="payroll_table">
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th data-priority="1">Employee Details</th>
                        <th>Total Hours</th>
                        <th>Rate/hr</th>
                        <th>Bonus</th>
                        <th  data-priority="1">Gross Pay</th>
                        <th>SSS</th>
                        <th>Pag-ibig</th>
                        <th>Philhealth</th>
                        <th>Deductions</th>
                        <th>Cash Advance</th>
                        <th>Taxable Net</th>
                        <th  data-priority="1">Witholding<br>Tax</th>
                        <th data-priority="1">Total Salary</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<div class="row p-5"></div>
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
            $.ajax({
                url: '/payrollPdfjson',
                type: 'get',
                data: {from_date: $('#from_date').val(),to_date: $('#to_date').val()},
                success: function(response){
                    $('#ps_col1').val(JSON.stringify(response))
                    $('#ps_col2').val(`${$('#from_date').val()} - ${$('#to_date').val()}`)
                }
            });

            setTimeout(function() {
                $('#payslip_pdf_actions').removeClass('d-none');
                $('#payslip').addClass('d-none')
            }, 2000);
        })

        $('#payroll').click(()=>{
            $('#payroll_pdf_actions').removeClass('d-none');
            $('#payroll').addClass('d-none')

            $.ajax({
                url: '/payrollPdfjson',
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
                    serverSide: true,
                    ajax: {
                        url: '/payrolljson',
                        data: {
                            from_date: from_date,
                            to_date: to_date
                        }
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
                        { data: 'employee_contribution',
                            render : (data,type,row)=>{
                                return `<b class="text-danger">₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</b>`
                            }
                        },
                        { data: 'employee_pagibig_contribution',
                            render : (data,type,row)=>{
                                return `<b class="h5 text-danger">₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</b>`
                            }
                        },
                        { data: 'employee_philhealth_contribution',
                            render : (data,type,row)=>{
                                return `<b class="h5 text-danger">₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</b>`
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
                        { data: 'taxable_net',
                            render : (data,type,row)=>{
                                return `<b class="h5 text-success">₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</b>`
                            }
                        },
                        { data: 'witholding_tax',
                            render : (data,type,row)=>{
                                return `<b class="h5 text-danger">₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</b>`
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
                start_date = formatDate(today.getFullYear()+'-'+(today.getMonth()+1)+'-'+1);
                end_date = formatDate(today.getFullYear()+'-'+(today.getMonth()+1)+'-'+15);
            }
            else{
                start_date = formatDate(today.getFullYear()+'-'+(today.getMonth()+1)+'-'+16);
                end_date = formatDate(today.getFullYear()+'-'+(today.getMonth()+1)+'-'+30);
            }

            return {start_date,end_date};
        }


        function formatDate(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2)
                month = '0' + month;
            if (day.length < 2)
                day = '0' + day;

            return [year, month, day].join('-');
        }
    </script>
@endsection

