@extends('layout.pr_carousel')

@section('Title')
    <h1 class="section-title mt-4 pb-1">Employee Contributions</h1>
@endsection

@section('first')
    <h1 class="display-4 pb-5 mt-5 text-center w-100">SSS Contribution Management</h1>

    <div class="shadow-lg m-auto p-5">
        <h3 class="w-100 text-center">SSS Contribution Details</h3>
        {!! Form::open(['action'=>'App\Http\Controllers\Payroll\PayrollUpdateController@edit_sss']) !!}
        <div class="row p-3">
            <div class="col"></div>
            <div class="col-2 text-center">
                {!! Form::label('ee_rate', "Employee SSS Rate", []) !!}
                {!! Form::text('ee_rate',"$sss->employee_contribution",['disabled','id'=>'ee_rate','class'=>'form-control text-center p-3']) !!}
            </div>
            <div class="col-2 text-center">
                {!! Form::label('er_rate', "Employer SSS Rate", []) !!}
                {!! Form::text('er_rate',"$sss->employer_contribution",['disabled','id'=>'er_rate', 'class'=>'form-control text-center p-3']) !!}
            </div>
            <div class="col"></div>
            <div class="d-flex flex-row justify-content-center mt-3">
                <button type="button" id="lock" class="btn btn-outline-primary h-100 me-2 px-4 p-3"><i class="bi bi-lock"></i></button>
                {!! Form::submit('Update SSS Rate', ['disabled','id' =>'sss_update','class'=>'btn btn-success px-5 p-3']) !!}
                <button disabled type="button" id="sss_cancel" class="btn btn-outline-danger h-100 ms-2 px-4 p-3"><i class="bi bi-x-circle"></i></button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

    <br>
    <br>

    <div class="row">
        @include('inc.date_filter')
    </div>

    <table class="table table-striped text-center table-dark" id="employee_table">
        <thead>
            <tr class="text-center">
                <th scope="col">Employee Details</th>
                <th scope="col">Employee Rate</th>
                <th scope="col">Monthly Salary</th>
                <th scope="col">Employee Contribution</th>
                <th scope="col">Employer Contribution</th>
                <th scope="col">Total SSS Contibution</th>
            </tr>
        </thead>
    </table>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        $('.input-daterange').datepicker({
                todayBtn:'linked',
                format:'yyyy-mm-dd',
                autoclose:true
            });

        let { start_date, end_date } = getDateToday();
        $('#from_date').val(start_date);
        $('#to_date').val(end_date);
        load_table(start_date,end_date);

        function load_table(from_date = '', to_date = ''){
        $('#employee_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ URL::to("/contributionsjson")}}',
                data:{
                    from_date: from_date,
                    to_date: to_date
                }
            },
            columns: [
                { data: 'fname',
                    render : (data,type,row)=>{
                        return `<h4>${data} ${row.mname} ${row.lname}</h4>
                            ${row.department}<br>
                            ${row.position}`
                    }
                },
                { data: 'rate',
                    render : (data,type,row)=>{
                        return `<h5 class="text-info">₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</h5>`
                    }
                },
                { data: 'gross_pay',
                    render : (data,type,row)=>{
                        return `<h5 class="text-success">₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</h5>`
                    }
                },
                { data: 'employee_contribution',
                    render : (data,type,row)=>{
                        return `<h5 class="text-danger">₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</h5>`
                    }
                },
                { data: 'employer_contribution',
                    render : (data,type,row)=>{
                        return `<h5 class="text-danger">₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</h5>`
                    }
                },
                { data: 'total_sss',
                    render : (data,type,row)=>{
                        return `<h5 class="text-success">₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</h5>`
                    }
                }
            ]
        })
        }

        $('#filter').click(function(){
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            if(from_date != '' &&  to_date != ''){
                $('#employee_table').DataTable().destroy();
                load_table(from_date, to_date);
            }else{
                alert('Both Date is required');
            }
        });

        $('#refresh').click(function(){
            let { start_date, end_date } = getDateToday();
            $('#from_date').val(start_date);
            $('#to_date').val(end_date);
            $('#employee_table').DataTable().destroy();
            load_table(start_date,end_date);
        });
    })


    function getDateToday(){
        var today = new Date();
        var start_date = ''
        var end_date = ''
        if(today.getDate() < 16){
            start_date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+1;
            end_date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+15;
        }
        else{
            start_date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+16;
            end_date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+30;
        }
        return {start_date,end_date};
    }

    $('#lock').click(()=>{
        $('#sss_update').removeAttr("disabled")
        $('#sss_cancel').removeAttr("disabled")
        $('#lock').prop("disabled",true)

        $('#ee_rate').removeAttr("disabled")
        $('#er_rate').removeAttr("disabled")
    })

    $('#sss_cancel').click(()=>{
        location.reload();
    })

</script>
@endsection
