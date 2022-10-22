@extends('layout.staff_app')

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
                <a class="manual_button nav-link text-dark h5" onclick="changeButtonColor(this)" href="#onboarding">
                    <div class="row text-center">
                        <div class="col-2">
                            <i class="bi bi-person-check-fill h4 p-0 m-0"></i>
                        </div>
                        <div class="col pt-1 text-start p-0">
                            Onboarding Management
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="manual_button nav-link text-dark h5" onclick="changeButtonColor(this)" href="#offboarding">
                    <div class="row text-center">
                        <div class="col-2">
                            <i class="bi bi-dash-circle-fill h4 p-0 m-0"></i>
                        </div>
                        <div class="col pt-1 text-start p-0">
                            Offboarding Management
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="manual_button nav-link text-dark h5" onclick="changeButtonColor(this)" href="#offboardee">
                    <div class="row text-center">
                        <div class="col-2">
                            <i class="bi bi-person-x-fill h4 p-0 m-0"></i>
                        </div>
                        <div class="col pt-1 text-start p-0 pe-0">
                            Offboardee Management
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="manual_button nav-link text-dark h5" onclick="changeButtonColor(this)" href="#schedule">
                    <div class="row text-center">
                        <div class="col-2">
                            <i class="bi bi-calendar2-week h4 p-0 m-0"></i>
                        </div>
                        <div class="col pt-1 text-start p-0">
                            Schedule Management
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="manual_button nav-link text-dark h5" onclick="changeButtonColor(this)" href="#interview">
                    <div class="row text-center">
                        <div class="col-2">
                            <i class="bi bi-file-earmark-person-fill h4 p-0 m-0"></i>
                        </div>
                        <div class="col pt-1 text-start p-0">
                            Interview Management
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="manual_button nav-link text-dark h5" onclick="changeButtonColor(this)" href="#department">
                    <div class="row text-center">
                        <div class="col-2">
                            <i class="bbi bi-building h4 p-0 m-0"></i>
                        </div>
                        <div class="col pt-1 text-start p-0">
                            Department Management
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="manual_button nav-link text-dark h5" onclick="changeButtonColor(this)" href="#position">
                    <div class="row text-center">
                        <div class="col-2">
                            <i class="bi bi-person-workspace h4 p-0 m-0"></i>
                        </div>
                        <div class="col pt-1 text-start p-0">
                            Position Management
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
                        <div class="col pt-1 text-start p-0">
                            Audit Logs
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
                        <div class="col pt-1 text-start p-0">
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
                        <div class="col pt-1 text-start p-0">
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
                        <div class="col pt-1 text-start p-0">
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
                        <div class="col pt-1 text-start p-0">
                            Notification
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
                <h3 class="alert-light p-4">Home / Dashboard</h3>
                <div class="px-4 mx-5">
                    <h6 class="text-primary">Description</h6>
                    <p class="w-75">The HR staff dashboard is page that will welcome the HR staff upon login in.
                        The Dashboard contains essential information and controls to easily guide the HR staff in doing their work.
                    </p>
                    <img src="/manual/staff/home/1.jpg" class="w-100">

                    <br>
                    <h6 class="text-primary">Functions</h6>
                    <p class="w-75" >The functions of the Payroll Dashboard page are listed below:</p>
                    <ul class="ms-5">
                        <li><a class="ps-3 m-3" href="#home/function1">Overview</a></li>
                        <li><a class="ps-3 m-3" href="#home/function2">Applicants Overview</a></li>
                        <li><a class="ps-3 m-3" href="#home/function3">Interviews Today</a></li>
                    </ul>

                    <br><br>

                    <div id="home/function1">
                        <div class="row my-5">
                            <h4 class="text-primary">Overview</h4>
                            <div class="w-75">
                                In the Overview, the HR staff will be able to see the live count of their Applicants, Onboardees, Regular Employees, and Offboardees.
                            </div>
                            <img src="/manual/staff/home/2.jpg" class="w-75">
                        </div>
                    </div>

                    <br><br>

                    <div id="home/function2">
                        <div class="row my-5">
                            <h4 class="text-primary">Applicants Overview</h4>
                            <div class="col">
                                In the Applicants Overview table, the HR staff will be able to see all of the applicants and their application details immediately in order
                            </div>
                            <div class="col">
                                <img src="/manual/staff/home/3.jpg" class="w-100">
                            </div>
                        </div>
                    </div>

                    <br><br>

                    <div id="home/function3">
                        <h4 class="text-primary">Interviews Today</h4>
                        <div class="row">
                            <div class="col">
                                In the Interviews Today section, the HR staff will be able to see all of the scheduled interviews for the day as well as see some of the details of the applicant to be interviewed.
                            </div>
                            <div class="col text-center">
                                <img src="/manual/staff/home/4.jpg" class="w-50">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="onboarding" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <h3 class="alert-light p-4">Onboarding Management</h3>
                <div class="px-4 mx-5">
                    <h6 class="text-primary">Description</h6>
                    <p class="w-75">
                        The HR personnel will be able to choose applicants and onboard them via the Onboarding Management module, which is where they will be able to do so in order to hire them for the organization.                    </p>
                    <img src="/manual/staff/onboarding/1.jpg" class="w-100">

                    <br>
                    <h6 class="text-primary">Functions</h6>
                    <p class="w-75" >The functions of the Onboarding Management page are listed below:</p>
                    <ul class="ms-5">
                        <li><a class="ps-3 m-3" href="#onboarding/function1">Onboarding</a></li>
                    </ul>

                    <div id="onboarding/function1">
                        <h4 class="text-primary">Onboarding</h4>
                        <div class="row">
                            <div class="col">
                                In onboarding management is where the HR staff can view all of the applicants and onboard them.
                                In the Applicants Table, the HR staff will be able to see all of the applicants and their details.
                                In the last column of the table, the staff will see two buttons which are the "Onboard" and "Delete" button.

                                <br><br>

                                <h6>Deleting Applications</h6>
                                To delete an application, the HR staff will have to click the "Delete" button of the selected application.
                            </div>
                            <div class="col">
                                <img src="/manual/staff/onboarding/5.jpg" class="w-100">
                            </div>
                        </div>

                        <div class="row">
                            <h5 class="text-primary">Onboarding Applicant</h5>
                            <div class="col">
                                In order for the HR staff to onboard an applicant, they must click the "Onboard" button of that application.
                                After clicking, the controls for onboarding will show.
                                In the onboarding controls, HR staff will be able to view the details of the applicant as well as the application details.
                                The HR staff will also be able to view the applicant resume by clicking the "View resume"

                                <br><br>
                                Below the application details will be the interview details.
                                In the interview details, the HR staff will be able to review the feedbacks and scores of that applicant in the interviews that the applicant underwent.
                            </div>
                            <div class="col">
                                <img src="/manual/staff/onboarding/3.jpg" class="w-100">
                            </div>
                        </div>
                        <div class="row">
                            <h5 class="text-primary">Onboarding details</h5>
                            <div class="col">
                                After reviewing the applicant details and the interview results, the HR staff will have to prepare all of the onboarding details using the onboarding details controls.

                                <br><br>
                                <h6>Position and Department</h6>
                                In order to select the position and department, the HR staff will have to click the dropdown input and select the available position and department

                                <br><br>
                                <h6>Salary</h6>
                                The HR staff will have to type in the exact amount of the rate per hour of the employee in the provided input.
                            </div>
                            <div class="col">
                                <br><br>
                                <h6>Scheduled days</h6>
                                In order to record all of the days that the to be onboarded applicant, the HR staff will have to check all of the days where in the applicant will have to work.

                                <br><br>
                                <h6>Time in and Time out</h6>
                                To set the time in and time out of the applicant, the HR staff will have to use the time picker that is provided.
                                They will have to click the control and select the time that is available.

                                <br><br>
                                Once the HR staff have set all of the onboarding details, they will have to click the "Onboard" button to onboard the applicant to the company.
                            </div>
                        </div>
                        <br>
                        <img src="/manual/staff/onboarding/4.jpg" class="w-100">
                    </div>
                </div>
            </div>

            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="offboarding" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <h3 class="alert-light p-4">Offboarding Management</h3>
                <div class="px-4 mx-5">
                    <h6 class="text-primary">Description</h6>
                    <p class="w-75">
                        In the Offboarding Management Module is where the HR staff will be able to offboard employees or approve or deny their resignation. In this module the HR staff will also be able to set all of the clearance that the offboardee employee will have to accomplish to be fully offboarded in the company.
                    </p>
                    <img src="/manual/staff/offboarding/1.jpg" class="w-100">

                    <br>
                    <h6 class="text-primary">Functions</h6>
                    <p class="w-75" >The functions of the Offboarding Management page are listed below:</p>

                    <ul class="ms-5">
                        <li><a class="ps-3 m-3" href="#offboarding/function1">Termination Management</a></li>
                        <li><a class="ps-3 m-3" href="#offboarding/function2">Resignation Management</a></li>
                    </ul>

                    <div id="offboarding/function1">
                        <h4 class="text-primary">Termination Management</h4>
                        <div class="row">
                            <div class="col">
                                In the termination management, the HR staff will be able to see all of the present employees and will have the choice to terminate or retire them.
                                The human resources staff will need to click the "Terminate" or "Retire" button in order to let them go or retire them, respectively.
                                The offboarding controls will show once the button is selected, at which point the HR staff will be required to provide all of the offboarding clearance for the employee.                            </div>
                            <div class="col">
                                <img src="/manual/staff/offboarding/2.jpg" class="w-100">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h6>Offboarding Clearance</h6>
                                <div class="row">
                                    <div class="col">
                                        In order to add clearance task, the HR staff will have to type in the clearance task name and click "Add" button.
                                        To confirm the clearance task was added, the HR staff should be able to see the new task in the Clearance list.
                                        <br>
                                        Once satisfied, the HR staff will now have to click the confirm button which will be found below.
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <img src="/manual/staff/offboarding/7.jpg" class="w-100">
                            </div>
                        </div>
                    </div>
                    <div id="offboarding/function2">
                        <h4 class="text-primary">Resignation Management</h4>
                        <div class="row">
                            <div class="col">
                                In the resignation management is where the HR staff will find all of the resignation application of the employee.
                                The HR staff will be able to view their submitted resignation letter.
                                Below the resignation letter are two buttons which is the "Approve" and "Deny" button.

                                <br>
                                <h6>Approve</h6>
                                When the HR staff click the "Approve" button, the offboarding controls will appear where in the HR staff will have to add all of the offboarding details and the clearance task.

                                <br>
                                <h6>Deny</h6>
                                In order to deny a resignation application, the HR staff will have to click the "Deny" button which will remove their resignation application.
                            </div>
                            <div class="col">
                                <img src="/manual/staff/offboarding/4.jpg" class="w-100">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h6>Offboarding Clearance</h6>
                                <div class="row">
                                    <div class="col">
                                        In order to add clearance task, the HR staff will have to type in the clearance task name and click "Add" button.
                                        To confirm the clearance task was added, the HR staff should be able to see the new task in the Clearance list.
                                        <br>
                                        Once satisfied, the HR staff will now have to click the confirm button which will be found below.
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <img src="/manual/staff/offboarding/7.jpg" class="w-100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="offboardee" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <h3 class="alert-light p-4">Offboardee Management</h3>
                <div class="px-4 mx-5">
                    <h6 class="text-primary">Description</h6>
                    <p class="w-75">
                        The HR staff will have the ability to handle all of the offboardees who have completed their clearance or are currently working toward it through the Offboardee Management system.
                        The HR staff will have measures in place to mark whether or not an offboardee has completed the Clearance assignment.
                    </p>
                    <img src="/manual/staff/offboardee/1.jpg" class="w-100">

                    <br>
                    <h6 class="text-primary">Functions</h6>
                    <p class="w-75" >The functions of the Offboardee Management page are listed below:</p>
                    <ul class="ms-5">
                        <li><a class="ps-3 m-3" href="#offboardee/function1">Managing Offboardee</a></li>
                    </ul>

                    <div id="offboardee/function1">
                        <h4 class="text-primary">Managing Offboardee</h4>
                        <div class="row">
                            <div class="col">
                                This is the Offboardee table where in the HR staff will be able to find all of the offboardee and see their progress in the clearance.
                            </div>
                            <div class="col">
                                <img src="/manual/staff/offboardee/1.jpg" class="w-100">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h6>Clearance</h6>
                                When the offboardee has a clearance list on their records, this means that they are not done with their clearance.
                                The HR staff will be able to see their clearance task and whether it is done or to be accomplished.
                                Once the employee have accomplished the task, the HR staff should mark that task as accomplish be clicking the "Mark as Accomplished" button.
                            </div>
                            <div class="col">
                                <img src="/manual/staff/offboardee/4.jpg" class="w-100">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h6>Deleting Employee Account</h6>
                                Once the offboardee is down with the clearance, the HR staff will be able to delete their records and account.
                                The HR staff will have to click the "Delete" button which will delete the account of the offboardee.
                                An email will be sent to the deleted employee which will contain their Certificate of Employment.
                                The employee can also request the Certificate of Employmeny after deletion.
                            </div>
                            <div class="col">
                                <img src="/manual/staff/offboardee/3.jpg" class="w-100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="schedule" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <h3 class="alert-light p-4">Schedule Management</h3>
                <div class="px-4 mx-5">
                    <h6 class="text-primary">Description</h6>
                    <p class="w-75">
                        In the Schedule Management, the HR staff will be able to view all of the schedule of the employees.
                        The HR staff will also have the controls in order to change the Schedule days of the employee and their time in/ time out.
                    </p>
                    <img src="/manual/staff/schedule/1.jpg" class="w-100">

                    <br>
                    <h6 class="text-primary">Functions</h6>
                    <p class="w-75" >The functions of the Schedule Management page are listed below:</p>
                    <ul class="ms-5">
                        <li><a class="ps-3 m-3" href="#schedule/function1">Schedule Days</a></li>
                        <li><a class="ps-3 m-3" href="#schedule/function2">Time In / Time Out</a></li>
                    </ul>

                    <div id="schedule/function1">
                        <h4 class="text-primary">Schedule Days</h4>
                        <div class="row">
                            <div class="col">
                                In order to edit the scheduled days of work of an employee, the HR staff will have to click the "Edit Schedule Days" button to enable the controls.
                                The HR staff will then have to check all of the days that the employee will have to work.
                                Then click "Submit New Schedule" in order to save the new schedule of the employee.
                            </div>
                            <div class="col">
                                <img src="/manual/staff/schedule/2.jpg" class="w-100">
                            </div>
                        </div>
                    </div>
                    <div id="schedule/function2">
                        <h4 class="text-primary">Time In / Time Out</h4>
                        <div class="row">
                            <div class="col">
                                In order to change the Time in / Time out of the employee, the HR staff will have to click the "Edit schedule" button and then select the new time.
                                After selecting, the hr staff will have to click "Edit Schedule" button in order to save the new time in.
                            </div>
                            <div class="col">
                                <img src="/manual/staff/schedule/3.jpg" class="w-100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="interview" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <h3 class="alert-light p-4">Interview Management</h3>
                <div class="px-4 mx-5">
                    <h6 class="text-primary">Description</h6>
                    <p class="w-75">
                        In the Interview Management module, this is where the HR staff will be able to schedule the first and the second interview of an application.
                        In here, they HR staff will also be able to record the score and the feedback on the applicant's interview.
                    </p>
                    <img src="/manual/staff/schedule/1.jpg" class="w-100">

                    <br>
                    <h6 class="text-primary">Functions</h6>
                    <p class="w-75" >The functions of the Interview Management page are listed below:</p>
                    <ul class="ms-5">
                        <li><a class="ps-3 m-3" href="#interview/function1">Interviews</a></li>
                    </ul>

                    <div id="interview/function1">
                        <h4 class="text-primary">Interviews</h4>
                        <div class="row">
                            <h6>Scheduling of Interviews</h6>
                            <div class="col">
                                In order to schedule an interview of an applicant, the HR staff will have to select the date and time using the Date and time picker.
                                Once the HR staff have select the date and time, they will have to click the "Add Schedule" button.
                            </div>
                            <div class="col">
                                <img src="/manual/staff/interview/3.jpg" class="w-100">
                            </div>
                        </div>
                        <div class="row">
                            <h6>Updating Interviews</h6>
                            <div class="col">
                                Once the interview has been scheduled, this controls will now show which will be able to record the score and the feed back on that interview. The hr staff will also have the option to mark that interview as no response or reschedule the interview.
                            </div>
                            <div class="col">
                                <img src="/manual/staff/interview/4.jpg" class="w-100">
                            </div>
                        </div>
                        <div class="row">
                            <h6>Recording of Score and Feedback</h6>
                            <div class="col">
                                In order to record the feedback on an interview, the hr staff will have to click the "Responded" button.
                                After clicking this control will show which enables the hr staff to select whether the interview is a Passed or a Fail.
                                They will also be able to add a feedback.
                                Once satisfied, the HR staff can click the "Confirm" button to record the feedback.
                            </div>
                            <div class="col">
                                <img src="/manual/staff/interview/5.jpg" class="w-100">
                            </div>
                        </div>
                        <div class="p-3"></div>
                        <div class="row">
                            <div class="col">
                                <h6>Passed</h6>
                                When an interview is marked as passed this will show which can be clicked to show the feedback and the score
                                <img src="/manual/staff/interview/2.jpg" class="w-100">
                            </div>
                            <div class="col">
                                <h6>No response</h6>
                                This is what it looks like when an interview is marked as no response.
                                <img src="/manual/staff/interview/7.jpg" class="w-100">
                            </div>
                            <div class="col">
                                <h6>Failed</h6>
                                This is when the interview is failed which can be clicked to reveal the feedback.
                                <img src="/manual/staff/interview/6.jpg" class="w-100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="department" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <h3 class="alert-light p-4">Department Management</h3>
                <div class="px-4 mx-5">
                    <h6 class="text-primary">Description</h6>
                    <p class="w-75">
                        The department management module provides overview of all the departments.
                        It provide function to add new departments to the record.
                        In this module the HR staff will also be able to change the department of employees.
                    </p>
                    <img src="/manual/staff/department/1.jpg" class="w-100">

                    <br>
                    <h6 class="text-primary">Functions</h6>
                    <p class="w-75" >The functions of the Department Management page are listed below:</p>
                    <ul class="ms-5">
                        <li><a class="ps-3 m-3" href="#department/function1">Department Overview</a></li>
                        <li><a class="ps-3 m-3" href="#department/function2">Update Employee Department</a></li>
                    </ul>

                    <div id="department/function1">
                        <h4 class="text-primary">Department Overview</h4>
                        <div class="row">
                            <div class="col">
                                In the department overview, the HR staff will be able to see how many employees their is in the department.
                                <img src="/manual/staff/department/2.jpg" class="w-100">
                            </div>
                        </div>

                        <div class="row">
                            <h5>Adding New Department</h5>
                            <div class="col">
                                In order to add new department, the hr staff will have to enter the name of the new department in the text box that is provided.
                                When the hr staff is satisfied, they will need to click the save department to save the record of the new department.
                            </div>
                            <div class="col">
                                <img src="/manual/staff/department/4.jpg" class="w-100">
                            </div>
                        </div>
                    </div>
                    <div id="department/function2">
                        <h4 class="text-primary">Update Employee Department</h4>
                        <img src="/manual/staff/department/5.jpg" class="w-75">
                        This is the section where in the hr staff will be able to change the department of an employee
                        <br><br>
                        Updating Employee Department involves three steps:
                        <ol>
                            <li><b>Selecting Employees</b></li>
                            <div class="row">
                                <div class="col">
                                    In the Employee selection table, you will be able to search, filter employees, and select employees by clicking the "select" button beside the employee details.
                                    The button will show green if the employee is selected.
                                    <img src="/manual/staff/department/6.jpg" class="w-100">
                                </div>
                                <div class="col">
                                    You can confirm that the employee is selected if it is added in the "Selected Employees" Table
                                    <img src="/manual/staff/department/7.jpg" class="w-100">
                                </div>
                            </div>
                            <br><br>
                            <li><b>Updating Employee Department Details</b></li>
                            <div class="row">
                                <div class="col">
                                    The HR staff will have to select the new department of the employees using the drop down control. By clicking the control, it will reveal all of the available departments which they can select.
                                </div>
                                <div class="col">
                                    <img src="/manual/staff/department/8.jpg" class="w-100">
                                </div>
                            </div>
                            <br><br>
                            <li><b>Clicking "Update Employee Department" button</b></li>
                            <div class="row">
                                <div class="col">
                                    After clicking the "Update Employee Department" button the departments of the employees will be change.
                                </div>
                                <div class="col">
                                    <img src="/manual/staff/department/9.jpg" class="w-100">
                                </div>
                            </div>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="position" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <h3 class="alert-light p-4">Position Management</h3>
                <div class="px-4 mx-5">
                    <h6 class="text-primary">Description</h6>
                    <p class="w-75">
                    </p>
                    <img src="/manual/staff/position/1.jpg" class="w-100">

                    <br>
                    <h6 class="text-primary">Functions</h6>
                    <p class="w-75" >The functions of the Position Management page are listed below:</p>
                    <ul class="ms-5">
                        <li><a class="ps-3 m-3" href="#position/function1">Position Overview</a></li>
                        <li><a class="ps-3 m-3" href="#position/function2">Update Employee Position</a></li>
                    </ul>

                    <div id="position/function1">
                        <h4 class="text-primary">Position Overview</h4>
                    </div>
                    <div id="position/function2">
                        <h4 class="text-primary">Update Employee Position</h4>
                    </div>

                    <div id="position/function1">
                        <h4 class="text-primary">Position Overview</h4>
                        <div class="row">
                            <div class="col">
                                In the Position overview, the HR staff will be able to see how many employees their is in a Position.
                                <img src="/manual/staff/position/2.jpg" class="w-100">
                            </div>
                        </div>

                        <div class="row">
                            <h5>Adding New Position</h5>
                            <div class="col">
                                In order to add new Position, the hr staff will have to enter the name of the new Position in the text box that is provided as well as the position description.
                                When the hr staff is satisfied, they will need to click the save Position to save the record of the new Position.
                            </div>
                            <div class="col">
                                <img src="/manual/staff/position/4.jpg" class="w-100">
                            </div>
                        </div>
                    </div>

                    <div id="position/function2">
                        <h4 class="text-primary">Update Employee Position</h4>
                        <img src="/manual/staff/position/5.jpg" class="w-75">
                        This is the section where in the hr staff will be able to change the Position of an employee
                        <br><br>
                        Updating Employee Position involves three steps:
                        <ol>
                            <li><b>Selecting Employees</b></li>
                            <div class="row">
                                <div class="col">
                                    In the Employee selection table, you will be able to search, filter employees, and select employees by clicking the "select" button beside the employee details.
                                    The button will show green if the employee is selected.
                                    <img src="/manual/staff/position/6.jpg" class="w-100">
                                </div>
                                <div class="col">
                                    You can confirm that the employee is selected if it is added in the "Selected Employees" Table
                                    <img src="/manual/staff/position/7.jpg" class="w-100">
                                </div>
                            </div>
                            <br><br>
                            <li><b>Updating Employee Position Details</b></li>
                            <div class="row">
                                <div class="col">
                                    The HR staff will have to select the new Position of the employees using the drop down control. By clicking the control, it will reveal all of the available Positions which they can select.
                                </div>
                                <div class="col">
                                    <img src="/manual/staff/position/8.jpg" class="w-100">
                                </div>
                            </div>
                            <br><br>
                            <li><b>Clicking "Update Employee Position" button</b></li>
                            <div class="row">
                                <div class="col">
                                    After clicking the "Update Employee Position" button the Positions of the employees will be change.
                                </div>
                                <div class="col">
                                    <img src="/manual/staff/position/9.jpg" class="w-100">
                                </div>
                            </div>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="audit" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <h3 class="alert-light p-4">Audit Logs</h3>
                <div class="px-4 mx-5">
                    <h6 class="text-primary">Description</h6>
                    <p class="w-75">
                        In the Audit Logs Module is where all of the HR staffs actions are listed. The HR staff can search through the records using the search bar as well as change the number of records using the entries filter.
                        The table displays all necessary informations such as the HR staff name, a brief description of the activity, affected employee name, and activity details.
                        The displayed records can also be generetad into a PDF report. All report is stored in the system a can be viewed in this module.
                    </p>
                    <br>
                    <img src="/manual/staff/audit/1.jpg" class="w-100">

                    <h6 class="text-primary">Functions</h6>
                    <p class="w-75" >The functions of the Audit Logs page are listed below:</p>
                    <ul class="ms-5">
                        <li><a class="ps-3 m-3" href="#audit/function1">Audit Logs</a></li>
                        <li><a class="ps-3 m-3" href="#audit/function2">Audit History</a></li>
                    </ul>

                    <div id="audit/function1">
                        <div class="row my-5">
                            <h4 class="text-primary">Audit Logs</h4>
                            <img src="/manual/staff/audit/1.jpg" class="w-100">
                            In the Audit Logs section is where the "Audit Logs" table is located. This is where the HR staff will be able to see all of the audit records.
                            Above the "Audit Logs" table, the "Generate Audit Summary" button is located

                            <br>
                            <h5 class="text-primart">Generate Audit Summary</h5>
                            <div class="row">
                                <div class="col">
                                    First, click the "Generate Audit Summary" button.
                                </div>
                                <div class="col">
                                    <img src="/manual/staff/audit/2.jpg" class="w-100">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    The "Generate Audit Summary" button will change into two buttons which is the "PDF" and cancel button. Once the "PDF" button is clicked, a new tab will show which will generate the audit summary into a PDF format
                                </div>
                                <div class="col">
                                    <img src="/manual/staff/audit/3.jpg" class="w-100">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="leave/function2">
                        <div class="row my-5">
                            <h4 class="text-primary">Audit History</h4>
                            In the "Audit History" is where all of the generated audit summary can be viewed and download. The HR staff will have to select a audit summary file using the buttons with their file name on it.
                            <img src="/manual/staff/audit/4.jpg" class="w-100">
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
                <div class="row m-5 p-3">
                    <div class="col">
                        The HR staff will be required to upload their signature in the profile module.
                        The signature will be used in producing the Certificate of Employment of the employees that will be ofboarded.
                        <br>
                        The HR staff will have to upload their picture and then "Click" submit to save the e-signature.
                    </div>
                    <div class="col">
                        <img src="/manual/staff/1.jpg" class="w-100">
                    </div>
                </div>
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
        console.log(btn)
        var manual_buttons = document.querySelectorAll('.manual_button')
        manual_buttons.forEach(element => {
            element.className = "manual_button nav-link text-dark h5"
        });

        btn.className = "manual_button nav-link h5 alert-primary"
    }
</script>
@endsection
