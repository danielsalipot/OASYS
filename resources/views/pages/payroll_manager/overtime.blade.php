@extends('layout.payroll_app')
    @section('content')
    <div class="row mt-4">
        <div class="col-1" style="width:6vw"></div>
        <div class="col">
            <div class="container p-2">
                <h1 class="display-2 pb-5">Overtime Management</h1>
                <div class="row mb-2">
                    <div class="col-md-1">
                        <select id="time_filter" class="w-100 p-3">
                            <option value="1800">00:30:00</option>
                            <option value="3600">01:00:00</option>
                            <option value="5400">01:30:00</option>
                            <option value="7200">02:00:00</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-primary w-100 h-100" id="time_filter_btn">Filter</button>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-2 input-daterange">
                        <input type="text" name="from_date" id="from_date" class="form-control h-100" placeholder="From Date" readonly />
                    </div>
                    <div class="col-md-2 input-daterange">
                        <input type="text" name="to_date" id="to_date" class="form-control h-100" placeholder="To Date" readonly />
                    </div>
                    <div class="col-2 input-daterange">
                        <button type="button" name="filter" id="filter" class="btn p-3 h-100 btn-outline-primary">Filter</button>
                        <button type="button" name="refresh" id="refresh" class="btn p-3 h-100  btn-outline-success">Refresh</button>
                    </div>
                </div>
                    <table class="table table-striped table-dark text-center" id="overtime_table">
                        <thead>
                            <tr>
                                <th scope="col">Attendance Id</th>
                                <th scope="col">Employee Details</th>
                                <th scope="col">Time in</th>
                                <th scope="col">Time out</th>
                                <th scope="col">Total Overtime Hours</th>
                                <th scope="col">Attendance Date</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#time_filter_btn').click(()=>{
            console.log($('#time_filter').find(":selected").val())
        })
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
                $('#overtime_table').DataTable({
                    processing: true,
                    serverSide: false,
                    ajax: {
                            url: '/overtimejson',
                            data: {
                                from_date: from_date,
                                to_date: to_date
                            },
                            dataSrc: ''
                        },
                    columns: [
                        { data: 'attendance_id',
                            render : (data,type,row)=>{
                                return `${data}`
                            }
                        },
                        { data: 'user_details.fname',
                            render : (data,type,row)=>{
                                return `<h4>${data} ${row.user_details.mname} ${row.user_details.lname}</h4>
                                        ${row.user_details.position}<br>
                                        ${row.user_details.department}
                                        `
                            }
                        },
                        { data: 'time_in',
                            render : (data,type,row)=>{
                                return `Time in: <h5 class="text-success">${data}</h5>
                                        Schedule: <h5>${row.user_details.schedule_Timein}</h5>`
                            }
                        },
                        { data: 'time_out',
                            render : (data,type,row)=>{
                                return `Time out: <h5 class="text-success">${data}</h5>
                                        Schedule: <h5>${row.user_details.schedule_Timeout}</h5>`
                            }
                        },
                        { data: 'total_overtime_hours',
                            render : (data,type,row)=>{
                                return `${data}`
                            }
                        },
                        { data: 'attendance_date',
                            render : (data,type,row)=>{
                                return `${data}`
                            }
                        },
                    ]
                })
            }


            $('#filter').click(function(){
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                if(from_date != '' &&  to_date != ''){
                    $('#overtime_table').DataTable().destroy();
                    load_table(from_date, to_date);
                }else{
                    alert('Both Date is required');
                }
            });

            $('#refresh').click(function(){
                let { start_date, end_date } = getDateToday();
                $('#from_date').val(start_date);
                $('#to_date').val(end_date);
                $('#overtime_table').DataTable().destroy();
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
    </script>
@endsection
