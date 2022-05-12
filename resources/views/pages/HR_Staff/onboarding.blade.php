@extends('layout.staff_app')
    @section('title')
        <h1 class="section-title mt-2 pb-1">Onboarding Management</h1>
        <link rel="stylesheet" type="text/css" href="dist/bootstrap-clockpicker.min.css">
    @endsection

    @section('content')
        <table class="table table-striped table-dark w-100 text-center" id="applicant_table">
            <thead>
            <tr>
                <th scope="col">Picture</th>
                <th scope="col">Employee Name</th>
                <th scope="col">Sex</th>
                <th scope="col">Age</th>
                <th scope="col">Applying For</th>
                <th scope="col">Education</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
    @endsection



@section('modal')
@foreach ($modals as $modal)
    {!! $modal !!}
@endforeach
@endsection

@section('script')
<script>
$(document).ready(function(){
    $('#applicant_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/applicantjson',
        },
        columns: [
            { data: 'img',
                render : (data,type,row)=>{
                    return data
                }
            },
            { data: 'full_name',
                render : (data,type,row)=>{
                    return `<h5>${data}</h5>`
                }
            },
            { data: 'sex',
                render : (data,type,row)=>{
                    return `<b>${data}</b>`
                }
            },
            { data: 'age',
                render : (data,type,row)=>{
                    return `<b>${data}</b>`
                }
            },
            { data: 'Applyingfor',
                render : (data,type,row)=>{
                    return `<b>${data}</b>`
                }
            },
            { data: 'educ',
                render : (data,type,row)=>{
                    return `<b>${data}</b>`
                }
            },
            { data: 'applicant_id',
                render : (data,type,row)=>{
                    return `${row.onboard}  ${row.delete}`
                }
            }
        ]
    });
})
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
@endsection
