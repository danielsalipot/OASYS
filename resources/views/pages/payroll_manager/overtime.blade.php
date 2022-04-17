@extends('layout.payroll_app')
    @section('content')
    <div class="row mt-4">
        <div class="col-1" style="width:6vw"></div>
        <div class="col">
            <div class="container p-2">
                <h1>Overtime Management</h1>
                    <table class="table table-striped table-dark" id="overtime_table">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">Picture</th>
                                <th scope="col">Employee Details</th>
                                <th scope="col">Department</th>
                                <th scope="col">Time in</th>
                                <th scope="col">Time out</th>
                                <th scope="col">Total Overtime Hours</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#overtime_table').DataTable({
                ajax: {
                        url: '/overtimejson',
                        dataSrc: ''
                    },
                columns: [
                    { data: 'overtime_id',
                        render : (data,type,row)=>{
                            return `${data}`
                        }
                    },
                    { data: 'overtime_id',
                        render : (data,type,row)=>{
                            return `${data}`
                        }
                    },
                    { data: 'overtime_id',
                        render : (data,type,row)=>{
                            return `${data}`
                        }
                    },
                    { data: 'overtime_id',
                        render : (data,type,row)=>{
                            return `${data}`
                        }
                    },
                    { data: 'overtime_id',
                        render : (data,type,row)=>{
                            return `${data}`
                        }
                    },
                    { data: 'overtime_id',
                        render : (data,type,row)=>{
                            return `${data}`
                        }
                    },

                ]
            })
        })
    </script>
@endsection
