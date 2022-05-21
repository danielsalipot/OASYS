@extends('layout.payroll_app')

@section('title')
    <h1 class="section-title mt-5 pb-5">Audit Trail</h1>
@endsection

@section('content')
<div class="container w-100 p-2">
    <div class="w-100 shadow-lg p-3 mb-4">
        <button onclick="audit_click()" class="btn btn-outline-success w-25 py-4" id="btn_audit">Generate Audit Summary</button>
        {!! Form::open(['action'=>'App\Http\Controllers\Payroll\PayrollAUDITPDFController@audit','method'=>'GET',  'target'=>"_blank", 'id'=>'payslip_form']) !!}
                <div id="audit_pdf_actions" class="row d-flex w-25 d-none">
                    <div class="col ps-3 h-100 w-100">
                        {!! Form::hidden('from', '', ['id'=>'from']) !!}
                        {!! Form::hidden('to', '', ['id'=>'to']) !!}
                        {!! Form::submit('PDF', ['class'=>'btn h-100 btn-danger p-4 w-100 rounded', 'id'=>'payslipGenerate']) !!}
                    </div>
                    <div class="col p-0 h-100 w-100">
                        <button type="button" onclick="location.reload()" id="payslip_cancel" class="btn btn-outline-danger p-4 w-100">x</button>
                    </div>
                </div>
        {!! Form::close() !!}
    </div>

    @include('inc.date_filter')
    <table class="table table-striped table-dark text-center w-100" id="audit_table">
        <thead>
            <tr class="text-center">
                <th class="col">Date of Activity</th>
                <th class="col">Payroll Manager</th>
                {{-- insertion, deletion update --}}
                <th class="col">Type</th>
                <th class="col">Affected Employee</th>
                <th class="col">Activtiy</th>
                <th class="col">Details</th>
                <th class="col">Activity ID</th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@section('script')
<script>
    function audit_click(){
        $('#audit_pdf_actions').toggleClass('d-none')
        $('#btn_audit').toggleClass('d-none')
    }

    $(document).ready(function(){
        $('.input-daterange').datepicker({
            todayBtn:'linked',
            format:'yyyy-mm-dd',
            autoclose:true
        });

            let { start_date, end_date } = getDateToday();
            load_table(start_date,end_date);

            $('#from_date').val(start_date);
            $('#to_date').val(end_date);

            function load_table(from_date = '', to_date = ''){
                $('#from').val(from_date)
                $('#to').val(to_date)
                $('#audit_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                            url: '/payrollauditjson',
                            data:{
                                from_date: from_date,
                                to_date: to_date
                            }
                        },
                    columns: [
                        { data: 'date',
                            render : (data,type,row)=>{
                                return `<b>${data}</b>`
                            }
                        },
                        { data: 'payroll',
                            render : (data,type,row)=>{
                                return `<b>${data}</b>`
                            }
                        },
                        { data: 'type',
                            render : (data,type,row)=>{
                                return `<b>${data}</b>`
                            }
                        },
                        { data: 'employee_detail',
                            render : (data,type,row)=>{
                                return `<b>${data}</b>`
                            }
                        },
                        { data: 'activity',
                            render : (data,type,row)=>{
                                return `${data}`
                            }
                        },
                        { data: 'amount',
                            render : (data,type,row)=>{
                                return `<b>${data}</b>`
                            }
                        },
                        { data: 'tid',
                            render : (data,type,row)=>{
                                return `<b>${data}</b>`
                            }
                        },
                    ]
                })
            }

            $('#filter').click(function(){
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                if(from_date != '' &&  to_date != ''){
                    $('#audit_table').DataTable().destroy();
                    load_table(from_date, to_date);
                }else{
                    alert('Both Date is required');
                }
            });

            $('#refresh').click(function(){
                let { start_date, end_date } = getDateToday();
                $('#from_date').val(start_date);
                $('#to_date').val(end_date);
                $('#audit_table').DataTable().destroy();
                load_table(start_date,end_date);
            })
    })

    function getDateToday(){
            var today = new Date();
            var start_date = ''
            var end_date = ''

            if(today.getDate() < 16){
                start_date = formatDate(today.getFullYear()+'-'+(today.getMonth()+1)+'-'+1);
                end_date = formatDate(today.getFullYear()+'-'+(today.getMonth()+1)+'-'+15);
            }
            else{
                start_date = formatDate(today.getFullYear()+'-'+(today.getMonth()+1)+'-'+16);
                end_date = formatDate(today.getFullYear()+'-'+(today.getMonth()+1)+'-'+30);
            }

            return {start_date,end_date};
        }


        function formatDate(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2)
                month = '0' + month;
            if (day.length < 2)
                day = '0' + day;

            return [year, month, day].join('-');
        }


</script>
@endsection
