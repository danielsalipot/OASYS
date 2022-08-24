@extends('layout.admin_app')
    @section('content')
    <style>
        input{
            height:24px;
            background-color:transparent;
            letter-spacing: 23px;
        }
    </style>
    <div class="container p-5 mx-auto">
        <div style="background-image: url('/bir1.jpg'); background-size: cover; height:640px; width:850px" class="mx-auto">
            <div class="row " style="height: 130px"></div>
            {{-- First Row --}}
            <div class="row pt-1" style="height: 30px; width:790px; margin-left:48px">
                <div class="col">
                    <input type="text" value="1234" name="ForTheYear" class="border-primary" style="margin-left:120px; width:102px; " maxlength="4">
                </div>
                <div class="col row">
                    <div class="col">
                        <input type="text" value="1234" name="ForThePeriodFrom" class="text-center border-primary" style="margin-left:90px; width:102px;" maxlength="4">
                    </div>

                    <div class="col">
                        <input type="text" value="1234" name="ForThePeriodTo" class="text-center border-primary" style="margin-left:63px; width:102px;" maxlength="4">
                    </div>
                </div>
            </div>

            {{-- Second Row --}}
            <div class="row pt-1 mt-3  p-0" style="height: 307px; width:790px; margin-left:48px">
                <div class="col">

                    {{-- 1ST ROW TIN NUMBER --}}
                    <div class="row">
                        <div class="col">
                            <input type="text" value="123" name="TIN1_3" class="border-primary" style="width:55px; margin-left:65px;letter-spacing:14px" maxlength="3">
                        </div>
                        <div class="col">
                            <input type="text" value="123" name="TIN2_3" class="border-primary" style="width:55px; letter-spacing:14px" maxlength="3">
                        </div>
                        <div class="col">
                            <input type="text" value="123" name="TIN3_3" class="border-primary" style="width:55px; letter-spacing:14px" maxlength="3">
                        </div>
                        <div class="col">
                            <input type="text" value="12345" name="TIN2_5" class="border-primary" style="width:102px; letter-spacing:16px" maxlength="5">
                        </div>
                    </div>
                    {{-- 2ND ROW  EMPLOYEE DETAILS--}}
                    <div class="row mt-1 p-0">
                        <div class="row pt-3 p-0" style="height: 37px; width:410px">
                            <div class="col-10 ps-4">
                                <input type="text" name="EmployeeName" value="Salipot, Daniel Andrei P." class="border border-primary" style="width:304px; letter-spacing:2px" maxlength="37">
                            </div>
                            <div class="col p-0 text-center">
                                <input type="text" name="RDOCode" value="123" class="border border-primary ms-1" style="width:53px; letter-spacing:14px" maxlength="3">
                            </div>
                        </div>

                        <div class="row p-0 w-100 mx-auto" style="height: 37px; margin-top:14px; width:410px">
                            <div class="col-9">
                                <input type="text" name="EmployeeRegisteredAddress" value="Marilao, Bulacan" class="border border-primary ms-1" style="width:304px; letter-spacing:2px" maxlength="37">
                            </div>
                            <div class="col p-0 ps-4">
                                <input type="text" name="RegisteredZIPCode" value="1234"  class="border border-primary ms-3" style="width:70px; letter-spacing:13px" maxlength="4">
                            </div>
                        </div>

                        <div class="row p-0 w-100 mx-auto" style="height: 37px; margin-top:0px; width:410px">
                            <div class="col-9">
                                <input type="text" name="LocalHomeAddress" value="Marilao, Bulacan" class="border border-primary ms-1" style="width:304px; letter-spacing:2px" maxlength="37">
                            </div>
                            <div class="col p-0 ps-4">
                                <input type="text" name="LocalHomeZIPCode" value="1234" class="border border-primary ms-3" style="width:70px; letter-spacing:13px" maxlength="4">
                            </div>
                        </div>

                        <div class="row p-0 w-100 mx-auto" style="height: 37px; margin-top:-2px; width:410px">
                            <div class="col p-0 ps-3">
                                <input type="text" name="ForeignAddress value="Marilao, Bulacan" class="border border-primary" style="width:381px; letter-spacing:2px" maxlength="37">
                            </div>
                        </div>

                        <div class="row p-0 w-100 mx-auto mt-1" style="height: 23px; width:410px">
                            <div class="col-5 p-0 ms-4">
                                <input type="text" name="DateOfBirthMM" value="00" class="border border-primary" style="width:38px; letter-spacing:14px" maxlength="2">
                                <input type="text" name="DateOfBirthDD" value="00" class="border border-primary" style="width:34px; margin-left:-3px; letter-spacing:13px" maxlength="2">
                                <input type="text" name="DateOfBirthYYYY"value="0000" class="border border-primary" style="width:73px; margin-left:-3px; letter-spacing:14px" maxlength="4">
                            </div>
                            <div class="col p-0 ms-3">
                                <input type="text" name="ContactNumber" value="09123456789" class="border border-primary" style="width:201px; letter-spacing:13px" maxlength="11">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">

                </div>
            </div>
        </div>
        <div style="background-image: url('/bir2.jpg'); background-size: cover; height:665px; width:822.5px; margin-left:234.5px"></div>
    </div>
    @endsection
