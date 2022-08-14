@extends('layout.staff_app')
    @section('title')
        <h1 class="section-title mt-2 pb-1">Onboarding Management</h1>
        <link rel="stylesheet" type="text/css" href="dist/bootstrap-clockpicker.min.css">
    @endsection

    @section('content')
        <table class="table table-striped  w-100 text-center" id="applicant_table">
            <thead>
            <tr>
                <th class="col">Picture</th>
                <th class="col">Employee Name</th>
                <th class="col">Sex</th>
                <th class="col">Age</th>
                <th class="col">Applying For</th>
                <th class="col">Education</th>
                <th class="col-3">Action</th>
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
            { data: 'employee_id',
                render : (data,type,row)=>{
                    return row.img
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
                    return `<div class='d-flex justify-content-center'>${row.onboard}  ${row.delete}</div>`
                }
            }
        ]
    });
})
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
@endsection
