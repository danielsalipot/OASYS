@extends('layout.employee_app')

@section('title')
@endsection

@section('content')
<div class="row" style="position:fixed; top:0; width:94vw;" >
    <div class="col-2 bg-white p-0" >
        <ul class="nav flex-column alert-light w-100 p-0">
            <li class="nav-item p-0 m-0" style="height: 43px">
                <a class="manual_button nav-link h5 alert-primary" onclick="changeButtonColor(this)" aria-current="page" href="#home">
                    <div class="row text-center">
                        <div class="col-2">
                            <i class="bx bx-home h4 p-0 m-0"></i>
                        </div>
                        <div class="col pt-1 text-start p-0">
                            Home / Dashboard
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="manual_button nav-link text-dark h5" onclick="changeButtonColor(this)" href="#orientation">
                    <div class="row text-center">
                        <div class="col-2">
                            <i class="bi bi-journal-bookmark h4 p-0 m-0"></i>
                        </div>
                        <div class="col pt-1 text-start p-0">
                            Orientation
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="manual_button nav-link text-dark h5" onclick="changeButtonColor(this)" href="#training">
                    <div class="row text-center">
                        <div class="col-2">
                            <i class="bi bi-briefcase-fill h4 p-0 m-0"></i>
                        </div>
                        <div class="col pt-1 text-start p-0">
                            Training
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="manual_button nav-link text-dark h5" onclick="changeButtonColor(this)" href="#correction">
                    <div class="row text-center">
                        <div class="col-2">
                            <i class="bi bi-wrench h4 p-0 m-0"></i>
                        </div>
                        <div class="col pt-1 text-start p-0 pe-0">
                            Correction
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="manual_button nav-link text-dark h5" onclick="changeButtonColor(this)" href="#schedule">
                    <div class="row text-center">
                        <div class="col-2">
                            <i class="bi bi-clock-history h4 p-0 m-0"></i>
                        </div>
                        <div class="col pt-1 text-start p-0">
                            Overtime
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="manual_button nav-link text-dark h5" onclick="changeButtonColor(this)" href="#leave">
                    <div class="row text-center">
                        <div class="col-2">
                            <i class="bi bi-file-earmark-person-fill h4 p-0 m-0"></i>
                        </div>
                        <div class="col pt-1 text-start p-0">
                            Leave
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="manual_button nav-link text-dark h5" onclick="changeButtonColor(this)" href="#messages">
                    <div class="row text-center">
                        <div class="col-2">
                            <i class="bi bi-chat-left-text h4 p-0 m-0"></i>
                        </div>
                        <div class="col pt-1 text-start p-0">
                            Messages
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="manual_button nav-link text-dark h5" onclick="changeButtonColor(this)" href="#profile">
                    <div class="row text-center">
                        <div class="col-2">
                            <i class="bi bi-person-circle h4 p-0 m-0"></i>
                        </div>
                        <div class="col pt-1 text-start p-0">
                            Profile
                        </div>
                    </div>
                </a>
            </li>
        </ul>
    </div>

    <div class="col">
        <div class="card" style="overflow-x: hidden; overflow-y: scroll; height:700px">
            <div class="row p-5"></div><div class="row p-5"></div>
            <h1 class="section-title w-100 text-center mt-1">User Manual</h1>
            <div class="row p-5"></div><div class="row p-5"></div>

            <div id="home" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <h3 class="alert-light p-4">Payroll Dashboard / Home</h3>
                <div class="px-4 mx-5">
                    <h6 class="text-primary">Description</h6>
                    <p class="w-75">The Payroll dashboard is the first page that welcomes the Payroll Manager user. The information that are displayed in this page are the complete Payroll details for the selected cut off date.</p>

                    <br>
                    <h6 class="text-primary">Functions</h6>
                    <p class="w-75" >The functions of the Payroll Dashboard page are listed below:</p>
                    <ul class="ms-5">
                        <li><a class="ps-3 m-3" href="#home/function1">Displaying of Payroll Details</a></li>
                        <li><a class="ps-3 m-3" href="#home/function2">Payroll Summary Creation</a></li>
                        <li><a class="ps-3 m-3" href="#home/function3">Filering of Payroll Details using date filter</a></li>
                    </ul>

                    <br><br>

                    <div id="home/function1">
                        <div class="row my-5">
                            <h4 class="text-primary">Displaying of Payroll Details</h4>
                            <div class="col-3">
                                <br>
                                Just below the page, you will locate the Payroll details Table. The table willthe details of the employee as well as the automatically computed Payroll Details.
                                <br>
                                <br>
                                The payroll details will include Total hours, Rate/hr, Bonus, Gross Pay, SSS, Pag-ibg, Philhealth, Deductions, Cash Advances, Taxable Net, Witholding Tax, and Total Salary.
                            </div>
                            <div class="col">
                                <img src="/manual/payroll/dashboard/function1.jpg" class="w-100">
                            </div>
                        </div>
                        <div class="row mx-5">
                            <div class="col p-3">
                                <h4 class="text-primary">1. Entries Filter</h4>
                                By clicking the Entries filter dropdown element you can select the number of rows to be displayed in the table.
                            </div>
                            <div class="col p-3">
                                <h4 class="text-primary">2. Search Bar</h4>
                                Select the Search bar located on the top right of the table and type your inteded information to be searched. The table will automaticallyall rows with that information
                            </div>
                        </div>
                    </div>

                    <br><br>

                    <div id="home/function2">
                        <div class="row my-5">
                            <h4 class="text-primary">Payroll Summary Creation</h4>
                            <div class="col-3">
                                <br>
                                    The "Payroll Report Generation Buttons" container contains the <b>"current cut off duration"</b>whichthe currently selected cutoff dates.
                                <br>
                                <br>
                                    Below the "current cut off duration" is the <b>"Create Payroll" button</b> which is used to create the Payroll Summary PDF
                                <br>
                                <br>
                                    Below the "Create Payroll" button is the <b>"View Payroll History" button</b> which will redirect the user the the Payroll history</b>
                            </div>
                            <div class="col">
                                <img src="/manual/payroll/dashboard/function2.jpg" class="w-100">
                            </div>
                        </div>
                        <div class="row w-100">
                            <div class="col">
                                <h4 class="text-primary">Create Payroll Button</h4>
                                <div class="row">
                                    <div class="col">
                                        When the Create Payroll button is click, the payroll manager will have to upload there e-signiture that is in png format.
                                    </div>
                                    <div class="col">
                                        <img src="/manual/payroll/dashboard/function2-2.jpg" class="w-100">
                                    </div>
                                </div>

                                <br>

                                <div class="row ms-5">
                                    <ol>
                                        <li>Click the choose file</li>
                                        <li>Then choose your e-signature file</li>
                                        <li>Click "Open"</li>
                                        <li>Then Click the "PDF" button</li>
                                        <li>A window will open, then after the loading, The Payroll summary PDF will be displayed and saved</li>
                                    </ol>
                                </div>
                            </div>
                            <div class="col">
                                <h4 class="text-success">View Payroll History button</h4>
                                By Clicking the View Payroll History button, it will redirect you the the Payroll/Payslip History Page where in you can view generated payrolls and payslips
                                <img src="/manual/payroll/dashboard/function2-3.jpg" class="w-100">
                            </div>
                        </div>
                    </div>

                    <br><br>

                    <div id="home/function3">
                        <h4 class="text-primary">Filering of Payroll Details using date filter</h4>
                        <div class="row">
                            <div class="col">
                                To filter the current cut off duration, you can you the "from date date picker" and the "to date date picker". Click a date picker then a calendar willwhich you can use to select a date. Both date picker should have a date value. After selecting you can click the "filter" button to change the current cut off duration and the payroll details.

                                <br>
                                <br>

                                If you click the "refresh" button it will bring you back to the current cut off date, which is based on the current date and selects the appropriate 15 day duration
                            </div>
                            <div class="col">
                                <img src="/manual/payroll/dashboard/function3.jpg" class="w-100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="orientation" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <h3 class="alert-light p-4">Orientation</h3>
            </div>

            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="training" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <h3 class="alert-light p-4">Training</h3>
            </div>

            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="correction" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <h3 class="alert-light p-4">Correction</h3>
            </div>

            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="overtime" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <h3 class="alert-light p-4">Overtime</h3>
            </div>

            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="leave" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <h3 class="alert-light p-4">Leave</h3>
            </div>

            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="messages" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                @include('inc.common_manual.messages')
            </div>

            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="profile" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                @include('inc.common_manual.profile')
            </div>
        </div>
    </div>
</div>

<script>
    function changeButtonColor(btn){
        console.log(btn)
        var manual_buttons = document.querySelectorAll('.manual_button')
        manual_buttons.forEach(element => {
            element.className = "manual_button nav-link text-dark h5"
        });

        btn.className = "manual_button nav-link h5 alert-primary"
    }
</script>
@endsection
