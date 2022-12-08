@extends('layout.employee_app')
@section('content')
    <div class="row">
        <div class="col">
            <h1 class="section-title mt-2 pb-1">Employee Leave</h1>
        </div>
        <div class="col pt-5 mt-3">
        </div>
    </div>

    <div class="row me-5">
        <div class="container">
            <ul class="container nav nav-tabs mt-5">
                <li class="active"><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#home">Apply for Leave</a></li>
                <li><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#menu1">Leave Cashout</a></li>
                <li><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#menu2">Leave Application History</a></li>
            </ul>

            <div class="tab-content">
                <div id="home" class="tab-pane active ms-2">
                    <form action="/insertEmployeeLeave" method='POST'>
                    <div class="container p-5 border shadow-lg row">
                        <div class="col p-5 card m-2 shadow-sm">
                            @csrf
                            {!! Form::hidden('employee_id', $employee->employee_id) !!}
                            {!! Form::label('', 'Applicant name', ['class'=>'display-6']) !!}
                            {!! Form::text('', $employee->userDetail->fname . ' ' . $employee->userDetail->mname . ' ' . $employee->userDetail->lname , ['class'=>'form-control form-control-lg', 'readonly']) !!}

                            <br>

                            {!! Form::label('title', 'Leave Application Title', ['class'=>'display-6']) !!}
                            {!! Form::text('title', '', ['class'=>'form-control form-control-lg', ]) !!}
                            <span class="text-danger">@error('title'){{"This Field is required"}}@enderror</span>

                            <br>

                            {!! Form::label('detail', 'Leave Application Details', ['class'=>'display-6']) !!}
                            {!! Form::textarea('detail', '', ['class'=>'form-control','rows'=>'20']) !!}
                            <span class="text-danger">@error('detail'){{"This Field is required"}}@enderror</span>
                        </div>
                        <div class="col-5 p-5 card m-2 shadow-sm">
                            <div class="display-6 w-100">Leave Duration</div>
                            <div class="input-daterange py-5">
                                <div class="row h-50">
                                    {!! Form::label('from_date', 'Start Date', ['class'=>'h5']) !!}
                                    <input type="text" name="from_date" id="from_date" class="form-control py-2 h-75" placeholder="From Date" readonly onchange="dateonchange()"/>
                                    <span class="text-danger">@error('from_date'){{"This Field is required"}}@enderror</span>
                                </div>

                                <div class="row h-50">
                                    {!! Form::label('to_date', 'End Date', ['class'=>'h5 mt-5']) !!}
                                    <input type="text" name="to_date" id="to_date" class="form-control h-75 py-2" placeholder="To Date" readonly onchange="dateonchange()"/>
                                    <span class="text-danger">@error('to_date'){{"This Field is required"}}@enderror</span>
                                </div>
                            </div>
                            <div class="row my-5">
                                <div class="col-6">
                                    {!! Form::label('days', 'Days', ['class'=>'h5 mt-3']) !!}
                                    <input type="text" name="days" id="days_display" class="form-control text-center" readonly value='0'>
                                </div>
                                <div class="col"></div>
                                <div class="col-4 alert-primary h-100 text-center p-1 m-0 rounded">
                                    <h6 class="alert-light w-100 p-2 rounded">Remaining Leave Days</h6>
                                    <h4 class="h-100 p-2" id="remaining_days">{{$employee->leave_days - + $total_cashout_days - count($applied_leaves) - count($unapplied_leaves) - $total_to_be_approved}}</h4>
                                </div>
                            </div>
                            <div class="row mb-0" style="margin-top:22vh;">
                                <div class="col">
                                    <button type='submit' id="send_application" disabled class="btn btn-success btn-lg w-100 p-3 "> Send Application</button>
                                </div>
                                <div class="col">
                                    <button class="btn btn-danger w-100 btn-lg p-3" onclick="location.reload()"> Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div id="menu1" class="tab-pane">
                    <div class="container p-5 border shadow-lg">
                        <div class="row w-100 mx-auto my-5">
                            <div class="row w-100 m-auto">
                                <div class="col-3 text-center h-100 p-0">
                                    <h5 class="p-3 alert-light shadow-sm">Remaining Leaves</h5>
                                    <h1 class="display-1 py-5 w-100 h-100 bg-primary text-white shadow-sm rounded-bottom" id="remaining_days">{{$employee->leave_days - $total_to_be_approved - count($applied_leaves) - count($unapplied_leaves) }}</h4>
                                </div>
                                <div class="col text-center">
                                    <h5 class="p-3 alert-light shadow-sm w-50 m-auto">Leaves to Cashout</h5>

                    <form action="/LeaveCashoutInsert" method='POST'>
                                    @csrf
                                    <div class="row w-50 m-auto mb-3 p-0">
                                        <div class="col-2 p-0">
                                            <button type="button" onclick="number_spinner_click('-')" class="btn btn-outline-primary w-100 py-4 w-100 rounded-0 rounded-start">-</button>
                                        </div>
                                        <div class="col p-0">
                                            {!! Form::text('cashout_leave_number', '0', ['class'=>['form-control text-center w-100 h-100 rounded-0', 'disabled'],'id'=>'cashout_leave_number']) !!}
                                        </div>
                                        <div class="col-2 p-0">
                                            <button type="button" onclick="number_spinner_click('+')" class="btn btn-outline-primary w-100 py-4 w-100 rounded-0 rounded-end">+</button>
                                        </div>
                                    </div>
                                    <script>
                                        function number_spinner_click(operator){
                                            var num = document.getElementById('cashout_leave_number')
                                            var total_display = document.getElementById('total_display')

                                            if(operator == '+'){
                                                if(parseInt(num.value) < '{{ $employee->leave_days - count($applied_leaves) - count($unapplied_leaves) - $total_to_be_approved }}'){
                                                    num.value = parseInt(num.value) + 1
                                                }
                                            }else{
                                                if(parseInt(num.value) > 0){
                                                    num.value = parseInt(num.value) - 1
                                                }
                                            }

                                            var date2 = new Date('2000-01-01 ' + '{{$employee->schedule_Timein}}')
                                            var date1 = new Date('2000-01-01 ' + '{{$employee->schedule_Timeout}}')
                                            var hours = Math.abs(date1 - date2) / 36e5
                                            var total = ('{{$employee->rate}}' * parseInt(num.value)) * hours;
                                            total_display.innerHTML = `₱${ (Math.round((total + Number.EPSILON) * 100) / 100).toLocaleString("en-US")}`;
                                        }
                                    </script>
                                    <div class="row w-50 shadow-sm m-auto">
                                        <div class="col-4 p-0">
                                            <h5 class="p-2 alert-success shadow-sm w-100 m-auto">Rate</h5>
                                            <h5 class="text-success text-center my-4">₱{{$employee->rate}}/hr</h5>
                                        </div>
                                        <div class="col p-0">
                                            <h5 class="p-2 alert-success shadow-sm w-100 m-auto">Total Cashout</h5>
                                            <h5 id="total_display" class="text-white text-center m-0 py-4 bg-success">₱0.00</h5>
                                        </div>
                                    </div>

                                    <button type='submit' class="btn btn-success btn-lg w-50 mt-4 p-4 m-auto"> Send Cashout Application</button>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="menu2" class="tab-pane">
                    <div class="container p-5 border shadow-lg">
                        <div class="row w-100 mx-auto my-5">
                            <div class="col shadow-sm p-0 m-3">
                                <h5 class="w-100 text-center alert-primary p-3">Leave Days of {{ date('Y') }}</h5>
                                <div class="row m-2">
                                    <div class="col card mx-2 bg-primary text-white">
                                        <h6 class="w-100 p-2 text-center">Total</h6>
                                        <h3 class="w-100 text-center">{{ $total_to_be_approved + count($unapplied_leaves) + count($applied_leaves) + $total_cashout_days}}  / {{ $employee->leave_days }}</h4>
                                    </div>
                                    <div class="col card mx-2">
                                        <h6 class="alert-light w-100 p-2 text-warning text-center">Pending</h6>
                                        <h1 class="w-100 text-center text-warning">{{ $total_to_be_approved }}</h1>
                                    </div>
                                    <div class="col card mx-2">
                                        <h6 class="alert-light w-100 p-2 text-success text-center">Applied</h6>
                                        <h1 class="w-100 text-center text-success">{{ count($applied_leaves) }}</h1>
                                    </div>
                                    <div class="col card mx-2">
                                        <h6 class="alert-light w-100 p-2 text-info text-center">Unapplied</h6>
                                        <h1 class="w-100 text-center text-info">{{ count($unapplied_leaves) }}</h1>
                                    </div>
                                    <div class="col card mx-2 bg-success">
                                        <h6 class="w-100 p-2 text-white text-center">Cashout</h6>
                                        <h1 class="w-100 text-center text-white">{{ $total_cashout_days }}</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1"></div>
                            <div class="col-2 shadow-sm p-0 m-3">
                                <h5 class="w-100 text-center alert-light p-3">Number of Application</h5>
                                <div class="row m-2">
                                    <div class="col card mx-2">
                                        <h6 class="alert-light w-100 p-2 text-center">Total</h6>
                                        <h1 class="w-100 text-center">{{ $total_count[0] }}</h1>
                                    </div>
                                    <div class="col card mx-2">
                                        <h6 class="alert-light w-100 p-2 text-center">This Year</h6>
                                        <h1 class="w-100 text-center">{{ $total_count[1] }}</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 shadow-sm p-0 m-3">
                                <h5 class="w-100 text-center alert-light p-3">Approved Application</h5>
                                <div class="row m-2">
                                    <div class="col card mx-2">
                                        <h6 class="alert-light w-100 p-2 text-center">Total</h6>
                                        <h1 class="w-100 text-center">{{ $approved_count[0] }}</h1>
                                    </div>
                                    <div class="col card mx-2">
                                        <h6 class="alert-light w-100 p-2 text-center">This Year</h6>
                                        <h1 class="w-100 text-center">{{ $approved_count[1] }}</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 shadow-sm p-0 m-3">
                                <h5 class="w-100 text-center alert-light p-3">Denied Application</h5>
                                <div class="row m-2">
                                    <div class="col card mx-2">
                                        <h6 class="alert-light w-100 p-2 text-center">Total</h6>
                                        <h1 class="w-100 text-center">{{ $denied_count[0] }}</h1>
                                    </div>
                                    <div class="col card mx-2">
                                        <h6 class="alert-light w-100 p-2 text-center">This Year</h6>
                                        <h1 class="w-100 text-center">{{ $denied_count[1] }}</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container my-3">
                        <script>
                            let difference,TotalDays
                        </script>
                        @foreach ($leave_cashout_application as $data)
                            <div class="row h-100 shadow-sm my-3">
                                <div class="col w-100 h-100 text-center alert-success rounded-start">
                                    <h3 class="py-5">Cashout Application</h3>
                                </div>
                                <div class="col h-100 p-0">
                                    <h5 class="alert-success text-center w-100 p-3">Cashout Details</h5>
                                    <div class="row">
                                        <div class="col">
                                            <h6 class="w-100 text-center alert-light p-2">Number of Leave Days</h6>
                                            <h1 class="w-100 text-center">{{ $data->leave_days }}</h1>
                                        </div>
                                        <div class="col text-center">
                                            <h6 class="w-100 text-center alert-light p-2">Employee Rate</h6>
                                            <h3 class="text-success">₱{{ $employee->rate }}/hr</h3>
                                        </div>
                                    </div>
                                    <div class="row mt-4 text-center">
                                        <h6 class="w-100 text-center alert-light p-2">Total Payout</h6>
                                        <h1 class="text-success">₱{{ number_format($data->total_cashout) }}</h1>
                                    </div>
                                </div>
                                <div class="col h-100">
                                    <div class="display-6 alert-light mb-4 text-center">Application Status</div>
                                    @if (!isset($data->approval_status))
                                        <div class="text-center m-3 p-3">
                                            <h1 style="font-size:70px"><i class="bi bi-file-earmark-minus"></i></h1>
                                            <p>No Approvals Yet</p>
                                        </div>
                                        <form action="/deleteCashoutApplication" class="w-100 p-3 text-center" method="POST">
                                            @csrf
                                            {!! Form::hidden('id', $data->id) !!}
                                            <button type="submit" class='btn btn-outline-danger w-100 btn-lg'>Cancel Cashout Application</button>
                                        </form>
                                    @else
                                        @if ($data->approval_status)
                                            <div class="card shadow-sm m-3 text-center shadow-sm alert-primary">
                                                <h1 style="font-size:70px"><i class="bi bi-file-earmark-check"></i></h1>
                                                <h3>Approved</h3>
                                                <div class="w-100 mt-3 p-2 alert-light">
                                                    <p class="p-0 m-0">Approved by: {{ $data->manager->fname }} {{ $data->manager->mname }} {{ $data->manager->lname }}</p>
                                                    <p class="p-0 m-0">Approved on: {{ $data->approval_date }}</p>
                                                </div>
                                            </div>
                                        @else
                                        <div class="card shadow-sm m-3 text-center shadow-sm alert-danger">
                                            <h1 style="font-size:70px"><i class="bi bi-file-earmark-x-fill"></i></h1>
                                            <h3>Disapproved</h3>
                                            <div class="w-100 mt-3 p-2 alert-light">
                                                <p class="p-0 m-0">Approved by: {{ $data->manager->fname }} {{ $data->manager->mname }} {{ $data->manager->lname }}</p>
                                                <p class="p-0 m-0">Approved on: {{ $data->approval_date }}</p>
                                            </div>
                                        </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        @foreach ($applications as $data)
                            <div class="row">
                                <div class="col card shadow-sm p-4 rounded-0 rounded-start">
                                    <div class="display-6 alert-light mb-4">Application Letter</div>
                                    <h6 class='text-secondary'>Title</h6>
                                    <h1>{{ $data->title }}</h1>
                                    <h6 class='text-secondary'>Body</h6>
                                    <p class="" style="font-size: 12px; text-align:justify;">{{ $data->detail }}</p>
                                </div>
                                <div class="col card shadow-sm p-4 rounded-0">
                                    <div class="display-6 alert-light mb-4">Leave Details</div>

                                    <h6 class='text-secondary'>Start Date</h6>
                                    <input type="text" name="" id="" class='form-control form-control-lg mb-4' readonly value="{{ $data->start_date }}">

                                    <h6 class='text-secondary'>End Date</h6>
                                    <input type="text" name="" id="" class='form-control form-control-lg mb-4' readonly value="{{ $data->end_date }}">

                                    <h6 class='text-secondary'>Number of Days</h6>
                                    <input type="text" name="" id="applied_days{{$data->id}}" class='form-control form-control-lg mb-4' readonly value="">

                                    <script>
                                        difference = new Date("{{ $data->end_date }}").getTime() - new Date("{{ $data->start_date }}").getTime();
                                        TotalDays = Math.ceil(difference / (1000 * 3600 * 24));

                                        document.getElementById('applied_days{{$data->id}}').value = TotalDays + 1
                                    </script>
                                </div>
                                <div class="col card shadow-sm p-4 rounded-0 rounded-end">
                                    <div class="display-6 alert-light mb-4">Application Status</div>
                                    @if (!isset($data->status))
                                        <div class="text-center m-3 p-3">
                                            <h1 style="font-size:70px"><i class="bi bi-file-earmark-minus"></i></h1>
                                            <p>No Approvals Yet</p>
                                        </div>
                                        <form action="/deleteEmployeeLeave" class="w-100 p-3 text-center" method="POST">
                                            @csrf
                                            {!! Form::hidden('id', $data->id) !!}
                                            <button type="submit" class='btn btn-outline-danger w-100 btn-lg'>Cancel Application</button>
                                        </form>
                                    @else
                                        @if ($data->status)
                                            <div class="card shadow-sm m-3 text-center shadow-sm alert-primary">
                                                <h1 style="font-size:70px"><i class="bi bi-file-earmark-check"></i></h1>
                                                <h3>Approved</h3>
                                                <div class="w-100 mt-3 p-2 alert-light">
                                                    <p class="p-0 m-0">Approved by: {{ $data->manager->fname }} {{ $data->manager->mname }} {{ $data->manager->lname }}</p>
                                                    <p class="p-0 m-0">Approved on: {{ $data->approval_date }}</p>
                                                </div>
                                            </div>
                                        @else
                                        <div class="card shadow-sm m-3 text-center shadow-sm alert-danger">
                                            <h1 style="font-size:70px"><i class="bi bi-file-earmark-x-fill"></i></h1>
                                            <h3>Disapproved</h3>
                                            <div class="w-100 mt-3 p-2 alert-light">
                                                <p class="p-0 m-0">Approved by: {{ $data->manager->fname }} {{ $data->manager->mname }} {{ $data->manager->lname }}</p>
                                                <p class="p-0 m-0">Approved on: {{ $data->approval_date }}</p>
                                            </div>
                                        </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('.input-daterange').datepicker({
            todayBtn:'linked',
            format:'yyyy-mm-dd',
            autoclose:true
        });

        function dateonchange(){
            var from_date = new Date(document.getElementById('from_date').value)
            var to_date = new Date(document.getElementById('to_date').value)

            let difference = to_date.getTime() - from_date.getTime();
            let TotalDays = Math.ceil(difference / (1000 * 3600 * 24));

            document.getElementById('days_display').value = TotalDays + 1

            var remaining_days =  document.getElementById('remaining_days')
            remaining_days.innerHTML = '{{$employee->leave_days - + $total_cashout_days - count($applied_leaves) - count($unapplied_leaves)}}' - TotalDays

            if('{{$employee->leave_days - count($applied_leaves) - count($unapplied_leaves)}}' - TotalDays >= 0){
                document.getElementById('send_application').disabled = false
            }else{
                document.getElementById('send_application').disabled = true
            }
        }
    </script>
@endsection
