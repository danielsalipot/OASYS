@extends('layout.payroll_app')
    @section('content')
    <div class="row mt-4">
        <div class="col-1" style="width:6vw"></div>
        <div class="col">
            <div class="container w-100 p-2">
                <h1 class="display-2 pb-5">Payroll Management</h1>
                <div class="row w-100 h-100">
                    <div class="col-md-2"><p class="text-center pt-2 h-100 border border-primary rounded shadow" id="cutOffDate">Cut Off Date: </p></div>
                    <div class="col-md-1">
                        <button type="button" name="payroll" id="payroll" class="btn p-4 w-100 btn-primary rounded">Payroll</button>
                        {!! Form::open(['action'=>'App\Http\Controllers\DocumentController@payrollPdf','method'=>'POST',  'target'=>"_blank", 'id'=>'payroll_form']) !!}
                            {!! Form::submit('Generate PDF', ['class'=>'btn p-4 w-100 btn-danger rounded d-none', 'id'=>'payrollGenerate']) !!}
                        {!! Form::close() !!}
                    </div>
                    <div class="col-md-1">
                        <button type="button" name="payslip" id="payslip" class="btn p-4 w-100 btn-success rounded">Payslip</button>
                        {!! Form::open(['action'=>'App\Http\Controllers\DocumentController@payslipPdf','method'=>'POST',  'target'=>"_blank", 'id'=>'payslip_form']) !!}
                            {!! Form::submit('Generate PDF', ['class'=>'btn p-4 w-100 btn-danger rounded d-none', 'id'=>'payslipGenerate']) !!}
                        {!! Form::close() !!}
                    </div>
                    <div class="col-md-2"></div>

                        <div class="col-md-2 input-daterange">
                            <input type="text" name="from_date" id="from_date" class="form-control h-100" placeholder="From Date" readonly />
                        </div>
                        <div class="col-md-2 input-daterange">
                            <input type="text" name="to_date" id="to_date" class="form-control h-100" placeholder="To Date" readonly />
                        </div>
                        <div class="col-2 input-daterange">
                            <button type="button" name="filter" id="filter" class="btn p-3 pe-5 ps-5 h-100 btn-outline-primary">Filter</button>
                            <button type="button" name="refresh" id="refresh" class="btn p-3 pe-5 ps-5 h-100  btn-outline-success">Refresh</button>
                        </div>
                </div>

                <br>

                <table class="table text-center table-dark table-bordered table-striped" id="payroll_table">
                    <thead>
                        <tr>
                            <th>Employee ID</th>
                            <th>Employee Picture</th>
                            <th>Employee Details</th>
                            <th>Total Hours</th>
                            <th>Rate</th>
                            <th>Gross Pay</th>
                            <th>Taxes</th>
                            <th>Deductions</th>
                            <th>Cash Advance</th>
                            <th>Net Pay</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    <script>

        function generatePostForm(table,col){
            $(table).html(
                $(table).html()
                    + `<input type="hidden" id="${col[0]}" name="${col[0]}" value="">`
                    + `<input type="hidden" id="${col[2]}" name="${col[2]}" value="">`
                    + `<input type="hidden" id="${col[3]}" name="${col[3]}" value="">`
                    + `<input type="hidden" id="${col[4]}" name="${col[4]}" value="">`
                    + `<input type="hidden" id="${col[5]}" name="${col[5]}" value="">`
                    + `<input type="hidden" id="${col[6]}" name="${col[6]}" value="">`
                    + `<input type="hidden" id="${col[7]}" name="${col[7]}" value="">`
                    + `<input type="hidden" id="${col[8]}" name="${col[8]}" value="">`
                    + `<input type="hidden" id="${col[9]}" name="${col[9]}" value="">`
                    + `<input type="hidden" id="${col[10]}" name="${col[10]}" value="">`
            )
        }

        let arr1 = ['pr_col1','','pr_col2','pr_col3','pr_col4','pr_col5','pr_col6','pr_col7','pr_col8','pr_col9','pr_date']
        generatePostForm('#payroll_form',arr1);

        let arr2 = ['ps_col1','','ps_col2','ps_col3','ps_col4','ps_col5','ps_col6','ps_col7','ps_col8','ps_col9','ps_date']
        generatePostForm('#payslip_form',arr2 );

        $('#payslip').click(()=>{
            $('#payslipGenerate').removeClass('d-none');
            $('#payslip').addClass('d-none')

            if($('#from_date').val() == ""){
                let { start_date, end_date } = getDateToday();

                $.ajax({
                    url: 'payslipjson',
                    type: 'get',
                    data: {start_date: start_date,end_date: end_date},
                    success: function(response){
                        $('#ps_col1').val(JSON.stringify(response))
                        $('#ps_col2').val(`${start_date} - ${end_date}`)
                    }
                });
            }
            else{
                $.ajax({
                    url: 'payslipjson',
                    type: 'get',
                    data: {from_date: $('#from_date').val(),to_date: $('#to_date').val()},
                    success: function(response){
                        $('#ps_col1').val(JSON.stringify(response))
                        $('#ps_col2').val(`${$('#from_date').val()} - ${$('#to_date').val()}`)
                    }
                });
            }
        })


        $('#payslipGenerate').click(()=>{
            $('#payslip').removeClass('d-none');
            $('#payslipGenerate').addClass('d-none')
        })

        $('#payrollGenerate').click(()=>{
            $('#payroll').removeClass('d-none');
            $('#payrollGenerate').addClass('d-none')
        })

        $('#payroll').click(()=>{
            $('#payrollGenerate').removeClass('d-none');
            $('#payroll').addClass('d-none')
            var table = $('#payroll_table').DataTable();

            let arr = ['#pr_col1','','#pr_col2','#pr_col3','#pr_col4','#pr_col5','#pr_col6','#pr_col7','#pr_col8','#pr_col9','#pr_date']
            for (let i = 0; i < arr.length; i++) {
                if (i == 1) {
                    continue;
                }
                $(arr[i]).val("")
            }

            for(let i = 0; i < arr.length; i++){
                if (i == 1) {
                    continue;
                }
                if(i+1 == arr.length){
                    let { start_date, end_date } = getDateToday();
                    $(arr[i]).val(`${start_date} - ${end_date}`)
                    continue;
                }
                for (let index = 0; index < table.columns(i).data()[0].length; index++) {

                    if(index == table.columns(i).data()[0].length - 1){
                        $(arr[i]).val($(arr[i]).val() + table.columns(i).data()[0][index])
                    }else{
                        $(arr[i]).val($(arr[i]).val() + table.columns(i).data()[0][index] + ";")
                    }
                }
            }
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

            load_data(start_date,end_date);

            function load_data(from_date = '', to_date = ''){
                $('#payroll_table').DataTable({
                    processing: true,
                    serverSide: false,
                    ajax: {
                        url: '/payrolljson',
                        data: {
                            from_date: from_date,
                            to_date: to_date
                        },
                        dataSrc: ''
                    },
                    columns: [
                        { data: 'employee_id',
                            render : (data,type,row)=>{
                                return `<b>${data}</b>`
                            }
                        },
                        { data: 'user_detail.picture',
                            render : (data,type,row)=>{
                                return `<img src="${data}" class="rounded" width="50" height="50">`
                        }
                        },
                        { data: 'full_name',
                            render : (data,type,row)=>{
                                return `<b class="h3">${data}</b><br>
                                        ${row.position}<br>
                                        ${row.department}
                                        `
                            }
                        },
                        { data: 'complete_hours',
                            render : (data,type,row)=>{
                                return `<b>${data}</b><br>`
                            }
                        },
                        { data: 'rate',
                            render : (data,type,row)=>{
                                return `<b class="h5">₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</b>`
                            }
                        },
                        { data: 'gross_pay',
                            render : (data,type,row)=>{
                                return `<b class="h5">₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</b>`
                            }
                        },
                        { data: 'tax_deduction',
                            render : (data,type,row)=>{
                                return `<b>${row.taxes.tax_amount}</b><br>
                                        ₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}`
                            }
                        },
                        { data: 'total_deduction',
                            render : (data,type,row)=>{
                                return `₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}`
                            }
                        },
                        { data: 'total_cash_advance',
                            render : (data,type,row)=>{
                                return `₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}`
                            }
                        },
                        { data: 'net_pay',
                            render : (data,type,row)=>{
                                return `<b class="h5">₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</b>`
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
                $('#from_date').val('');
                $('#to_date').val('');
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

