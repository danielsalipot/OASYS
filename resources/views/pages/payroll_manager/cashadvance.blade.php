@extends('layout.payroll_app')
    @section('content')
    <div class="row mt-4">
        <div class="col-1" style="width:6vw"></div>

        <div class="col">
            <h1 class="section-title mt-5 pb-5">Employee Cash Advance</h1>

            <div class="container">
                <table class="table table-striped table-dark" id="cash_advance_table">
                    <thead>
                        <tr>
                            <th scope="col">Employee Details</th>
                            <th scope="col">Department</th>
                            <th scope="col">Cash Advance Date</th>
                            <th scope="col">Cash Advance Amount</th>
                        </tr>
                    </thead>
                </table>
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#cash_advance_table').DataTable({
                ajax: {
                        url: '/cashadvancejson',
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
                    { data: 'start_date',
                        render : (data,type,row)=>{
                            return `<b>${data}</b>`
                        }
                    },
                    { data: 'employment_status',
                        render : (data,type,row)=>{
                            return `<b>${data}</b>`
                        }
                    },
                    { data: 'employee_id',
                        render : (data,type,row)=>{
                            return `<button type="button" id="${data}" onclick="editRate(${data})" class="btn btn-primary" data-toggle="modal" data-target="#edit_modal">Edit Rate</button>`
                        }
                    },
                ]
            })
        })
    </script>
@endsection
