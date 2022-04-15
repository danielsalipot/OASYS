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
                        <button type="button"  name="payroll" id="payroll" class="btn p-4 w-100 btn-primary rounded">Payroll</button>
                    </div>
                    <div class="col-md-1">
                        <button type="button" name="payslip" id="payslip" class="btn p-4 w-100 btn-success rounded">Payslip</button>
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
            {!! Form::open(['action'=>'App\Http\Controllers\DocumentController@payroll','method'=>'POST',  'target'=>"_blank", 'id'=>'payroll_form']) !!}
                {!! Form::submit('submit', ['class'=>'']) !!}
            {!! Form::close() !!}
        </div>
    <script>
        $('#payroll_form').html(
            $('#payroll_form').html()
            + `<input type="hidden" id="date" name="date" value="">`
            + `<input type="hidden" id="col1" name="col1" value="">`
            + `<input type="hidden" id="col2" name="col2" value="">`
            + `<input type="hidden" id="col3" name="col3" value="">`
            + `<input type="hidden" id="col4" name="col4" value="">`
            + `<input type="hidden" id="col5" name="col5" value="">`
            + `<input type="hidden" id="col6" name="col6" value="">`
            + `<input type="hidden" id="col7" name="col7" value="">`
            + `<input type="hidden" id="col8" name="col8" value="">`
            + `<input type="hidden" id="col9" name="col9" value="">`
        )

        $('#payroll').click(()=>{
            var table = $('#payroll_table').DataTable();
            var today = new Date();
            var start_date = ''
            var end_date = ''

            $('#date').val("")
            $('#col1').val("")
            $('#col2').val("")
            $('#col3').val("")
            $('#col4').val("")
            $('#col5').val("")
            $('#col6').val("")
            $('#col7').val("")
            $('#col8').val("")
            $('#col9').val("")

            if(today.getDate() < 16){
                start_date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+1;
                end_date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+15;
            }
            else{
                start_date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+16;
                end_date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+30;
            }

            $('#date').val(`${start_date} - ${end_date}`)

                for (let index = 0; index < table.columns(2).data()[0].length; index++) {

                    if(index == table.columns(2).data()[0].length - 1){
                        $('#col1').val($('#col1').val() + table.columns(0).data()[0][index])
                    }else{
                        $('#col1').val($('#col1').val() + table.columns(0).data()[0][index] + ";")
                    }

                }
                for (let index = 0; index < table.columns(2).data()[0].length; index++) {

                    if(index == table.columns(2).data()[0].length - 1){
                        $('#col2').val($('#col2').val() + table.columns(2).data()[0][index])
                    }else{
                        $('#col2').val($('#col2').val() + table.columns(2).data()[0][index] + ";")
                    }

                }
                for (let index = 0; index < table.columns(2).data()[0].length; index++) {

                    if(index == table.columns(2).data()[0].length - 1){
                        $('#col3').val($('#col3').val() + table.columns(3).data()[0][index])
                    }else{
                        $('#col3').val($('#col3').val() + table.columns(3).data()[0][index] + ";")
                    }

                }
                for (let index = 0; index < table.columns(2).data()[0].length; index++) {

                    if(index == table.columns(2).data()[0].length - 1){
                        $('#col4').val($('#col4').val() + table.columns(4).data()[0][index])
                    }else{
                        $('#col4').val($('#col4').val() + table.columns(4).data()[0][index] + ";")
                    }

                }
                for (let index = 0; index < table.columns(2).data()[0].length; index++) {

                    if(index == table.columns(2).data()[0].length - 1){
                        $('#col5').val($('#col5').val() + table.columns(5).data()[0][index])
                    }else{
                        $('#col5').val($('#col5').val() + table.columns(5).data()[0][index] + ";")
                    }

                }
                for (let index = 0; index < table.columns(2).data()[0].length; index++) {

                    if(index == table.columns(2).data()[0].length - 1){
                        $('#col6').val($('#col6').val() + table.columns(6).data()[0][index])
                    }else{
                        $('#col6').val($('#col6').val() + table.columns(6).data()[0][index] + ";")
                    }

                }
                for (let index = 0; index < table.columns(2).data()[0].length; index++) {

                    if(index == table.columns(2).data()[0].length - 1){
                        $('#col7').val($('#col7').val() + table.columns(7).data()[0][index])
                    }else{
                        $('#col7').val($('#col7').val() + table.columns(7).data()[0][index] + ";")
                    }

                }
                for (let index = 0; index < table.columns(2).data()[0].length; index++) {

                    if(index == table.columns(2).data()[0].length - 1){
                        $('#col8').val($('#col8').val() + table.columns(8).data()[0][index])
                    }else{
                        $('#col8').val($('#col8').val() + table.columns(8).data()[0][index] + ";")
                    }

                }
                for (let index = 0; index < table.columns(2).data()[0].length; index++) {

                    if(index == table.columns(2).data()[0].length - 1){
                        $('#col9').val($('#col9').val() + table.columns(9).data()[0][index])
                    }else{
                        $('#col9').val($('#col9').val() + table.columns(9).data()[0][index] + ";")
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

                $('#from_date').val('');
                $('#to_date').val('');
                $('#payroll_table').DataTable().destroy();
                load_data(start_date,end_date);
            });
        });
    </script>
    @endsection

