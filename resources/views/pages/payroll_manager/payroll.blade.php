@extends('layout.payroll_app')
    @section('content')
    <div class="row mt-4">
        <div class="col-1" style="width:6vw"></div>
        <div class="col">
            <h1>Payroll Management</h1>

            <div class="container w-100 mt-4">
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
        $(document).ready( function () {
            $('#payroll_table').DataTable( {
                ajax: {
                    url: '/payrolljson',
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
                            return `<b>${data}</b><br>
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
                            return `<b>₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</b>`
                        }
                    },
                    { data: 'gross_pay',
                        render : (data,type,row)=>{
                            return `<b>₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</b>`
                        }
                    },
                    { data: 'tax_deduction',
                        render : (data,type,row)=>{
                            return `₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}`
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
                            return `<b>₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</b>`
                        }
                    }
                ]
            });
        });
    </script>


    @endsection
