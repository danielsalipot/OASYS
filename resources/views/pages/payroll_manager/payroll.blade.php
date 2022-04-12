@extends('layout.payroll_app')
    @section('content')
    <div class="row mt-4">
        <div class="col-1" style="width:6vw"></div>
        <div class="col">
            <div class="container w-100 p-2">
                <h1 class="display-2 pb-5">Payroll Management</h1>
                <div class="row input-daterange w-100">
                    <div class="col-md-5">
                        <button type="button" name="filter" id="filter" class="btn h-100 w-25 btn-primary">Payroll</button>
                        <button type="button" name="refresh" id="refresh" class="btn h-100 w-25 btn-success">Payslip</button>
                    </div>

                    <div class="col-md-1"></div>

                    <div class="col-md-2">
                        <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" readonly />
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" readonly />
                    </div>
                    <div class="col-md-2">
                        <button type="button" name="filter" id="filter" class="btn h-100 w-25 btn-primary">Filter</button>
                        <button type="button" name="refresh" id="refresh" class="btn h-100 w-25 btn-success">Refresh</button>
                    </div>
                </div>



                <br>

                <table class="table text-center table-bordered table-striped" id="payroll_table">
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
    </div>


    <script>
        $(document).ready(function(){
            $('.input-daterange').datepicker({
                todayBtn:'linked',
                format:'yyyy-mm-dd',
                autoclose:true
            });

            load_data();

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
                $('#from_date').val('');
                $('#to_date').val('');
                $('#payroll_table').DataTable().destroy();
                load_data();
            });
        });
    </script>

    @endsection

