@extends('layout.staff_app')
    @section('title')
    <h1 class="section-title mt-2 pb-1">Schedule Management</h1>
    @endsection

    @section('content')
    <div class="container w-100 p-2">
        <table class="table table-striped table-dark text-center w-100" id="employee_table">
            <thead>
                <tr class="text-center">
                    <th class="col-1">Employee ID</th>
                    <th class="col">Picture</th>
                    <th class="col">Employee Details</th>
                    <th class="col">Department</th>
                    <th class="col">Position</th>
                    <th class="col-2">Time in</th>
                    <th class="col-2">Time out</th>
                </tr>
            </thead>
        </table>
    </div>
    @endsection

    @section('script')
    <script>
        $(document).ready(function(){
            $('#employee_table').DataTable({
                ajax: {
                        url: '/schedulejson',
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
                    { data: 'timein',
                        render : (data,type,row)=>{
                            return `<b>${data}</b>`
                        }
                    },
                    { data: 'timeout',
                        render : (data,type,row)=>{
                            return `<b>${data}</b>`
                        }
                    },
                ]
            })
        })

        function display_form(btn,form,id){
            $(`#${form}${id}`).toggleClass('d-none')
        }
    </script>
    @endsection
