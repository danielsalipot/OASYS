@extends('layout.staff_app')
    @section('title')
        <h1 class="section-title mt-2 pb-1">Offboardee Management</h1>
    @endsection

    @section('content')
    <table class="table table-striped table-dark w-100 text-center" id="employee_table">
        <thead>
        <tr>
            <th class="col-1">Picture</th>
            <th class="col-2">Employee Detail</th>
            <th class="col-1">Department</th>
            <th class="col-1">Position</th>
            <th class="col-2">Offboarding Status</th>
            <th class="col">Actions</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>
    @endsection

    @section('script')
    <script>
    $(document).ready(function(){
        $('#employee_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/offboardingjson',
            },
            columns: [
                { data: 'img',
                    render : (data,type,row)=>{
                        return data
                    }
                },
                { data: 'full_name',
                    render : (data,type,row)=>{
                        return `<h4>${data}</h4>
                            <h5>Sex: ${row.user_detail.sex}</h5>
                            <h5>Age: ${row.user_detail.age}</h5>`
                    }
                },
                { data: 'department',
                    render : (data,type,row)=>{
                        return `<h5>${data}</h5>`
                    }
                },
                { data: 'position',
                    render : (data,type,row)=>{
                        return `<h5>${data}</h5>`
                    }
                },
                { data: 'offboarding_status',
                    render : (data,type,row)=>{
                        return `<h5>${data}</h5>`
                    }
                },
                { data: 'employee_id',
                    render : (data,type,row)=>{
                        return `${row.clear}<br>
                                ${row.delete}`
                    }
                },
            ]
        });
    })
    </script>
    @endsection

