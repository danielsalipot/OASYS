@extends('layout.payroll_app')

@section('title')
    <h1 class="section-title mt-5 pb-5">Approval</h1>
@endsection

@section('content')
    <h1 class="display-4 pb-5 mt-5 text-center w-100">Payroll History</h1>

    @foreach ($progress_bar as $item)
        {!! $item !!}
    @endforeach
    <div class="w-25 m-auto border border-success rounded p-2 d-none" id="payslip_controls">
        <button type="button" disabled name="payslip" id="payslip" class="btn p-4 w-100 btn-success rounded">Payslip</button>
        {!! Form::open(['action'=>'App\Http\Controllers\Payroll\PayrollPAYSLIPPDFController@payslipPdf','method'=>'POST',  'target'=>"_blank", 'id'=>'payslip_form', 'onsubmit'=>"javascript: setTimeout(function(){location.reload();}, 500);return true;"]) !!}
            <div id="payslip_pdf_actions" class="row d-flex w-100 d-none">
                <div class="col ps-3 h-100 w-100">
                    {!! Form::hidden('ps_col1', '', ['id'=>'ps_col1']) !!}
                    {!! Form::hidden('ps_col2', '', ['id'=>'ps_col2']) !!}
                    {!! Form::submit('PDF', ['class'=>'btn h-100 btn-danger p-4 w-100 rounded ','id'=>'payslipGenerate']) !!}
                </div>
                <div class="col p-0 h-100 w-100">
                    <button type="button" id="payslip_cancel" class="btn btn-outline-danger p-4 w-100" onClick="window.location.reload()">x</button>
                </div>
            </div>
        {!! Form::close() !!}
        <div class="row">
            <div class="col" id="approval_div">
                <button id="approval_btn" onclick="approve_show(this)" class="btn btn-primary w-100 p-2 m-0">Approve</button>
            </div>
            <div class="col"  id="disapproval_div">
                <button id="disapproval_btn"  onclick="approve_show(this)" class="btn btn-outline-danger w-100 p-2 m-0">Disapprove</button>
            </div>
            <div id="approve_sign" class='row m-auto d-none'>
                <form action="/ApprovalPdf" method="post" enctype="multipart/form-data" target='_blank' onsubmit="javascript: setTimeout(function(){location.reload();}, 500);return true;">
                @csrf

                <div class="card m-3 p-3 shadow-sm text-center">
                    <h4>Attach your E-Signature</h4>
                    {!! Form::hidden('status', 0, ['id'=>'status']) !!}
                    {!! Form::hidden('hidden_filename', '', ['id'=>'hidden_filename']) !!}
                    <input type="file" name="esignature" class="input-resume m-auto" accept="image/png" id="esignature">
                    {!! Form::submit('Submit', ['class'=>'btn btn-outline-success w-75 m-auto', 'id' => "sign_submit"]) !!}
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row shadow-lg m-4">
        <div class="col-2 pe-3 bg-dark p-0" id="payroll_history" style="overflow-y:scroll; overflow-x:hidden; height:1000px;">
            @foreach ($btn_arr_pr as $item)
                {!! $item !!}
            @endforeach
        </div>
        <div class="col p-0 alert-secondary">
            @foreach ($file_arr_pr as $item)
                {!! $item !!}
            @endforeach
        </div>
    </div>
@endsection

@section('script')
<script>
    $('#payslip').click(()=>{
        setTimeout(function() {
            $('#payslip_pdf_actions').removeClass('d-none');
            $('#payslip').addClass('d-none')
        }, 2000);
    })

    function display(btn,key,value,from_date1,to_date1,progress,payslip_generate,vote,generator){
        if(btn.innerHTML == "Close"){
            $("iframe").each(function() {
                $(this).css('display','none');
            });

            $('#payroll_history button').prop('disabled',false);

            btn.innerHTML = value

            $('#payslip').prop('disabled',true)

            $('#approve_sign').addClass('d-none')
            $('#approval_div').removeClass('d-none')
            $('#disapproval_div').removeClass('d-none')

        }else{
            $('#payroll_history button').not(btn).prop('disabled',true);
            btn.innerHTML = 'Close'
            $(`#file${key}`).css('display','block');
            $('#hidden_filename').val($(`#file${key}`).attr('src'))

            $.ajax({
                url: '/payrollPdfjson',
                type: 'get',
                data: {from_date: from_date1,to_date:to_date1},
                success: function(response){
                    $('#ps_col1').val(JSON.stringify(response))
                    $('#ps_col2').val(`${from_date1} - ${to_date1}`)
                }
            });

            if(progress >= 100){
                $('#approval_btn').prop('disabled',true)
                $('#disapproval_btn').prop('disabled',true)
                console.log(payslip_generate)

                if(payslip_generate == 0){
                    $('#payslip').prop('disabled',false)
                    $('#payslip').html('Payslip')
                }
                else{
                    $('#payslip').prop('disabled',true)
                    $('#payslip').html('Payslip Has been Generated')
                }

            }else{
                $('#approval_btn').prop('disabled',false)
                $('#disapproval_btn').prop('disabled',false)
                $('#payslip').prop('disabled',true)
            }


            if(vote){
                $('#approval_btn').prop('disabled',true)
                $('#disapproval_btn').prop('disabled',true)
            }else{
                $('#approval_btn').prop('disabled',false)
                $('#disapproval_btn').prop('disabled',false)
            }

        }

        $(`#payslip_controls`).toggleClass('d-none')
        $(`#${key}`).toggleClass("btn-light");
        $(`#progress_bar${key}`).toggleClass("d-none");
        $(`#${key}`).toggleClass("btn-danger");
        if(generator == {{session('user_id')}}){
            $(`#payslip_controls`).addClass('d-none')
        }
    }

    function approve_show(btn){

        if(btn.innerHTML == 'Approve'){
            $('#status').val(1)
        }else{
            $('#status').val(0)
        }

        $('#approve_sign').toggleClass('d-none')
        $('#approval_div').toggleClass('d-none')
        $('#disapproval_div').toggleClass('d-none')
    }
</script>
@endsection
