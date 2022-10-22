@extends('layout.payroll_app')

@section('title')
@endsection

@section('content')
<div class="row" style="position:fixed; top:0; width:93vw;" >
    <div class="col-2 bg-white p-0" >
        <ul class="nav flex-column alert-light w-100 p-0">
            <li class="nav-item p-0 m-0" style="height: 43px">
                <a class="manual_button nav-link h5 alert-primary" onclick="changeButtonColor(this)" aria-current="page" href="#home">
                    <div class="row text-center">
                        <div class="col-2">
                            <i class="bx bx-home h4 p-0 m-0"></i>
                        </div>
                        <div class="col pt-1 text-start">
                            Payroll Dashboard / Home
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="manual_button nav-link text-dark h5" onclick="changeButtonColor(this)" href="#salary">
                    <div class="row text-center">
                        <div class="col-2">
                            <i class="bi bi-person-lines-fill h4 p-0 m-0"></i>
                        </div>
                        <div class="col pt-1 text-start">
                            Salary Management
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="manual_button nav-link text-dark h5" onclick="changeButtonColor(this)" href="#deduction">
                    <div class="row text-center">
                        <div class="col-2">
                            <i class="bi bi-calculator h4 p-0 m-0"></i>
                        </div>
                        <div class="col pt-1 text-start">
                            Deductions
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="manual_button nav-link text-dark h5" onclick="changeButtonColor(this)" href="#overtime">
                    <div class="row text-center">
                        <div class="col-2">
                            <i class="bi bi-clock h4 p-0 m-0"></i>
                        </div>
                        <div class="col pt-1 text-start">
                            Overtime
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="manual_button nav-link text-dark h5" onclick="changeButtonColor(this)" href="#cashAdvance">
                    <div class="row text-center">
                        <div class="col-2">
                            <i class="bi bi-cash-stack h4 p-0 m-0"></i>
                        </div>
                        <div class="col pt-1 text-start">
                            Cash Advance
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="manual_button nav-link text-dark h5" onclick="changeButtonColor(this)" href="#contributions">
                    <div class="row text-center">
                        <div class="col-2">
                            <i class="bi bi-wallet h4 p-0 m-0"></i>
                        </div>
                        <div class="col pt-1 text-start">
                            Contributions
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="manual_button nav-link text-dark h5" onclick="changeButtonColor(this)" href="#bonus">
                    <div class="row text-center">
                        <div class="col-2">
                            <i class="bi bi-coin h4 p-0 m-0"></i>
                        </div>
                        <div class="col pt-1 text-start">
                            Employee Bonus
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="manual_button nav-link text-dark h5" onclick="changeButtonColor(this)" href="#multipay">
                    <div class="row text-center">
                        <div class="col-2">
                            <i class="bi bi-check-all h4 p-0 m-0"></i>
                        </div>
                        <div class="col pt-1 text-start">
                            Multi Pay
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="manual_button nav-link text-dark h5" onclick="changeButtonColor(this)" href="#holidays">
                    <div class="row text-center">
                        <div class="col-2">
                            <i class="bbi bi-calendar-event h4 p-0 m-0"></i>
                        </div>
                        <div class="col pt-1 text-start">
                            Holiday
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="manual_button nav-link text-dark h5" onclick="changeButtonColor(this)" href="#leave">
                    <div class="row text-center">
                        <div class="col-2">
                            <i class="bi bi-person-dash h4 p-0 m-0"></i>
                        </div>
                        <div class="col pt-1 text-start">
                            Leave
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="manual_button nav-link text-dark h5" onclick="changeButtonColor(this)" href="#audit">
                    <div class="row text-center">
                        <div class="col-2">
                            <i class="bi bi-list-check h4 p-0 m-0"></i>
                        </div>
                        <div class="col pt-1 text-start">
                            Audit Logs
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="manual_button nav-link text-dark h5" onclick="changeButtonColor(this)" href="#approvals">
                    <div class="row text-center">
                        <div class="col-2">
                            <i class="bi bi-file-earmark-check h4 p-0 m-0"></i>
                        </div>
                        <div class="col pt-1 text-start">
                            Approvals
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="manual_button nav-link text-dark h5" onclick="changeButtonColor(this)" href="#employeelist">
                    <div class="row text-center">
                        <div class="col-2">
                            <i class="bi bi-people-fill h4 p-0 m-0"></i>
                        </div>
                        <div class="col pt-1 text-start">
                            Employee List
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
                        <div class="col pt-1 text-start">
                            Profile
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
                        <div class="col pt-1 text-start">
                            Messages
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="manual_button nav-link text-dark h5" onclick="changeButtonColor(this)" href="#notifications">
                    <div class="row text-center">
                        <div class="col-2">
                            <i class="bi bi-bell h4 p-0 m-0"></i>
                        </div>
                        <div class="col pt-1 text-start">
                            Notification
                        </div>
                    </div>
                </a>
            </li>
        </ul>
    </div>

    <div class="col">
        <div class="card" style="overflow-x:hidden; overflow-y: scroll; height:700px">
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
                                        When the Create Payroll button is click, the payroll manager will have to upload there e-signature that is in png format.
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
            <div id="salary" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <h3 class="alert-light p-4">Salary Management</h3>
                <div class="px-4 mx-5">
                    <h6 class="text-primary">Description</h6>
                    <p class="w-75">The Salary Management module is the page where in the payroll manager will be able to view the Rate/hr of employees, view the top earners of each position, and change the Rate/hr of an employee</p>

                    <br>
                    <h6 class="text-primary">Functions</h6>
                    <p class="w-75" >The functions of the Salary Management Module page are listed below:</p>
                    <ul class="ms-5">
                        <li><a class="ps-3 m-3" href="#salary/function1">Average Salary of Positions</a></li>
                        <li><a class="ps-3 m-3" href="#salary/function2">View employees salary</a></li>
                        <li><a class="ps-3 m-3" href="#salary/function3">Edit Rate per hour of employee</a></li>
                    </ul>

                    <br><br>

                    <div id="salary/function1">
                        <div class="row my-5">
                            <h4 class="text-primary">Average Salary of Positions</h4>
                            <img src="/manual/payroll/salary/function1.jpg" class="w-100">
                            Located at the top of the Salary Management Page is the summary of all the salary of each positions. In thi section, the payroll manager will be able to see the avarage salary of each position as well as the top earners of each position.
                        </div>
                    </div>

                    <br><br>

                    <div id="salary/function2">
                        <div class="row my-5">
                            <h4 class="text-primary">View employees salary</h4>
                            <img src="/manual/payroll/salary/function2.jpg" class="w-100">
                            Located just below the "Average Salary of Positions" section, will be the Employee Salary table. This table willsome basic information of employees as well as there Rate/hr. The payroll manager can use the search bar and entries filter to change the view of the table.
                        </div>
                    </div>

                    <br><br>

                    <div id="salary/function3">
                        <h4 class="text-primary">Edit Rate per hour of employee</h4>
                        <div class="row">
                            <div class="col">
                                In the "Employee Salary Table", in the edit column is where the "Edit Rate" button and "Profile" button is located. By click the "Edit Rate" button, a dialog box will appear on the screen.
                            </div>
                            <div class="col-8">
                                <img src="/manual/payroll/salary/4.jpg" class="w-100">
                            </div>
                        </div>

                        <br><br><br>

                        <div class="row">
                            <div class="col">
                                After click the "Edit Rate", this dialog box will appear. In the dialog box, the rate textbox is located and you can change the value of it and then by clicking "Save" you will be able to change the Rate/hr of that employee.
                            </div>
                            <div class="col-8">
                                <img src="/manual/payroll/salary/function3.jpg" class="w-100">
                            </div>
                        </div>
                    </div>
            </div>

            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="deduction" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <h3 class="alert-light p-4">Deductions</h3>

                <div class="px-4 mx-5">
                    <h6 class="text-primary">Description</h6>
                    <p class="w-75">The Deduction Management page is the module where in the payroll manager will be able to add and remove deductions to employees. This deductions are to be paid in the duration that was selected and will be equally split in the amount of days that was given and that amount will be automatically deducted to the employees salary each day.</p>

                    <br>
                    <h6 class="text-primary">Functions</h6>
                    <p class="w-75" >The functions of the Deduction Management page are listed below:</p>
                    <ul class="ms-5">
                        <li><a class="ps-3 m-3" href="#deductions/function1">View and filter Deductions</a></li>
                        <li><a class="ps-3 m-3" href="#deductions/function2">Delete Deductions</a></li>
                        <li><a class="ps-3 m-3" href="#deductions/function3">Add Deductions </a></li>
                    </ul>

                    <br><br>

                    <div id="deductions/function1">
                        <div class="row my-5">
                            <h4 class="text-primary">View and filter Deductions</h4>
                            <img src="/manual/payroll/deductions/1.jpg" class="w-100">
                            Shown above is the Deductions Table. Using the date filter that is located above, you can filter that deductions that are within a specific period and view their details. In the table you will be able the deduction details as well as some basic information about the employee that was applied with the deduction.
                    </div>

                    <br><br>

                    <div id="deductions/function2">
                        <div class="row my-5">
                            <h4 class="text-primary">Delete Deductions</h4>
                            <div class="col">
                                <ul>
                                    <li class="p-5">Located in the Delete Column of the Deductions Table you will find the "Remove" buttons of each deduction.</li>
                                    <li class="p-5">By clicking the Remove button, you will be promted with a dialog box which confirms your deletion of that dedution.</li>
                                    <li class="p-5">If the "OK" button was clicked, the deduction will be remove on that payroll.</li>
                                </ul>

                            </div>
                            <div class="col">
                                <img src="/manual/payroll/deductions/6.jpg" class="w-100">
                                <img src="/manual/payroll/deductions/7.jpg" class="w-100">
                            </div>
                        </div>
                    </div>

                    <br><br>

                    <div id="deductions/function3">
                        <h4 class="text-primary">Add Deduction</h4>
                        <img src="/manual/payroll/deductions/2.jpg" class="w-100">
                        This is the Add deduction module. In this module you can select employees, add deductions details, and save the deduction for the payroll.
                        <br><br>
                        Adding Deduction involves three steps:
                        <ol>
                            <li><b>Selecting Employees</b></li>
                            <div class="row">
                                <div class="col">
                                    In the Employee selection table, you will be able to search, filter employees, and select employees by clicking the "select" button beside the employee details.
                                    The button will show green if the employee is selected.
                                    <img src="/manual/payroll/deductions/3.jpg" class="w-100">
                                </div>
                                <div class="col">
                                    You can confirm that the employee is selected if it is added in the "Selected Employees" Table
                                    <img src="/manual/payroll/deductions/4.jpg" class="w-100">
                                </div>
                            </div>
                            <br><br>
                            <li><b>Adding Deduction Details</b></li>
                            <div class="row">
                                <div class="col">
                                    After Selecting employees for the deduction, the payroll manager will need to add the deduction period, deduction name, and the deduction amoumt. After adding the deduction details, the payroll manager will click the "Add deduction" button.
                                </div>
                                <div class="col">
                                    <img src="/manual/payroll/deductions/5.jpg" class="w-100">
                                </div>
                            </div>
                            <br><br>
                            <li><b>Clicking "Add deduction" button</b></li>
                            <div class="row">
                                <div class="col">
                                    After clicking the "Add deduction" button, a prompt will appear which confirms the selected employees and the deduction details. By clicking the "Confirm Deduction" button, the deduction will be added.
                                </div>
                                <div class="col">
                                    <img src="/manual/payroll/deductions/8.jpg" class="w-100">
                                </div>
                            </div>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="overtime" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <h3 class="alert-light p-4">Overtime</h3>
                <div class="px-4 mx-5">
                    <h6 class="text-primary">Description</h6>
                    <p class="w-75">The Overtime Management is the module where in you will be able to view all of overtime attendance, all of overtime application, pay overtime, approve or deny overtime applications, remove overtime records and denied overtime applications</p>

                    <br>
                    <h6 class="text-primary">Functions</h6>
                    <p class="w-75" >The functions of the Overtime Management page are listed below:</p>
                    <ul class="ms-5">
                        <li><a class="ps-3 m-3" href="#overtime/function1">Display Overtime Records and Overtime Application</a></li>
                        <li><a class="ps-3 m-3" href="#overtime/function2">Pay Overtime/ Approve Application</a></li>
                        <li><a class="ps-3 m-3" href="#overtime/function3">Deny Overtime Application</a></li>
                        <li><a class="ps-3 m-3" href="#overtime/function4">Remove Paid Overtime</a></li>
                        <li><a class="ps-3 m-3" href="#overtime/function5">Recover denied Application</a></li>
                    </ul>

                    <br><br>

                    <div id="overtime/function1">
                        <div class="row my-5">
                            <h4 class="text-primary">Display Overtime Records and Overtime Application</h4>
                                The overtime table contains all of the attendance that exceeded their total hours of work. The table contains the basic information of the employee, the details of the attendance, the total exceeded hours, and the application details.
                                <img src="/manual/payroll/overtime/1.jpg" class="w-100">
                        </div>
                    </div>

                    <br><br>

                    <div id="overtime/function2">
                        <div class="row my-5">
                            <h4 class="text-primary">Pay Overtime/ Approve Application</h4>
                            <div class="col-3">
                                To pay overtime and to approve application, the payroll manager will have to click the "Pay overtime" button. after click a dialog box will show which will confirm the Overtime details. By clicking "Pay Overtime" button, the payment for the overtime will be recorded.                         </div>
                            <div class="col">
                                <img src="/manual/payroll/overtime/3.jpg" class="w-100">
                            </div>
                        </div>
                    </div>

                    <br><br>

                    <div id="overtime/function3">
                        <h4 class="text-primary">Deny Overtime Application</h4>
                        <div class="row">
                            <div class="col">
                                The records on the Overtime table which as an overtime application, will have a deny button below the "Pay overtime" button. By clicking the "Deny" button the overtime application will be denied.
                            </div>
                            <div class="col">
                                <img src="/manual/payroll/overtime/6.jpg" class="w-100">
                            </div>
                        </div>
                    </div>

                    <br><br>

                    <div id="overtime/function4">
                        <h4 class="text-primary">Remove Paid Overtime</h4>
                        <div class="row">
                            <img src="/manual/payroll/overtime/4.jpg" class="w-100">
                            In the Remove Paid Overtime tab, you will be able to see the "Paid overtime" table. In the Paid overtime table, you will be able to select paid overtime records. By clicking "Remove overtime" button, the record will be remove from paid overtime.
                        </div>

                        <br><br>

                        <div class="row">
                            <div class="col">
                                After clicking the Remove Overtime, a dialog box will appear which will confirm the selected paid overtime record that will be remove. if the "Remove Overtime" button in the dialog box is clicked, the record will be remove.
                            </div>
                            <div class="col">
                                <img src="/manual/payroll/overtime/7.jpg" class="w-100">
                            </div>
                        </div>
                    </div>

                    <br><br>

                    <div id="overtime/function5">
                        <h4 class="text-primary">Recover denied Application</h4>
                        <div class="row">
                            <div class="col">
                                There might be instances where denied application needs to be recovered for another evaluation of the application. In the Denied Overtime Application tab, the payroll manager will be able to see all denied application. They can then recover the application by clicking the recover button in the last column of the table.
                            </div>
                            <div class="col">
                                <img src="/manual/payroll/overtime/5.jpg" class="w-100">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row p-5"></div><div class="row p-5"></div>
            <div id="cashAdvance" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <h3 class="alert-light p-4">Cash Advance</h3>
                <div class="px-4 mx-5">
                    <h6 class="text-primary">Description</h6>
                    <p class="w-75">The Cash Advance Management is the module where in the payroll manager will be able to view and filter all cash advance records and add new cash advance records.</p>

                    <br>
                    <h6 class="text-primary">Functions</h6>
                    <p class="w-75" >The functions of the Cash Advance Management page are listed below:</p>
                    <ul class="ms-5">
                        <li><a class="ps-3 m-3" href="#cashAdvance/function1">View and Filter Cash Advance Records</a></li>
                        <li><a class="ps-3 m-3" href="#cashAdvance/function2">Remove Cash Advance Records</a></li>
                        <li><a class="ps-3 m-3" href="#cashAdvance/function3">Add new Cash Advance Record</a></li>
                    </ul>

                    <br><br>

                    <div id="cashAdvance/function1">
                        <div class="row my-5">
                            <h4 class="text-primary">View and Filter Cash Advance Records</h4>
                            <div class="col-4">
                                The Cash Advance Table displays all the Cash Advance Record with the employee details and the cash advance details.
                                Using the date filter above the payroll manager will be able to view records on the selected period of date.
                                The manager can use the search bar and the entries filter to change the view of the table and search tbro<br>ugh the records.
                            </div>
                            <div class="col">
                                <img src="/manual/payroll/cashAdvance/1.jpg" class="w-100">
                            </div>
                        </div>
                    </div>

                    <br><br>

                    <div id="cashAdvance/function2">
                        <div class="row my-5">
                            <h4 class="text-primary">Remove Cash Advance Records</h4>
                            <div class="col">
                                Within the records in the Cash Advance table, the payroll manager will find the "Remove" button for each Cash Advance record.
                            </div>
                            <div class="col">
                                <img src="/manual/payroll/cashAdvance/3.jpg" class="w-100">
                            </div>
                        </div>
                        <div class="row w-100">
                            By clicking the remove button, a dialog box will show, which will confirm the removal of the record. If the "Ok" button was clicked, then the record will be remove
                            <br>
                            <img src="/manual/payroll/cashAdvance/2.jpg" class="w-100">
                        </div>
                    </div>

                    <br><br>

                    <div id="cashAdvance/function3">
                        <h4 class="text-primary">Add new Cash Advance Record</h4>
                        <img src="/manual/payroll/cashAdvance/4.jpg" class="w-100">
                        This is the Add Cash Advance module. In this module you can select employees, add Cash Advances details, and save the Cash Advance for the payroll.
                        <br><br>
                        Adding Cash Advance involves three steps:
                        <ol>
                            <li><b>Selecting Employees</b></li>
                            <div class="row">
                                <div class="col">
                                    In the Employee selection table, you will be able to search, filter employees, and select employees by clicking the "select" button beside the employee details.
                                    The button will show green if the employee is selected.
                                    <img src="/manual/payroll/cashAdvance/5.jpg" class="w-100">
                                </div>
                                <div class="col">
                                    You can confirm that the employee is selected if it is added in the "Selected Employees" Table
                                    <img src="/manual/payroll/cashAdvance/6.jpg" class="w-100">
                                </div>
                            </div>
                            <br><br>
                            <li><b>Adding Cash Advance Details</b></li>
                            <div class="row">
                                <div class="col">
                                    After Selecting employees for the Cash Advance, the payroll manager will need to add the Cash Advance date and the Cash Advance amoumt. After adding the Cash Advance details, the payroll manager will click the "Add Cash Advance" button.
                                </div>
                                <div class="col">
                                    <img src="/manual/payroll/cashAdvance/7.jpg" class="w-100">
                                </div>
                            </div>
                            <br><br>
                            <li><b>Clicking "Add Cash Advance" button</b></li>
                                <div class="row">
                                    <div class="col">
                                        After clicking the "Add Cash Advance" button, a prompt will appear which confirms the selected employees and the Cash Advance details. By clicking the "Confirm Cash Advance" button, the cash advance will be added.
                                    </div>
                                    <div class="col">
                                        <img src="/manual/payroll/cashAdvance/8.jpg" class="w-100">
                                    </div>
                                </div>
                            </div>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="contributions" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <h3 class="alert-light p-4">Contribution</h3>
                <div class="px-4 mx-5">
                    <h6 class="text-primary">Description</h6>
                    <p class="w-75">The Contribution Management is the module where in the payroll manager can manage the variables that are use to automatically calculate the employee legal contributions. This module also provides the estimations of the employee and employer contributions. Contributions module provides tool to exclude and include employees in the legal contributions</p>

                    <br>
                    <h6 class="text-primary">List of covered Legal Contributions</h6>
                    <p class="w-75" >The functions of the Contribution Management page are listed below:</p>
                    <ul class="ms-5">
                        <li><a class="ps-3 m-3" href="#contributions/sss">SSS Contribution</a></li>
                        <li><a class="ps-3 m-3" href="#contributions/pagibig">Pagibig Contribution</a></li>
                        <li><a class="ps-3 m-3" href="#contributions/philhealth">Philhealth Contribution</a></li>
                    </ul>

                    <br><br>

                    <div id="contributions/sss">
                        <div class="row my-5">
                            <h4 class="text-primary">SSS Contribution</h4>
                            The SSS contribution is a legal contribution where in the employers and SSS member employees pays regularly in order to for the SSS can take advantage of maternity, sickness, disability, retirement, funeral and death benefits. SSS offers a variety of benefits to qualified members, including the ability to take up salary, housing, business, and educational loans.
                            <br>
                            <br>
                            <b>This module Includes the following functions:</b>
                            <ul>
                                <li><h4 class="text-primary">Variable Management</h4></li>
                                <div class="row ms-5">
                                    <p>
                                        This module provides tool for the payroll manager to change the SSS computation variables when changes occurs.
                                        In the "SSS Contribution Details" you will see the controls to change the variable.
                                        By default, the input are disabled to prevent mistakes. Beside the SSS Contribution details will be the instructions to easily understand what the variables are.
                                        <ol class="ms-5">
                                            <li>To enable the input in order to change the variables, the "<i class="bi bi-lock"></i>" needs to be clicked.</li>
                                            <li>When the inputs are enabled, you can then change the values.</li>
                                            <li>Once satisfied, click the "Update SSS Rate" button to save the changes.</li>
                                        </ol>
                                    </p>
                                    <img src="/manual/payroll/contributions/1.jpg" class="w-100">
                                </div>

                                <br><br>

                                <li><h4 class="text-primary">SSS Contributions Table</h4></li>
                                <div class="row ms-5">
                                    <div class="row">
                                        <div class="col-4">
                                            The SSS Contributions Table provides a way to view all of the computed SSS contributions of all employees as well as the employers share of their contributions.
                                            <br><br>Using the date filter, the payroll manager will be able to select different periods to view their contributions. The view of the table can also be change using the "Entries filter" and the Search bar.
                                        </div>
                                        <div class="col">
                                            <img src="/manual/payroll/contributions/2.jpg" class="w-100">
                                        </div>
                                    </div>
                                </div>

                                <br><br>

                                <li><h4 class="text-primary">SSS Employee Management Table</h4></li>
                                <div class="row ms-5">
                                    <div class="row">
                                        <div class="col-4">
                                            The SSS Employee Management Table provide the function to view whether the employee is Included or Excluded to the SSS contributions.
                                            <br><br>
                                            The table also provides the function to include or exclude an employee to the contribution.
                                            By clicking the button on the "Edit" column, you will be able to change the contribution status of the employee.
                                        </div>
                                        <div class="col">
                                            <img src="/manual/payroll/contributions/3.jpg" class="w-100">
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>

                    <br><br>

                    <div id="contributions/pagibig">
                        <div class="row my-5">
                            <h4 class="text-primary">Pagibig Contribution</h4>
                            The Pagibig contribution is a legal contribution where in the employers and Pagibig member employees pays regularly in order to for the Pagibig can take advantage of maternity, sickness, disability, retirement, funeral and death benefits. Pagibig offers a variety of benefits to qualified members, including the ability to take up salary, housing, business, and educational loans.
                            <br>
                            <br>
                            <b>This module Includes the following functions:</b>
                            <ul>
                                <li><h4 class="text-primary">Variable Management</h4></li>
                                <div class="row ms-5">
                                    <p>
                                        This module provides tool for the payroll manager to change the Pagibig computation variables when changes occurs.
                                        In the "Pagibig Contribution Details" you will see the controls to change the variable.
                                        By default, the input are disabled to prevent mistakes. Beside the Pagibig Contribution details will be the instructions to easily understand what the variables are.
                                        <ol class="ms-5">
                                            <li>To enable the input in order to change the variables, the "<i class="bi bi-lock"></i>" needs to be clicked.</li>
                                            <li>When the inputs are enabled, you can then change the values.</li>
                                            <li>Once satisfied, click the "Update Pagibig Rate" button to save the changes.</li>
                                        </ol>
                                    </p>
                                    <img src="/manual/payroll/contributions/pagibig1.jpg" class="w-100">
                                </div>

                                <br><br>

                                <li><h4 class="text-primary">Pagibig Contributions Table</h4></li>
                                <div class="row ms-5">
                                    <div class="row">
                                        <div class="col-4">
                                            The Pagibig Contributions Table provides a way to view all of the computed Pagibig contributions of all employees as well as the employers share of their contributions.
                                            <br><br>Using the date filter, the payroll manager will be able to select different periods to view their contributions. The view of the table can also be change using the "Entries filter" and the Search bar.
                                        </div>
                                        <div class="col">
                                            <img src="/manual/payroll/contributions/pagibig2.jpg" class="w-100">
                                        </div>
                                    </div>
                                </div>

                                <br><br>

                                <li><h4 class="text-primary">Pagibig Employee Management Table</h4></li>
                                <div class="row ms-5">
                                    <div class="row">
                                        <div class="col-4">
                                            The Pagibig Employee Management Table provide the function to view whether the employee is Included or Excluded to the Pagibig contributions.
                                            <br><br>
                                            The table also provides the function to include or exclude an employee to the contribution.
                                            By clicking the button on the "Edit" column, you will be able to change the contribution status of the employee.
                                        </div>
                                        <div class="col">
                                            <img src="/manual/payroll/contributions/pagibig3.jpg" class="w-100">
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>

                    <br><br>

                    <div id="contributions/philhealth">
                        <div class="row my-5">
                            <h4 class="text-primary">Philhealth Contribution</h4>
                            The Philhealth contribution is a legal contribution where in the employers and Philhealth member employees pays regularly in order to for the Philhealth can take advantage of maternity, sickness, disability, retirement, funeral and death benefits. Philhealth offers a variety of benefits to qualified members, including the ability to take up salary, housing, business, and educational loans.
                            <br>
                            <br>
                            <b>This module Includes the following functions:</b>
                            <ul>
                                <li><h4 class="text-primary">Variable Management</h4></li>
                                <div class="row ms-5">
                                    <p>
                                        This module provides tool for the payroll manager to change the Philhealth computation variables when changes occurs.
                                        In the "Philhealth Contribution Details" you will see the controls to change the variable.
                                        By default, the input are disabled to prevent mistakes. Beside the Philhealth Contribution details will be the instructions to easily understand what the variables are.
                                        <ol class="ms-5">
                                            <li>To enable the input in order to change the variables, the "<i class="bi bi-lock"></i>" needs to be clicked.</li>
                                            <li>When the inputs are enabled, you can then change the values.</li>
                                            <li>Once satisfied, click the "Update Philhealth Rate" button to save the changes.</li>
                                        </ol>
                                    </p>
                                    <img src="/manual/payroll/contributions/ph1.jpg" class="w-100">
                                </div>

                                <br><br>

                                <li><h4 class="text-primary">Philhealth Contributions Table</h4></li>
                                <div class="row ms-5">
                                    <div class="row">
                                        <div class="col-4">
                                            The Philhealth Contributions Table provides a way to view all of the computed Philhealth contributions of all employees as well as the employers share of their contributions.
                                            <br><br>Using the date filter, the payroll manager will be able to select different periods to view their contributions. The view of the table can also be change using the "Entries filter" and the Search bar.
                                        </div>
                                        <div class="col">
                                            <img src="/manual/payroll/contributions/ph2.jpg" class="w-100">
                                        </div>
                                    </div>
                                </div>

                                <br><br>

                                <li><h4 class="text-primary">Philhealth Employee Management Table</h4></li>
                                <div class="row ms-5">
                                    <div class="row">
                                        <div class="col-4">
                                            The Philhealth Employee Management Table provide the function to view whether the employee is Included or Excluded to the Philhealth contributions.
                                            <br><br>
                                            The table also provides the function to include or exclude an employee to the contribution.
                                            By clicking the button on the "Edit" column, you will be able to change the contribution status of the employee.
                                        </div>
                                        <div class="col">
                                            <img src="/manual/payroll/contributions/ph3.jpg" class="w-100">
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="bonus" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <h3 class="alert-light p-4">Employee Bonus</h3>
                <div class="px-4 mx-5">
                    <h6 class="text-primary">Description</h6>
                    <p class="w-75">
                        The Employee Bonus Management is the module where in the payroll manager will be able to view, remove, and add employee bonus records.
                        Also included in this module is the Thirteenth month bonus module where in the payroll manager will be able to see the current status of the Thirteenth month bonus of all employee and generate a thirteenth month bonus summary report.</p>
                    <br>
                    <h6 class="text-primary">Functions</h6>
                    <p class="w-75" >The functions of the Employee Bonus Management page are listed below:</p>
                    <ul class="ms-5">
                        <li><a class="ps-3 m-3" href="#bonus/function1">Employee Bonus History</a></li>
                        <li><a class="ps-3 m-3" href="#bonus/function2">Add Employee Bonus</a></li>
                        <li><a class="ps-3 m-3" href="#bonus/function3">13th Month Payroll Summary</a></li>
                    </ul>

                    <br><br>

                    <div id="bonus/function1">
                        <div class="row my-5">
                            <h4 class="text-primary">Employee Bonus History</h4>
                            In the "Employee Bonus History" section, the payroll manager will be able to view all of the employee bonus record in the table.
                            Using the date filter, the payroll manager will be able view bonus records in different date periods.
                            <br>
                            <img src="/manual/payroll/bonus/1.jpg" class="w-100">
                            <br><br><br>
                            <div class="ms-5">
                                <h4 class="text-primary">Delete Employee Bonus Record</h4>
                                <div class="row">
                                    <div class="col">
                                        <br><br><br><br>
                                        The payroll manager will be able to delete bonus record in hte Employee Bonus History table using the "Remove" button in the delete column of each record.
                                        <br><br><br>
                                        <br><br><br>
                                        <br>
                                        By clicking the remove button of the chosen record. A dialog box will appear which will confirm your actions and when the "Ok" button is clicked the record will be remove
                                    </div>
                                    <div class="col">
                                        <img src="/manual/payroll/bonus/2.jpg" class="w-100">
                                        <img src="/manual/payroll/bonus/3.jpg" class="w-100">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br><br>

                    <div id="bonus/function2">
                        <div class="row my-5">
                            <h4 class="text-primary">Add Employee Bonus</h4>
                            <img src="/manual/payroll/bonus/4.jpg" class="w-100">
                            This is the Add Bonus module. In this module you can select employees, add bonus details, and save the Bonus for the payroll.
                            <br><br>
                            Adding Bonus involves three steps:
                            <ol>
                                <li><b>Selecting Employees</b></li>
                                <div class="row">
                                    <div class="col">
                                        In the Employee selection table, you will be able to search, filter employees, and select employees by clicking the "select" button beside the employee details.
                                        The button will show green if the employee is selected.
                                        <img src="/manual/payroll/bonus/5.jpg" class="w-100">
                                    </div>
                                    <div class="col">
                                        You can confirm that the employee is selected if it is added in the "Selected Employees" Table
                                        <img src="/manual/payroll/bonus/6.jpg" class="w-100">
                                    </div>
                                </div>
                                <br><br>
                                <li><b>Adding Bonus Details</b></li>
                                <div class="row">
                                    <div class="col">
                                        After Selecting employees for the Bonus, the payroll manager will need to add the Bonus period, Bonus name, and the Bonus amoumt. After adding the Bonus details, the payroll manager will click the "Add Bonus" button.
                                    </div>
                                    <div class="col">
                                        <img src="/manual/payroll/bonus/7.jpg" class="w-100">
                                    </div>
                                </div>
                                <br><br>
                                <li><b>Clicking "Confirm Bonus" button</b></li>
                                <div class="row">
                                    <div class="col">
                                        After clicking the "Confirm Bonus" button, a prompt will appear which confirms the selected employees and the Bonus details. By clicking the "Confirm Bonus" button, the Bonus will be added.
                                    </div>
                                    <div class="col">
                                        <img src="/manual/payroll/bonus/8.jpg" class="w-100">
                                    </div>
                                </div>
                            </ol>
                        </div>
                    </div>

                    <br><br>

                    <div id="bonus/function3">
                    <h4 class="text-primary">13th Month Payroll Summary</h4>
                        In the Bonus Management module is where the "13th month payroll summary" table, this is where the payroll manager will be able to view the status of the payroll for the year and view the automatically calculated 13th month bonus.
                        <br>
                        <img src="/manual/payroll/bonus/9.jpg" class="w-100">
                        <br><br><br>
                        <div class="ms-5">
                            <h4 class="text-primary">Generating 13th Month Payroll Summary PDF</h4>
                            <div class="row">
                                <div class="col">
                                    <br>
                                    <br>
                                    In order for the payroll manager to create the 13th Month Payroll Summary PDF, first they will have to click the "<i class="bi bi-lock"></i>" button to enable the "Issue 13th Month Bonus" button.
                                    <br><br>
                                    <br><br>
                                    <br>
                                    Once the "Issue 13th Month Bonus" is enabled, the payroll manager can then click that button and wait for a new tab to pop up which will generate the PDF of the 13th Month Bonus.
                                </div>
                                <div class="col">
                                    <img src="/manual/payroll/bonus/11.jpg" class="w-100">
                                    <img src="/manual/payroll/bonus/10.jpg" class="w-100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="multipay" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <h3 class="alert-light p-4">Multi Pay</h3>
                <div class="px-4 mx-5">
                    <h6 class="text-primary">Description</h6>
                    <p class="w-75">
                        The Multi Pay Management is the module where the Double/Triple pay records and where the payroll manager will be able to record these additional payments in the attedances of employees.</p>
                        <br>
                    <h6 class="text-primary">Functions</h6>
                    <p class="w-75" >The functions of the Multi Pay Management page are listed below:</p>
                    <ul class="ms-5">
                        <li><a class="ps-3 m-3" href="#multipay/function1">Multi Pay Management</a></li>
                        <li><a class="ps-3 m-3" href="#multipay/function2">Multi Pay History</a></li>
                    </ul>

                    <br><br>

                    <div id="multipay/function1">
                        <div class="row my-5">
                            <h4 class="text-primary">Multi Pay Management</h4>
                            In the "Multi Pay Management" table are all the attendance records that are in the date period filter. The payroll manager can use the date filter at the top of the table to filter the attendances.
                            The payroll manager can also use the "Entries" Filter below the date filter to change the nubmer of records that are displayed.
                            A search bar on the upper right of the table is also provided for the payroll manager to search through therecords.
                            <br>

                            <img src="/manual/payroll/multipay/1.jpg" class="w-100">

                            <h5 class="alert-light p-4">Adding of Multi Pay records</h5>

                            <div class="row">
                                <div class="col">
                                    In the "Actions" column of the table is where the two buttons for recording a double or triple payment for an attendance.
                                    The payroll manager is given to options, which are to pay the attendance double or triple and this feature have their designated buttons
                                    which are the "2X" and "3X" buttons.
                                </div>
                                <div class="col">
                                    <img src="/manual/payroll/multipay/6.jpg" class="w-100">
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col">
                                    When "2X" or "3X" button is clicked, a confirmation message dialog box will appear which will confirm the selection and the action of the payroll manager.
                                    The dialog box will show the details of the employee, their attendance, and whether if that attendance is to be paid double or triple.
                                    Once satisfied with all the details, the payroll manager can then click the "Confirm Multi Pay" button to finish the transaction
                                </div>
                                <div class="col">
                                    <img src="/manual/payroll/multipay/2.jpg" class="w-100">
                                </div>
                            </div>

                            <br><br>
                        </div>
                    </div>

                    <br><br>

                    <div id="multipay/function2">
                        <div class="row my-5">
                            <h4 class="text-primary">Multi Pay History</h4>

                            In the "Multi Pay History" table is where the payroll manager can view all of the recorded multi pay within the selected date period.
                            The payroll managaer can change the date period, using the date filter at the top left of the table. The payroll manager can chage the number of records in the table using the "Entries" filter and search through the table using the search bar.
                            <br>

                            <img src="/manual/payroll/multipay/3.jpg" class="w-100">
                            <div class="row mt-3">
                                <h4 class="text-primary">Deleting Multi Pay records</h4>
                                <div class="col">
                                    Each Record in the "Multi Pay History" table has its own "Remove" button. This button is for deleting the selected record.
                                </div>
                                <div class="col">
                                    <img src="/manual/payroll/multipay/4.jpg" class="w-100">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    Once the "Remove" button is clicked, a dialog message will appear which will confirm the actions of the payroll manager.
                                    Once the "OK" button is clicked, the deletion of the record will proceed.
                                </div>
                                <div class="col">
                                    <img src="/manual/payroll/multipay/5.jpg" class="w-100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="holidays" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <h3 class="alert-light p-4">Holidays</h3>
                <div class="px-4 mx-5">
                    <h6 class="text-primary">Description</h6>
                    <p class="w-75">The Holiday Management is the module where the payroll manager will be able to list all of upcoming paid Holidays and record all of the employee that will be paid on that holiday.</p>
                    <br>
                    <img src="/manual/payroll/holidays/1.jpg" class="w-100">

                    <h6 class="text-primary">Functions</h6>
                    <p class="w-75" >The functions of the Holiday Management page are listed below:</p>
                    <ul class="ms-5">
                        <li><a class="ps-3 m-3" href="#holidays/function1">Listed Holidays</a></li>
                        <li><a class="ps-3 m-3" href="#holidays/function2">Add Holiday Pay</a></li>
                        <li><a class="ps-3 m-3" href="#holidays/function3">Holiday Attendance</a></li>
                    </ul>

                    <div id="holidays/function1">
                        <div class="row my-5">
                            <h4 class="text-primary">Listed Holidays</h4>
                            <div class="col-4">
                                In this part of the module, the payroll manager will be able to view all of the recorded holidays using the calendar view that is provided.
                                The Calendar view have different function such as searching throught different date period, monthly view, weekly view, and day view.
                                The holiday will be displayed on the dates that it covers and it will be highlighted with blue color.
                            </div>
                            <div class="col">
                                <img src="/manual/payroll/holidays/2.jpg" class="w-100">
                            </div>

                            <div class="row">
                                <h5 class="text-primary">Listing a Holiday</h5>
                                <div class="col">
                                    In order to list a new holiday, the payroll manager will have to use the list section on the right side of the calendar view.
                                    The payroll manager will have to enter the holiday name, the start date, and the end date.
                                    Once the details are placed in the input boxes, the payroll manager can then click the "Add Holiday" button to list the holiday.
                                    To confirm the new recorded holiday, the payroll manager can then view it in the calendar table.
                                </div>
                                <div class="col">
                                    <img src="/manual/payroll/holidays/3.jpg" class="w-100">
                                </div>
                            </div>

                            <div class="row">
                                <h5 class="text-primary">Listing a Holiday</h5>
                                <div class="col">
                                    To delete a holiday record, the payroll manager will have to use the "Delete Holiday" part of the feature.
                                    The "Delete Holiday" is located below the "Listing a Holiday", use the scroll if the table is not completely visible.
                                    The Delete Holiday have a date filter to change the date period of the holiday that will be displayed as well as the entries filter and a search bar.
                                    <br>
                                    <br>
                                    To Delete Record, just click the "Remove" button beside the selected holiday record.
                                </div>
                                <div class="col">
                                    <img src="/manual/payroll/holidays/4.jpg" class="w-100">
                                </div>
                            </div>
                        </div>
                    </div>

                    <br><br>

                    <div id="holidays/function2">
                        <div class="row my-5">
                            <h4 class="text-primary">Add Holiday Pay</h4>
                            The Add Holiday Pay section of this module, you can select specific employees or select all employees and pay their holiday.
                            <br><br>
                            <img src="/manual/payroll/cashAdvance/5.jpg" class="w-100">
                            Adding Holiday Pay involves three steps:
                            <ol>
                                <li><b>Selecting Employees</b></li>
                                <div class="row">
                                    <div class="col">
                                        In order to select employees for the holiday pay, the payroll manager can use the employee list table to view and search all of the employees.
                                        To select employee, the payroll manager can click the "Select" button on the record. The payroll manager can also user the "Select All Employee" button at the top of the employee list to select all of the employee easily.
                                        <img src="/manual/payroll/cashAdvance/6.jpg" class="w-100">
                                    </div>
                                    <div class="col">
                                        You can confirm that the employee is selected if it is added in the "Selected Employees" Table
                                        <img src="/manual/payroll/cashAdvance/7.jpg" class="w-100">
                                    </div>
                                </div>
                                <br><br>
                                <li><b>Selecting Holiday</b></li>
                                <div class="row">
                                    <div class="col">
                                        After Selecting employees for the holiday pay, the payroll manager will have to select the holiday using the dropdown input.
                                        After selecting holiday using the dropdown, the dates of the attendance will be also displayed.
                                    </div>
                                    <div class="col">
                                        <img src="/manual/payroll/cashAdvance/8.jpg" class="w-100">
                                    </div>
                                </div>
                                <br><br>
                                <li><b>Clicking "Submit" button</b></li>
                                <div class="row">
                                    <div class="col">
                                        After clicking the "Submit" button, a prompt will appear which confirms the selected employees and the seleted Holiday. By clicking the "Submit" button, the holiday pay will be added.
                                    </div>
                                    <div class="col">
                                        <img src="/manual/payroll/cashAdvance/8.jpg" class="w-100">
                                    </div>
                                </div>
                            </ol>
                        </div>
                    </div>

                    <br><br>

                    <div id="holidays/function3">
                        <div class="row my-5">
                            <h4 class="text-primary">Holiday Attendance</h4>
                            In the Holiday Attendance part of the holiday module is where the payroll manager will be able to view all the recorded all the holiday pay or holiday attendance.
                            <div class="row">
                                <div class="col">
                                    <h5>Collective Attendance</h5>
                                    In this table, the payroll manager will be able to view all of the attendance where in all of the employee was selected.
                                    The payroll manager can then click the "Remove" button to remove all of the attendance in that collection of records.

                                    <img src="/manual/payroll/holidays/9.jpg" class="w-100">
                                </div>
                                <div class="col">
                                    <h5>Selected Attendance</h5>
                                    In this table, the payroll manager can view each record individually.
                                    The payroll manager can then used the "Remove" button to remove that record specifically.

                                    <img src="/manual/payroll/holidays/10.jpg" class="w-100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="leave" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <h3 class="alert-light p-4">Leave</h3>
                <div class="px-4 mx-5">
                    <h6 class="text-primary">Description</h6>
                    <p class="w-75">In the Leave Management module is where all the Leave Application of employees will be displayed and this is where the payroll manager will be able to approve or deny leave applications.
                        In this module, the payroll manager will be able to add attendances to their employees using the "Add Paid Leave" section.
                        Also this is the module where in the payroll manager will be able to view all of the completed leave application as well as delete listed leave attendance.
                    </p>
                    <br>
                    <img src="/manual/payroll/leave/1.jpg" class="w-100">

                    <h6 class="text-primary">Functions</h6>
                    <p class="w-75" >The functions of the Leave Management page are listed below:</p>
                    <ul class="ms-5">
                        <li><a class="ps-3 m-3" href="#leave/function1">Paid Leave Approvals</a></li>
                        <li><a class="ps-3 m-3" href="#leave/function2">Add Paid Leave</a></li>
                        <li><a class="ps-3 m-3" href="#leave/function3">Paid Application History</a></li>
                        <li><a class="ps-3 m-3" href="#leave/function4">Paid Leave History</a></li>
                    </ul>


                    <div id="leave/function1">
                        <div class="row my-5">
                            <h4 class="text-primary">Paid Leave Approvals</h4>
                            <img src="/manual/payroll/leave/10.jpg" class="w-100">
                            In this section of the Leave management module, the payroll manager will be able to see all of the pending leave application and their details such as the employee details, a brief letter application for leave, as well as the leave details. They will be able to approve or deny a selected leave applicate by clicking their respected "Approve" button and "Deny" Button.
                        </div>
                    </div>
                    <div id="leave/function2">
                        <h4 class="text-primary">Add Paid Leave</h4>
                        <img src="/manual/payroll/leave/2.jpg" class="w-100">
                        This is the Add deduction module. In this module you can select employees, add leave details, and save the leave for the payroll.
                        <br><br>
                        Adding Paid Leave involves three steps:
                        <ol>
                            <li><b>Selecting Employees</b></li>
                            <div class="row">
                                <div class="col">
                                    In the Employee selection table, you will be able to search, filter employees, and select employees by clicking the "select" button beside the employee details.
                                    The button will show green if the employee is selected.
                                    <img src="/manual/payroll/leave/3.jpg" class="w-100">
                                </div>
                                <div class="col">
                                    You can confirm that the employee is selected if it is added in the "Selected Employees" Table
                                    <img src="/manual/payroll/leave/4.jpg" class="w-100">
                                </div>
                            </div>
                            <br><br>
                            <li><b>Adding Paid Leave Details</b></li>
                            <div class="row">
                                <div class="col">
                                    After Selecting employees for the Paid Leave, the payroll manager will need to add the Paid Leave period by selecting an from date and to date using the date picker. After adding the Paid Leave details, the payroll manager will click the "Add Paid Leave" button.
                                </div>
                                <div class="col">
                                    <img src="/manual/payroll/leave/5.jpg" class="w-100">
                                </div>
                            </div>
                            <br><br>
                            <li><b>Clicking "Add Paid Leave" button</b></li>
                                <div class="row">
                                    <div class="col">
                                        After clicking the "Add Paid Leave" button, a prompt will appear which confirms the selected employees and the Paid Leave details. By clicking the "Confirm Paid Leave" button, the leave will be added.
                                    </div>
                                    <div class="col">
                                        <img src="/manual/payroll/leave/6.jpg" class="w-100">
                                    </div>
                                </div>
                            </div>
                        </ol>
                    </div>
                    <div id="leave/function3">
                        <div class="row my-5">
                            <h4 class="text-primary">Paid Application History</h4>
                            <div class="row">
                                <div class="col">
                                    The Paid Application History is where the payroll manager will be able to find all of the accomplished leave application or all of the application that has been either denied or approved. The payroll manager can all recover the accomplished application in order for them to reconsider or change their decision.
                                    <br><br>
                                    The payroll manager will have to click the "Recover Application" Button to recover the application. After clicking, the Leave application will be able on the "Paid Leave Approvals".
                                </div>
                                <div class="col">
                                    <img src="/manual/payroll/leave/7.jpg" class="w-100">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="leave/function4">
                        <div class="row my-5">
                            <h4 class="text-primary">Paid Leave History</h4>
                            In the Paid Leave Histoy part of the leave management module is where all of the Paid Leave records will be found. The payroll manager will be able to delete Paid Leave records in this section as well.
                            <div class="row">
                                <div class="col">
                                    This is the "Paid Leave History" table. This is where all of the Paid Leave record is located.
                                </div>
                                <div class="col">
                                    <img src="/manual/payroll/leave/8.jpg" class="w-100">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    The payroll manager can click the "Remove" button of their select Paid leave record to delete it from the payroll records.
                                </div>
                                <div class="col">
                                    <img src="/manual/payroll/leave/9.jpg" class="w-100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="audit" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <h3 class="alert-light p-4">Audit Logs</h3>
                <div class="px-4 mx-5">
                    <h6 class="text-primary">Description</h6>
                    <p class="w-75">
                        In the Audit Logs Module is where all of the payroll managers actions are listed. The payroll manager can search through the records using the search bar as well as change the number of records using the entries filter.
                        The table displays all necessary informations such as the payroll manager name, a brief description of the activity, affected employee name, and activity details.
                        The displayed records can also be generetad into a PDF report. All report is stored in the system a can be viewed in this module.
                    </p>
                    <br>
                    <img src="/manual/payroll/audit/1.jpg" class="w-100">

                    <h6 class="text-primary">Functions</h6>
                    <p class="w-75" >The functions of the Audit Logs page are listed below:</p>
                    <ul class="ms-5">
                        <li><a class="ps-3 m-3" href="#audit/function1">Audit Logs</a></li>
                        <li><a class="ps-3 m-3" href="#audit/function2">Audit History</a></li>
                    </ul>

                    <div id="audit/function1">
                        <div class="row my-5">
                            <h4 class="text-primary">Audit Logs</h4>
                            <img src="/manual/payroll/audit/1.jpg" class="w-100">
                            In the Audit Logs section is where the "Audit Logs" table is located. This is where the payroll manager will be able to see all of the audit records.
                            Above the "Audit Logs" table, the "Generate Audit Summary" button is located

                            <br>
                            <h5 class="text-primart">Generate Audit Summary</h5>
                            <div class="row">
                                <div class="col">
                                    First, click the "Generate Audit Summary" button.
                                </div>
                                <div class="col">
                                    <img src="/manual/payroll/audit/2.jpg" class="w-100">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    The "Generate Audit Summary" button will change into two buttons which is the "PDF" and cancel button. Once the "PDF" button is clicked, a new tab will show which will generate the audit summary into a PDF format
                                </div>
                                <div class="col">
                                    <img src="/manual/payroll/audit/3.jpg" class="w-100">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="leave/function2">
                        <div class="row my-5">
                            <h4 class="text-primary">Audit History</h4>
                            In the "Audit History" is where all of the generated audit summary can be viewed and download. The payroll manager will have to select a audit summary file using the buttons with their file name on it.
                            <img src="/manual/payroll/audit/4.jpg" class="w-100">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="approvals" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <h3 class="alert-light p-4">Approvals</h3>
                <div class="px-4 mx-5">
                    <h6 class="text-primary">Description</h6>
                    <p class="w-75">
                        In the Approvals module, the payroll manager will find all of the generated payroll summary and view their approval progress and details.
                        This module provide features that allows payroll manager to approve, note, or disapprove payroll summary.
                        In this module, the payroll manager will be able to generate the individual payslip for all employees.
                    </p>
                    <br>
                    <img src="/manual/payroll/approvals/1.jpg" class="w-100">

                    <h6 class="text-primary">Functions</h6>
                    <p class="w-75" >The functions of the Audit Logs page are listed below:</p>
                    <ul class="ms-5">
                        <li><a class="ps-3 m-3" href="#approvals/function1">Payroll Summary Progress</a></li>
                        <li><a class="ps-3 m-3" href="#approvals/function2">Updating Payroll Summary</a></li>
                        <li><a class="ps-3 m-3" href="#approvals/function3">Generating Employee Payslip</a></li>
                    </ul>

                    <div id="approvals/function1">
                        <div class="row my-5">
                            <h4 class="text-primary">Payroll Summary Progress</h4>
                            <div class="row">
                                <div class="col">
                                    The payroll manager will be able to view the Payroll Summary progress on their approvals by clicking their selected payroll summary.
                                    <br><br>
                                    <b>To select a payroll summary</b><br>
                                    Beside the PDF View area is where all of the buttons for each payroll summary is located.<br>
                                    The payroll manager can then click the button of their selected payroll summary to display the PDF file of that summery in the PDF view area.<br>
                                    When a PDF is displayed, the payroll manager will first have to click the close button on the currently open PDF to view another one.
                                </div>
                                <div class="col">
                                    <img src="/manual/payroll/approvals/summaryView.jpg" class="w-100">
                                </div>
                            </div>
                            <div class="p-4"></div>
                            <h5 class="text-primart">Summary Progress View</h5>
                            <div class="row">
                                <div class="col">
                                    The progress of approval of the selected Payroll summary can bee seen above the PDF view.
                                    It shows a progress bar to visualize the current progress of the payroll as well as the approval details and the payroll manager who generated that summary.
                                </div>
                                <div class="col">
                                    <img src="/manual/payroll/approvals/approved.jpg" class="w-100">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="approvals/function2">
                        <div class="row my-5">
                            <h4 class="text-primary">Updating Payroll Summary</h4>
                            In this module is where the payroll manager can approve, disapprove, and note a payroll summary in order to ensure that it is ready for payslip generation.
                            <div class="row">
                                <div class="col">
                                    For the payroll manager to update the progress of a payroll, they will have to select one from "Approve", "Note", and "Disapproved" buttons and click it.
                                    <img src="/manual/payroll/approvals/approveControls.jpg" class="w-100">
                                </div>
                                <div class="col">
                                    once they clicked it the a new control will shows which will ask the payroll manager to upload their e-signature in order to sign the payroll summary.
                                    Once they upload an e-signature they will have to click the "Submit" button. Once clicked, a new tab will show which will display the updated Payroll Summary file with their sign and their selected status of approval.
                                    <img src="/manual/payroll/approvals/esigniture.jpg" class="w-100">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="approvals/function3">
                        <div class="row my-5">
                            <h4 class="text-primary">Generating Employee Payslip</h4>
                            <div class="row">
                                <div class="col">
                                    In the Payroll update controls is where the "Generate Payslip" is located. Once the progress of a payroll has reached 100%, the "Generate Payslip" button will become available to click.
                                    Once clicked a new tab will show which will generate the individual payslip for employees along with the signitures of the payroll managers.
                                </div>
                                <div class="col">
                                    <img src="/manual/payroll/approvals/forPayslip.jpg" class="w-100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="employeelist" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                @include('inc.common_manual.employee_list')
            </div>
            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="profile" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                @include('inc.common_manual.profile')
            </div>
            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="messages" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                @include('inc.common_manual.messages')
            </div>
            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="notifications" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                @include('inc.common_manual.notifications')
            </div>
        </div>
    </div>
</div>

<script>
    function changeButtonColor(btn){
        var manual_buttons = document.querySelectorAll('.manual_button')
        manual_buttons.forEach(element => {
            element.className = "manual_button nav-link text-dark h5"
        });

        btn.className = "manual_button nav-link h5 alert-primary"
    }
</script>
@endsection
