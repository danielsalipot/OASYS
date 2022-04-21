@extends('layout.payroll_app')
    @section('content')
    <div class="row mt-4">
        <div class="col-1" style="width:6vw"></div>
        <div class="col">
            <div class="container p-2">
                <h1 class="section-title mt-4 pb-1 w-100 text-center pt-4">Deduction Management</h1>

                <div id="myCarousel" class="carousel carousel-dark  slide" data-interval="false" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <h1 class="display-4 pb-5 mt-5 text-center w-100">Employee Deductions</h1>
                            <div class="row w-100 h-100 mb-4 mt-4">
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
                            <table class="table table-striped text-center table-dark" id="deduction_table">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">Employee Details</th>
                                        <th scope="col">Deduction Name</th>
                                        <th scope="col">Deduction Date</th>
                                        <th scope="col">Deduction Amount</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                        <div class="item">
                            <div class="row">
                                <h1 class="display-4 pb-5 mt-5 text-center w-100">Create Employee Deductions</h1>
                                <div class="col">
                                    <h1 class="display-5 text-center w-100">Employee Selection</h1>
                                    <div class="container w-100">
                                        <table class="table w-100 table-striped text-center table-dark" id="employee_table">
                                            <thead>
                                                <tr class="text-center">
                                                    <th scope="col">Employee ID</th>
                                                    <th scope="col">Employee Picture</th>
                                                    <th scope="col">Employee Name</th>
                                                    <th scope="col">Department</th>
                                                    <th scope="col">Position</th>
                                                    <th scope="col">Select</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="container">
                                        <h1 class="display-5 m-3 text-center w-100">Selected Employees</h1>
                                        <table class="table table-striped text-center">
                                            <thead>
                                                <tr class="text-center">
                                                    <th scope="col">Employee ID</th>
                                                    <th scope="col">Employee Picture</th>
                                                    <th scope="col">Employee Name</th>
                                                    <th scope="col">Department</th>
                                                    <th scope="col">Position</th>
                                                </tr>
                                            </thead>
                                            <tbody id="selected_employee_table"></tbody>
                                        </table>
                                    </div>
                                    <div class="container">
                                        <h1 class="display-5 m-3 text-center w-100">Deduction Details</h1>
                                        {!! Form::open() !!}
                                        <div class="m-5 ps-5 pe-5">
                                            {!! Form::label('deduction_date_input', 'Deduction Date', ['class'=>'w-100 text-center']) !!}
                                            <div class="w-100">
                                                <div class="input-daterange">
                                                    <input type="text" name="deduction_date_input" id="deduction_date_input" class="form-control h-100 p-3 w-25 mb-3 m-auto" placeholder="To Date" readonly />
                                                </div>
                                            </div>

                                            {!! Form::label('deduction_name', 'Deduction Name', []) !!}
                                            {!! Form::text('deduction_name', '', ['id'=>'deduction_name','placeholder'=>'Deduction Name', 'class'=>'form-control mb-3']) !!}

                                            {!! Form::label('deduction_amount', 'Deduction Amount', []) !!}
                                            {!! Form::number('deduction_amount','', ['id'=>'deduction_amount', 'min' => '0.01', 'step'=>'any' ,'placeholder'=>'0.00','class'=>'text-center form-control mb-3']) !!}

                                            <div class="row">
                                                <div class="col">
                                                    <button type="button" onclick="addDeduction()" class="btn btn-success" data-toggle="modal" data-target="#edit_modal">Add Deduction</button>
                                                </div>
                                                <div class="col-2">
                                                    <button class="btn btn-danger w-100 p-3">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a class="carousel-control-prev" href="#myCarousel" style="height:0px;margin-top:55px;margin-left:20vw" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#myCarousel" style="height:0px;margin-top:55px;margin-right:20vw" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal" id="edit_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title w-100">Continue to Pay Overtime</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body row">
                    <div class="row">
                        <div class="col ps-5">
                            <p class="h5 text-center w-100">Selected Employees</p>
                            <hr>
                            <table class="w-100 m-auto text-center">
                                <thead>
                                    <th>ID</th>
                                    <th>Name</th>
                                </thead>
                                <tbody>
                                    <td><h6 id='modal_emp_id'></h6></td>
                                    <td><h6 id='modal_emp_names'></h6></td>
                                </tbody>
                            </table>
                        </div>
                        <div class="col">
                            <p class="h5 text-center w-100">Deduction Details</p>
                            <hr>

                            <h6>Deduction Date</h6>
                            {!! Form::text('modal_deduction_date', 'date', ['disabled','id'=>'modal_deduction_date','class'=>'p-2 w-100 text-center']) !!}
                            <hr>
                            <h6>Deduction Name</h6>
                            {!! Form::text('modal_deduction_name', 'date', ['disabled','id'=>'modal_deduction_name','class'=>'p-2 w-100 text-center']) !!}
                            <hr>
                            <h6>Deduction Amount</h6>
                            {!! Form::text('modal_deduction_amount', 'date', ['disabled','id'=>'modal_deduction_amount','class'=>'p-2 w-100 text-center']) !!}
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <div class="row">
                        <div class="col">
                            {!! Form::open(['action'=>'App\Http\Controllers\InsertController@InsertDeduction']) !!}
                                {!! Form::hidden('hidden_emp_id','',['id'=>'hidden_emp_id']) !!}
                                {!! Form::hidden('hidden_deduction_date','',['id'=>'hidden_deduction_date']) !!}
                                {!! Form::hidden('hidden_deduction_name','',['id'=>'hidden_deduction_name']) !!}
                                {!! Form::hidden('hidden_deduction_amount','',['id'=>'hidden_deduction_amount']) !!}
                                {!! Form::submit('Confirm Deduction', ['class' => ' w-100 btn btn-success']) !!}
                            {!! Form::close() !!}
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-danger w-100 " data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
            updateDeductionDate()

            function load_table(from_date = '', to_date = ''){
                $('#deduction_table').DataTable({
                    processing: true,
                    serverSide: false,
                    ajax: {
                        url: '/deductionjson',
                        data:{
                            from_date: from_date,
                            to_date: to_date
                        },
                        dataSrc: ''
                    },
                    columns: [
                        { data: 'fname',
                            render : (data,type,row)=>{
                                return `<b>${row.fname} ${row.mname} ${row.lname}</b><br>
                                            ${row.department}<br>
                                            ${row.position}`
                            }
                        },
                        { data: 'deduction_name',
                            render : (data,type,row)=>{
                                return `<b>${data}</b>`
                            }
                        },
                        { data: 'deduction_date',
                            render : (data,type,row)=>{
                                return `<b>${data}</b>`
                            }
                        },
                        { data: 'deduction_amount',
                            render : (data,type,row)=>{
                                return `<b>₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</b>`
                            }
                        },

                    ]
                })
            }

            $('#filter').click(function(){
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                if(from_date != '' &&  to_date != ''){
                    $('#deduction_table').DataTable().destroy();
                    load_table(from_date, to_date);
                }else{
                    alert('Both Date is required');
                }
            });

            $('#refresh').click(function(){
                let { start_date, end_date } = getDateToday();
                $('#from_date').val(start_date);
                $('#to_date').val(end_date);
                $('#deduction_table').DataTable().destroy();
                load_table(start_date,end_date);
            });

            $('#employee_table').DataTable({
                    processing: true,
                    serverSide: false,
                    ajax: {
                        url: '/employeedetailsjson',
                        dataSrc: ''
                    },
                    columns: [
                        { data: 'employee_id',
                            render : (data,type,row)=>{
                                return `<b>${data}</b>`
                            }
                        },
                        { data: 'employee_id',
                            render : (data,type,row)=>{
                                return `<img src="{{ URL::asset('${row.user_detail.picture}')}}" class="rounded" width="50" height="50">`
                            }
                        },
                        { data: 'user_detail.fname',
                            render : (data,type,row)=>{
                                return `<b>${data} ${row.user_detail.mname} ${row.user_detail.lname}</b>`
                            }
                        },
                        { data: 'department',
                            render : (data,type,row)=>{
                                return `<b>${data}</b>`
                            }
                        },
                        { data: 'position',
                            render : (data,type,row)=>{
                                return `<b>${data}</b>`
                            }
                        },
                        { data: 'employee_id',
                            render : (data,type,row)=>{
                                return `<button type="button"
                                        onclick="selectEmployee(
                                            this,
                                            '${row.employee_id}',
                                            '${row.user_detail.picture}',
                                            '${row.user_detail.fname} ${row.user_detail.mname} ${row.user_detail.lname}',
                                            '${row.department}',
                                            '${row.position}',
                                            )" class="btn btn-outline-primary">Select</button>`
                            }
                        },
                    ]
                })
        })
        function selectEmployee(btn, emp_id, emp_picture, emp_name, emp_department, emp_position){
            if(btn.innerHTML == "Select"){
                btn.innerHTML = 'Selected'
                btn.className = 'btn btn-success';

                $('#hidden_emp_id').val(`${$('#hidden_emp_id').val()}${emp_id};`)

                $('#modal_emp_id').html(`${$('#modal_emp_id').html()}${emp_id}<br>`)

                $('#modal_emp_names').html(`${$('#modal_emp_names').html()}${emp_name}<br>`)

                $('#selected_employee_table').html(
                `${$('#selected_employee_table').html()}

                <tr>
                    <td>${emp_id}</td>
                    <td><img src="{{ URL::asset('${emp_picture}')}}" class="rounded" width="50" height="50"></td>
                    <td>${emp_name}</td>
                    <td>${emp_department}</td>
                    <td>${emp_position}</td>
                </tr>
                `)
            }else{
                btn.innerHTML = 'Select'
                btn.className = 'btn btn-outline-primary text-primary';

                $('#hidden_emp_id').val($('#hidden_emp_id').val().replace(`${emp_id};`,''))

                $('#modal_emp_id').html(`${$('#modal_emp_id').html().replace(`${emp_id}<br>`,'')}`)

                $('#modal_emp_names').html(`${$('#modal_emp_names').html().replace(`${emp_name}<br>`,'')}`)

                $('#selected_employee_table').html($('#selected_employee_table').html().replace(`<tr>
                    <td>${emp_id}</td>
                    <td><img src="{{ URL::asset('${emp_picture}')}}" class="rounded" width="50" height="50"></td>
                    <td>${emp_name}</td>
                    <td>${emp_department}</td>
                    <td>${emp_position}</td>
                </tr>`,''))
            }
        }
        function updateDeductionDate(){
            var today = new Date();
            $('#deduction_date_input').val(`${today.getFullYear()}-${today.getMonth()+1}-${today.getDate()}`)
        }

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

        function addDeduction(){
            $('#hidden_deduction_date').val($('#deduction_date_input').val())
            $('#hidden_deduction_name').val($('#deduction_name').val())
            $('#hidden_deduction_amount').val($('#deduction_amount').val())

            $('#modal_deduction_date').val($('#deduction_date_input').val())
            $('#modal_deduction_name').val($('#deduction_name').val())
            $('#modal_deduction_amount').val($('#deduction_amount').val())
        }
    </script>
@endsection

