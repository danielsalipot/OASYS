@extends('layout.staff_app')
    @section('title')
        <h1 class="section-title mt-2 pb-1">Interview Management</h1>
    @endsection

    @section('content')
        <table class="table table-striped table-dark w-100 text-center" id="applicant_table">
            <thead>
            <tr>
                <th scope="col">Picture</th>
                <th scope="col">Employee Name</th>
                <th scope="col">Applying for</th>
                <th scope="col">Applied on</th>
                <th scope="col">First Interview</th>
                <th scope="col">Second Interview</th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
    @endsection

    @section('script')
        <script>
            $('#applicant_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/interviewjson',
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
                                    <h5>Sex: ${row.sex}</h5>
                                    <h5>Age: ${row.age}</h5>`
                        }
                    },
                    { data: 'Applyingfor',
                        render : (data,type,row)=>{
                            return `<h4>${data}</h4>`
                        }
                    },
                    { data: 'educ',
                        render : (data,type,row)=>{
                            return `<h4>${data}</h4>`
                        }
                    },
                    { data: 'first',
                        render : (data,type,row)=>{
                            return `<b>${data}</b>`
                        }
                    },
                    { data: 'second',
                        render : (data,type,row)=>{
                            return `<b>${data}</b>`
                        }
                    }
                ]
            });
        </script>
    @endsection
