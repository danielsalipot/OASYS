@extends('layout.pr_carousel')

@section('Title')
    <h1 class="section-title mt-5 w-100 text-center pb-5">Payroll/Payslip History</h1>
@endsection

@section('first')
    <h1 class="display-4 pb-5 mt-5 text-center w-100">Payroll History</h1>
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

@section('second')
    <h1 class="display-4 pb-5 mt-5 text-center w-100">Payslip History</h1>
    <div class="d-flex flex-row">
        <div class="col-4 bg-dark p-0 shadow-lg m-3" id="payslip_history" style="overflow-y:scroll; overflow-x:hidden; height:300px;">
            @for ($i=0;$i < count($sub_btn_arr_ps);$i++)
                {!! $sub_btn_arr_ps[$i] !!}
                {!! $options[$i] !!}
            @endfor
        </div>
    </div>
@endsection

@section('script')
<script>

    function folder(btn,key){
        $(`#folder${key}`).toggleClass('d-none')
    }

    function openPSfile(key){
        $(`#ps_${key}`).css('display','block');
    }

    function display(btn,key,value){
        if(btn.innerHTML == "Close"){
            $("iframe").each(function() {
                $(this).css('display','none');
            });

            $('#payroll_history button').prop('disabled',false);

            btn.innerHTML = value

        }else{
            $('#payroll_history button').not(btn).prop('disabled',true);
            btn.innerHTML = 'Close'
            $(`#file${key}`).css('display','block');
        }

        $(`#${key}`).toggleClass("btn-light");
        $(`#${key}`).toggleClass("btn-danger");
    }
</script>
@endsection
