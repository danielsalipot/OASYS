@extends('layout.payroll_app')

@section('title')
@endsection

@section('content')
<div class="row" style="position:fixed; top:0; width:92.5vw;" >
    <div class="col-2 bg-white p-0" >
        <ul class="nav flex-column alert-light w-100 p-0">
            <li class="nav-item p-0 m-0" style="height: 43px">
                <a class="nav-link h5 alert-primary" aria-current="page" href="#home">
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
                <a class="nav-link text-dark h5" href="#salary">
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
                <a class="nav-link text-dark h5" href="#deduction">
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
                <a class="nav-link text-dark h5" href="#overtime">
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
                <a class="nav-link text-dark h5" href="#cashAdvance">
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
                <a class="nav-link text-dark h5" href="#contributions">
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
                <a class="nav-link text-dark h5" href="#bonus">
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
                <a class="nav-link text-dark h5" href="#multipay">
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
                <a class="nav-link text-dark h5" href="#holidays">
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
                <a class="nav-link text-dark h5" href="#leave">
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
                <a class="nav-link text-dark h5" href="#audit">
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
                <a class="nav-link text-dark h5" href="#approvals">
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
                <a class="nav-link text-dark h5" href="#employeelist">
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
                <a class="nav-link text-dark h5" href="#profile">
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
                <a class="nav-link text-dark h5" href="#messages">
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
                <a class="nav-link text-dark h5" href="#notifications">
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
        <div class="card" style="overflow-y: scroll; height:700px">
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
                                Just below the page, you will locate the Payroll details Table. The table will display the details of the employee as well as the automatically computed Payroll Details.
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
                                Select the Search bar located on the top right of the table and type your inteded information to be searched. The table will automatically display all rows with that information
                            </div>
                        </div>
                    </div>

                    <br><br>

                    <div id="home/function2">
                        <div class="row my-5">
                            <h4 class="text-primary">Payroll Summary Creation</h4>
                            <div class="col-3">
                                <br>
                                    The "Payroll Report Generation Buttons" container contains the <b>"current cut off duration"</b> display which display the currently selected cutoff dates.
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
                                To filter the current cut off duration, you can you the "from date date picker" and the "to date date picker". Click a date picker then a calendar will display which you can use to select a date. Both date picker should have a date value. After selecting you can click the "filter" button to change the current cut off duration and the payroll details.

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
                            Located just below the "Average Salary of Positions" section, will be the Employee Salary table. This table will display some basic information of employees as well as there Rate/hr. The payroll manager can use the search bar and entries filter to change the view of the table.
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
                                <img src="/manual/payroll/overtim/3.jpg" class="w-100">
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
            </div>

            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="bonus" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <h3 class="alert-light p-4">Employee Bonus</h3>
            </div>
            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="multipay" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <h3 class="alert-light p-4">Multi Pay</h3>
            </div>
            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="holidays" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <h3 class="alert-light p-4">Holidays</h3>
            </div>
            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="leave" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <h3 class="alert-light p-4">Leave</h3>
            </div>
            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="audit" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <h3 class="alert-light p-4">Audit Logs</h3>
            </div>
            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="approvals" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <h3 class="alert-light p-4">Approvals</h3>
            </div>
            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="employeelist" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <h3 class="alert-light p-4">Employee List</h3>
            </div>
            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="profile" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <h3 class="alert-light p-4">Profile</h3>
            </div>
            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="messages" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <h3 class="alert-light p-4">Messages</h3>
            </div>
            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="notifications" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <h3 class="alert-light p-4">Notifications</h3>
            </div>
        </div>
    </div>
</div>

@endsection
