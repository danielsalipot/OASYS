@extends("layout.staff_carousel")

@section('Title')
    <h1 class="section-title mt-5 pb-5">Audit Trail</h1>
@endsection
@section('controls')
    <li class="active"><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#home">Audit Logs</a></li>
    <li><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#menu1">Audit History</a></li>
@endsection

@section('first')
<div class="container w-100 p-2">
    <div class="w-100 shadow-lg p-3 mb-4">
        <button onclick="audit_click()" class="btn btn-outline-success w-25 py-4" id="btn_audit">Generate Audit Summary</button>
        {!! Form::open(['action'=>'App\Http\Controllers\AuditController@audit','method'=>'GET',  'target'=>"_blank", 'id'=>'payslip_form', 'onsubmit'=> "setTimeout(function(){window.location.reload();},10);"]) !!}
                <div id="audit_pdf_actions" class="row d-flex w-25 d-none">
                    <div class="col ps-3 h-100 w-100">
                        {!! Form::hidden('from', '', ['id'=>'from']) !!}
                        {!! Form::hidden('to', '', ['id'=>'to']) !!}
                        {!! Form::hidden('type', 'staff') !!}
                        {!! Form::submit('PDF', ['class'=>'btn h-100 btn-danger p-4 w-100 rounded', 'id'=>'payslipGenerate']) !!}
                    </div>
                    <div class="col p-0 h-100 w-100">
                        <button type="button" onclick="location.reload()" id="payslip_cancel" class="btn btn-outline-danger p-4 w-100">x</button>
                    </div>
                </div>
        {!! Form::close() !!}
    </div>

    @include('inc.date_filter')
   <table class="table table-striped  text-center responsive w-100" id="audit_table">
            <thead>
                <tr class="text-center">
                    <th class="col">Date of Activity</th>
                    <th class="col" data-priority="1">Payroll Manager</th>
                    {{-- insertion, deletion update --}}
                    <th class="col">Type</th>
                    <th class="col" data-priority="1">Affected Employee</th>
                    <th class="col" data-priority="1">Activtiy</th>
                    <th class="col" data-priority="1">Details</th>
                    <th class="col">Activity ID</th>
                </tr>
            </thead>
        </table>
</div>
@endsection


@section('second')
    <div class="row">
        <div class="col-3 p-0">
            @if (!$files_arr['files'])
                <h1 class="w-100 display-5 text-center">No Audit file yet</h1>
            @endif

            <ul class="nav nav-pills p-0 w-100">
                @foreach ($files_arr['files'] as $key => $item)
                @if(!$key)
                    <li class="active w-100 text-wrap"><a data-toggle="tab" class="nav-item nav-link text-decoration-none m-0 p-3 w-100 text-center border text-wrap" style="word-wrap: break-word;" href="#Philhealth_files_{{$key}}">{{ $item['name'] }}</a></li>
                @else
                    <li class="w-100 text-wrap"><a data-toggle="tab" class="nav-item nav-link text-decoration-none border m-0 w-100 p-3 text-center text-wrap" style="word-wrap: break-word;" href="#Philhealth_files_{{$key}}">{{ $item['name'] }}</a></li>
                @endif
                @endforeach
            </ul>
        </div>
        <div class="col bg-dark">
            <div class="tab-content">
                @foreach ($files_arr['files'] as $key => $item)
                @if(!$key)
                    <div id="Philhealth_files_{{$key}}" class="tab-pane active in m-0">
                        <div class="container text-center">
                            <embed src="/{{$item['path']}}" width="800px" height="1600px" />
                        </div>
                    </div>
                @else
                    <div id="Philhealth_files_{{$key}}" class="tab-pane in m-0">
                        <div class="container text-center">
                            <embed src="/{{$item['path']}}" width="800px" height="1600px" />
                        </div>
                    </div>
                @endif
                @endforeach
            </div>
        </div>
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
                            url: '/staffgetAuditJson',
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
                                if(data){
                                    return `<b>${data}</b>`
                                }
                                return `-`
                            }
                        },
                    ]
                })
            }
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
