@extends('layout.admin_app')
    @section('content')
        <h1 class="section-title mt-5 pb-2">Performance Assessment</h1>

        <h1 class="display-5 text-center w-100">Employee Selection</h1>
        <div class="container w-100">
            <table class="table w-100  text-center" id="employee_table">
                <thead>
                    <tr class="text-center">
                        <th class="col">Employee ID</th>
                        <th class="col">Employee Picture</th>
                        <th class="col">Employee Name</th>
                        <th class="col">Department</th>
                        <th class="col">Position</th>
                        <th class="col">Status</th>
                        <th class="col">Assessment Progress</th>
                        <th class="col">Select</th>
                    </tr>
                </thead>
            </table>
        </div>
    @endsection

    @section('script')
        <script>
        $(document).ready(function(){

            $('#employee_table').DataTable({
                    processing: true,
                    serverSide: false,
                    ajax: {
                        url: '/assessmentEmployeeList'
                    },
                    columns: [
                        { data: 'employee_id',
                            render : (data,type,row)=>{
                                return `<b>${data}</b>`
                            }
                        },
                        { data: 'employee_id',
                            render : (data,type,row)=>{
                                return `<img src="{{ URL::asset('${row.user_detail.picture}')}}" class="rounded" width="50" height="50">`
                            }
                        },
                        { data: 'user_detail.fname',
                            render : (data,type,row)=>{
                                return `<b>${data} ${row.user_detail.mname} ${row.user_detail.lname}</b>`
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
                        { data: 'employment_status',
                            render : (data,type,row)=>{
                                return `<b>${data}</b>`
                            }
                        },
                        { data: 'assessment.length',
                            render : (data,type,row)=>{
                                return `<div class="progress" style="height:50px">
                                            <div class="progress-bar" role="progressbar" style="width: ${((row.assessment.length / 4) / 4) * 100}%;" aria-valuenow="${((row.assessment.length / 4) / 4) * 100}" aria-valuemin="0" aria-valuemax="100">${((row.assessment.length / 4) / 4) * 100}%</div>
                                        </div>`
                            }
                        },
                        { data: 'employee_id',
                            render : (data,type,row)=>{
                                return `<a href="/admin/performance/${data}" class='btn btn-outline-primary w-100 m-0 '><i class="bi bi-person-bounding-box h1"></i><br>Create Assessment</a>`
                            }
                        }
                    ]
                })
        })
        </script>
    @endsection
