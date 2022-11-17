@extends('layout.employee_app')

@section('title')
@endsection
<style>
    .nav-link{
        margin-top: 11px;
    }
</style>

<script>
    function changeButtonColor(btn){
        var manual_buttons = document.querySelectorAll('.manual_button')
        manual_buttons.forEach(element => {
            element.className = "manual_button nav-link text-dark h5"
        });

        btn.className = "manual_button nav-link h5 alert-primary"
    }

    var observer = new IntersectionObserver(function(entries) {

        entries.forEach((element)=>{
            if(element.isIntersecting === true){
                changeButtonColor(document.getElementById(`${element.target.id}_btn`))
            }
        })
    }, { threshold: [0] });
</script>

@section('content')
<div class="row" style="position:fixed; top:0; width:94vw;" >
    <div class="col-2 bg-white p-0" >
        <ul class="nav flex-column alert-light w-100 p-0">
            <li class="nav-item p-0 m-0" style="height: 43px">
                <a class="manual_button nav-link h5 alert-primary" id="home_btn" onclick="changeButtonColor(this)" aria-current="page" href="#home">
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
                <a class="manual_button nav-link text-dark h5" id="video_btn" onclick="changeButtonColor(this)" href="#video">
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
                <a class="manual_button nav-link text-dark h5" id="video_btn" onclick="changeButtonColor(this)" href="#video">
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
                <a class="manual_button nav-link text-dark h5" id="video_btn" onclick="changeButtonColor(this)" href="#video">
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
                <a class="manual_button nav-link text-dark h5" id="overtime_btn" onclick="changeButtonColor(this)" href="#overtime">
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
                <a class="manual_button nav-link text-dark h5" id="leave_btn" onclick="changeButtonColor(this)" href="#leave">
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
                <a class="manual_button nav-link text-dark h5" id="messages_btn" onclick="changeButtonColor(this)" href="#messages">
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
                <a class="manual_button nav-link text-dark h5" id="profile_btn" onclick="changeButtonColor(this)" href="#profile">
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
        <div class="card" style="overflow-x: hidden; overflow-y: scroll; height:100vh">
            <div class="row p-5"></div><div class="row p-5"></div>
            <h1 class="section-title w-100 text-center mt-1">User Manual</h1>
            <div class="row p-5"></div><div class="row p-5"></div>

            <div id="home" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <script>
                    observer.observe(document.querySelector('#home'));
                </script>
                <h3 class="alert-light p-4">Home / Dashboard</h3>
                <div class="px-4 mx-5">
                    <h6 class="text-primary">Description</h6>
                    <p class="w-75">
                        This is the employee dashboard this is where the employee can time in and time out, answer health check list, view thier weekly schedule, view payslips, and see their notifications.
                    </p>
                    <br>
                    <img src="/manual/employee/home/4.jpg" class="w-100">
                    <h6 class="text-center w-100 p-3">1.1 Employee Dashboard</h6>


                    <br>
                    <h6 class="text-primary">Functions</h6>
                    <p class="w-75" >The functions of the Payroll Dashboard page are listed below:</p>
                    <ul class="ms-5">
                        <li><a class="ps-3 m-3" href="#home/function1">Attendance</a></li>
                        <li><a class="ps-3 m-3" href="#home/function2">Payslip History</a></li>
                        <li><a class="ps-3 m-3" href="#home/function3">Notification</a></li>
                    </ul>

                    <div id="home/function1">
                        <h4 class="text-primary">Attendance</h4>
                        <ul>
                            <li>
                                <h5 class="text-primary">No schedule</h5>
                                <div class="row">
                                    <div class="col">
                                        When the employee is not schedule to work for the day this will be the display.
                                        The time in and time out controls will not be present
                                    </div>
                                    <div class="col">
                                        <img src="/manual/employee/home/1.jpg" class="w-100">
                                        <h6 class="text-center w-100 p-3">1.1.1 Attendance Recording Controls</h6>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <h5 class="text-primary">Time in / Time out</h5>
                                <div class="row">
                                    <div class="col">
                                        When the employee is scheduled to work for the day, the time in and time ou controls will be display.
                                        The employee can then click the "Time in" or "Time out" button to perform the actions.
                                    </div>
                                    <div class="col text-center">
                                        <img src="/manual/employee/home/7.jpg" class="w-75">
                                        <h6 class="text-center w-100 p-3">1.1.2 Time in / Time out Controls</h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        Once the Employee clicked time in, the employee is required to answer the health check list form that will be displayed after the time in.
                                    </div>
                                    <div class="col text-center">
                                        <img src="/manual/employee/home/5.jpg" class="w-75">
                                        <h6 class="text-center w-100 p-3">1.1.3 Health Check List</h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        The system will validate your answer an provide the appropriate health status based on the evaluation
                                    </div>
                                    <div class="col text-center">
                                        <img src="/manual/employee/home/8.jpg" class="w-75">
                                        <h6 class="text-center w-100 p-3">1.1.4 Health Check Status</h6>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <h5 class="text-primary">Schedule / Attendance History</h5>
                                Below the attendance controls is where the schedule and Attendance history are located. The employee can use the calendar view to check their schedule for the week.
                                The employee can also see their attendance history and they will be able to see that green attendance are complete attendance while the red once are under time attendance.
                                <img src="/manual/employee/home/2.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">1.1.5 Schedule and Attendance History View</h6>
                            </li>
                        </ul>
                    </div>
                    <div id="home/function2">
                        <h4 class="text-primary">Payslip History</h4>
                        <div class="row">
                            <div class="col">
                                In the bottom part of the Employee Dashboard is where the Payslip history is located. The employee will be able to see all of the generetad payslips and they will be able to view and download it by clicking the "Open" button ono the selected payslip.
                            </div>
                            <div class="col">
                                <img src="/manual/employee/home/9.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">1.2.1 Payslip History</h6>
                            </div>
                        </div>
                    </div>
                    <div id="home/function3">
                        <h4 class="text-primary">Notification</h4>
                        <div class="row">
                            <div class="col">
                                In the bottom part of the Employee Dashboard is where the Notifications is located.
                                This is where all of the recieved notification will be displayed.
                                The employee can send their acknowledgement by clicking the "Send Acknowledgement" button to let the HR user know that they have read the notification.
                            </div>
                            <div class="col">
                                <img src="/manual/employee/home/3.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">1.3.1 Notification Panel</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="video" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <script>
                    observer.observe(document.querySelector('#video'));
                </script>
                <h3 class="alert-light p-4">Lesson Modules</h3>
                <div class="px-4 mx-5">
                    <div class="row text-center w-100">
                        <div class="col p-4 alert-success">
                            Orientation
                        </div>
                        <div class="col p-4 alert-primary">
                            Training
                        </div>
                        <div class="col p-4 alert-danger">
                            Correction
                        </div>
                    </div>
                    <div class="p-4"></div>
                    <h6 class="text-primary">Description</h6>
                    <p class="w-75">
                        In the different video modules, the employee will find all of the instructional videos that they are required to watch. In this module, the employee can also track their progress on the module.
                    </p>
                    <img src="/manual/employee/videos/2.jpg" class="w-100">
                    <h6 class="text-center w-100 p-3">2.1 Lesson Modules</h6>

                    <div class="row mt-5">
                        <h6 class="text-primary">Tracking Progress</h6>
                        <div class="row">
                            <div class="col">
                                For the employee to track their progress in the learning module, the progress tracker is displayed on top of the page.
                                The tracker display the start date and the end date of the their enrollment to that module.
                                Below that is their progress which shows how many videos are their and how many they have finished.
                            </div>
                            <div class="col">
                                <img src="/manual/employee/videos/6.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">2.2 Progress Tracker View</h6>
                            </div>
                        </div>
                    </div>
                    <div class="p-3"></div>
                    <div class="row">
                        <h6 class="text-primary">Video</h6>
                        <div class="row">
                            <div class="col">
                                In each video display, the employee will be able to play the video as well as see the video details such as the title of that lesson and some lesson notes that the HR admin have placed.
                                <img src="/manual/employee/videos/3.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">2.3 Video Lesson</h6>
                            </div>
                            <div class="col">
                                Once the employee have finished the video, they will be able to mark that lesson as completed which will add to the progress on the module.
                                <img src="/manual/employee/videos/5.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">2.4 Video Lesson Mark as Complete Button</h6>
                            </div>
                            <div class="col">
                                Once the lesson is finished, it will be displayed like this which is marked with complete and they still be able to watch the video.
                                <img src="/manual/employee/videos/7.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">2.5 Completed Video Lesson</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="overtime" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <script>
                    observer.observe(document.querySelector('#overtime'));
                </script>
                <h3 class="alert-light p-4">Overtime</h3>
                <div class="px-4 mx-5">
                    <h6 class="text-primary">Description</h6>
                    <p class="w-75">The Leave Module is where employee user will be able to create and submit their leave application to the payroll manager for their approvals. The employee will also be able to view their previously submitted leave application in this module</p>

                    <br>
                    <h6 class="text-primary">Functions</h6>
                    <p class="w-75" >The functions of the Payroll Dashboard page are listed below:</p>
                    <ul class="ms-5">
                        <li><a class="ps-3 m-3" href="#overtime/function1">Apply For Overtime</a></li>
                        <li><a class="ps-3 m-3" href="#overtime/function2">Overtime Application History</a></li>
                    </ul>

                    <div id="overtime/function1">
                        <div class="row my-5">
                            <h4 class="text-primary">Apply For Overtime</h4>
                            <div class="col-3">
                                This is the section where in employees select an attendance that is eligible for overtime and apply it for overtime payment. This section provide controls in order to submit a message to the payroll manager for the overtime application.
                            </div>
                            <div class="col">
                                <img src="/manual/employee/overtime/1.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">3.1 Overtime Application Cotrols</h6>
                            </div>

                            <div class="p-3"></div>
                            <h6 class="text-primary">Creating a Leave Application</h6>
                            <ol>
                                <li>
                                    <h6 class="text-primary">Selecting Eligible Attendance</h6>
                                    <div class="row">
                                        <div class="col">
                                            The employee can select an eligible attendance using the Attendance table. The employee can use the different filters above the tables to change the view of the table.
                                            The first filter is the excess hours filter. The employee can select an excess hour amount using this filter to show only the attendance that are equal or over the hour filter.
                                            The next filter is the start and end date filter. Using this filter the employee can select the attendance that are in the period of the date filters.
                                            The employee can also use the search bar to search through the records.
                                        </div>
                                        <div class="col">
                                            <img src="/manual/employee/overtime/5.jpg" class="w-100">
                                            <h6 class="text-center w-100 p-3">3.1.1 Overtime Table</h6>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <h6 class="text-primary">Adding Message</h6>
                                    <div class="row">
                                        <div class="col">
                                            After selecting an eligible attedance, the employee can confirm the attendance if the attendance display is displayed on the overtime application details.
                                            <br>
                                            <div class="p-2"></div>
                                            The employee will then have to add a brief message that will describe their overtime application and the payroll manager will be able to view their message.
                                        </div>
                                        <div class="col">
                                            <img src="/manual/employee/overtime/6.jpg" class="w-100">
                                            <h6 class="text-center w-100 p-3">3.1.2 Overtime Application Controls</h6>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <h6 class="text-primary">Submit Application</h6>
                                    <div class="row">
                                        <div class="col">
                                            After preparing the overtime application, the employee will have to click the "Submit Application" button to submit the overtime application.
                                        </div>
                                        <div class="col">
                                            <img src="/manual/employee/overtime/7.jpg" class="w-100">
                                            <h6 class="text-center w-100 p-3">3.1.1 Submit Application Button</h6>
                                        </div>
                                    </div>
                                </li>
                            </ol>
                        </div>
                    </div>

                <div id="overtime/function2">
                    <h4 class="text-primary">Overtime Application History</h4>
                    In the Overtime Applcation history is where that employee can find all of the previously sent overtime application.
                    In the overtime records, they can see the overtime details, their message to the payroll manager, the attendance details, and the approval status of the overtime application.
                    If the application is still pending, the employee can remove the overtime application by clicking the "Cancel Application" button on the record.
                    <img src="/manual/employee/overtime/8.jpg" class="w-100">
                    <h6 class="text-center w-100 p-3">3.2.1 Overtime Application History</h6>
                    </div>
                </div>
            </div>


            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="leave" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <script>
                    observer.observe(document.querySelector('#leave'));
                </script>
                <h3 class="alert-light p-4">Leave</h3>
                <div class="px-4 mx-5">
                    <h6 class="text-primary">Description</h6>
                    <p class="w-75">The Leave Module is where employee user will be able to create and submit their leave application to the payroll manager for their approvals. The employee will also be able to view their previously submitted leave application in this module</p>

                    <br>
                    <h6 class="text-primary">Functions</h6>
                    <p class="w-75" >The functions of the Payroll Dashboard page are listed below:</p>
                    <ul class="ms-5">
                        <li><a class="ps-3 m-3" href="#leave/function1">Apply For Leave</a></li>
                        <li><a class="ps-3 m-3" href="#leave/function2">Leave Application History</a></li>
                    </ul>

                    <div id="leave/function1">
                        <div class="row my-5">
                            <h4 class="text-primary">Apply For Leave</h4>
                            <div class="col-3">
                                This is the section where in employees can create their leave applications. This section provide controls in order to create a detailed leave application.
                            </div>
                            <div class="col">
                                <img src="/manual/employee/leave/1.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">4.1.1 Leave Application Controls</h6>
                            </div>

                            <div class="p-3"></div>
                            <h6 class="text-primary">Creating a Leave Application</h6>
                            <ol>
                                <li>
                                    <h6 class="text-primary">Type in a leave application letter</h6>
                                    <div class="row">
                                        <div class="col">
                                            The employee needs to type in the Leave Application Title which will briefly describes the leave application.
                                            Next, the employee needs to type in the Leave application details where in the employee can provide a detailed message for the payroll manager to read.
                                        </div>
                                        <div class="col">
                                            <img src="/manual/employee/leave/3.jpg" class="w-100">
                                            <h6 class="text-center w-100 p-3">4.1.1 Leave Application Details Control</h6>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <h6 class="text-primary">Add the Leave start date and end date</h6>
                                    <div class="row">
                                        <div class="col">
                                            After typing the leave application letter, the employee needs to add the start date and the end date of the leave application.
                                            By clicking the date filter that was provided, the user can select their desired date.
                                            After adding the start and end date, the total days of leave will be displayed on the Days text box.
                                        </div>
                                        <div class="col">
                                            <img src="/manual/employee/leave/4.jpg" class="w-100">
                                            <h6 class="text-center w-100 p-3">4.1.2 Leave Duration Control</h6>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <h6 class="text-primary">Submit Application</h6>
                                    <div class="row">
                                        <div class="col">
                                            After typing in the leave application letter and adding in the leave details, the employee can then click the "Submit Application" button to submit the leave application which can then be viewed by the payroll manager.
                                        </div>
                                        <div class="col">
                                            <img src="/manual/employee/leave/5.jpg" class="w-100">
                                            <h6 class="text-center w-100 p-3">4.1.3 Submit Application Button</h6>
                                        </div>
                                    </div>
                                </li>
                            </ol>
                        </div>
                    </div>

                    <div id="leave/function2">
                        <h4 class="text-primary">Leave Application History</h4>
                        In the Leave Application History is where the employee user can find all of the previously sent leave application and see their approval status.
                        <img src="/manual/employee/leave/2.jpg" class="w-100">
                        <h6 class="text-center w-100 p-3">4.2.1 Leave Application History</h6>

                        <div class="p-4"></div>
                        <h6 class="text-primary">Leave Applications Overview</h6>
                        <div class="text-center mx-auto w-75">
                            The employee is able to see how much application they have sent and how much of them are approved or denied.
                            The application are also seperated on whether they are sent on the current year or in other years.
                            <img src="/manual/employee/leave/6.jpg" class="w-100">
                            <h6 class="text-center w-100 p-3">4.2.2 Leave Applications Overview</h6>
                        </div>

                        <h6 class="text-primary">Leave Applications View</h6>
                        <div class="text-center mx-auto w-75">
                            Below the Leave Applcation Overview is where the employee can see all of the submitted leave application and see their details and approval status.
                            The view has three parts and the most left will be the leave application letter. In the middle is where the Leave Details are displayed.
                            In the right most side of the view is where the approval status of the leave application is displayed.
                            <img src="/manual/employee/leave/7.jpg" class="w-100">
                            <h6 class="text-center w-100 p-3">4.2.3 Leave Applications View</h6>
                        </div>
                    </div>
                </div>
            </div>

            @php ($manual_variable_number = 5)
            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="messages" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <script>
                    observer.observe(document.querySelector('#messages'));
                </script>
                @include('inc.common_manual.messages')
            </div>

            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="profile" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <script>
                    observer.observe(document.querySelector('#profile'));
                </script>
                <h3 class="alert-light p-4">Employee Profile</h3>
                <div class="px-4 mx-5">
                    <h6 class="text-primary">Description</h6>
                    <p class="w-75">The Employee Profile module is where the employee will find their account details, detailed attendance history, their assessment overview, and thier performance assessment records.
                        The employee can use this module to submit their resignation and track the progress of their resignation.
                        This module also offers functions to update their employee profile.
                    </p>
                    <img src="/manual/employee/profile/1.jpg" class="w-100">
                    <h6 class="text-center w-100 p-3">6.1 Employee Profile</h6>


                    <br>
                    <h6 class="text-primary">Functions</h6>
                    <p class="w-75" >The functions of the Payroll Dashboard page are listed below:</p>
                    <ul class="ms-5">
                        <li><a class="ps-3 m-3" href="#profile/function1">Attendance Overview</a></li>
                        <li><a class="ps-3 m-3" href="#profile/function2">Assessment Overview</a></li>
                        <li><a class="ps-3 m-3" href="#profile/function3">Assessment History</a></li>
                        <li><a class="ps-3 m-3" href="#profile/function4">Update Profile</a></li>
                        <li><a class="ps-3 m-3" href="#profile/function5">Resignation</a></li>
                        <li><a class="ps-3 m-3" href="#profile/function6">Update Profile Picture</a></li>
                    </ul>

                    <div id="profile/function1">
                        <h4 class="text-primary">Attendance Overview</h4>
                        <div class="row">
                            <h5 class="text-primary">Attendance Calendar View</h4>
                            <div class="col">
                                In the attendance overview is where the employee will see a calendar where in they will find their attendance history.
                                The dates in the calendar view will be marked accourding to the attendance status on that date and if it is not marked, that date is not in the employee schedule.
                                Along with the mark is the employee time in record and the time out record.
                            </div>
                            <div class="col">
                                <img src="/manual/employee/profile/11.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">6.1.1 Attendance Calendar View</h6>
                            </div>
                        </div>
                        <div class="row">
                            <h4 class="text-primary">Overall Attendance Summary</h4>
                            <div class="col">
                                Below the Attendance Calendar View is where the Overall Attendance Summary can be found.
                                The Pie chart displays the Overall attendance status of the employee.
                                The Employee can hover their mouse on each slice to get the actual number.
                            </div>
                            <div class="col">
                                <img src="/manual/employee/profile/2.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">6.1.2 Overall Attendance Summary</h6>
                            </div>
                        </div>
                    </div>

                    <div id="profile/function2">
                        <h4 class="text-primary">Assessment Overview</h4>
                        <div class="row">
                            <div class="col">
                                In the assessment overview the employee will find the Assessment summary where in they will be able to distiguish their assessment percentage on the four categories which are the performance, attenance, cooperation, and character.
                            </div>
                            <div class="col">
                                <img src="/manual/employee/profile/3.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">6.2.1 Assessment Overview</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                Below the assessment overview is the Employee Characterstics which is the section where the employee wil find a spider web chart which accurately displays their assessment scores and be able to distingiush their strong points and weak points.
                            </div>
                            <div class="col">
                                <img src="/manual/employee/profile/4.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">6.2.2 Employee Characterstics Chart</h6>
                            </div>
                        </div>
                    </div>

                    <div id="profile/function3">
                        <h4 class="text-primary">Assessment History</h4>
                        <div class="row">
                            <div class="col">
                                The assessment history is where the employee can find the assessment that their HR manager have made for them.
                                In the assessment records can be found their scores and the feed back of the HR manager to them.
                                Below this is the, web chart where in their scores are visualized to be easily understandable.
                            </div>
                            <div class="col">
                                <img src="/manual/employee/profile/5.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">6.3.1 Assessment History</h6>
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col">
                                The user can you the year selection on the side of the the assessment view to display assessment from different years.
                            </div>
                            <div class="col">
                                <img src="/manual/employee/profile/7.jpg" class="w-50">
                                <h6 class="text-center w-100 p-3">6.3.2 Assessment History Year Filter</h6>
                            </div>
                        </div>
                    </div>

                    <div class="p-3"></div>

                    <div class="row">
                        Below the Employee Profile details is where they will find this three buttons which will enable them to access the different feature such as update profile, change picture, and resign.
                        <img src="/manual/employee/profile/12.jpg" class="w-100">
                        <h6 class="text-center w-100 p-3">6.3.3 Update Profile, Change Picture, and Resign buttons</h6>
                    </div>

                    <div id="profile/function4">
                        <h4 class="text-primary">Update Profile</h4>
                        <div class="row">
                            <h5 class="text-primary">To Update Employee Profile</h5>
                            <div class="col">
                                When the "Update Profile" is clicked, they will be redirected to this page.
                                To update the account details, the employee will have to replace the details in the text boxes and controls that are provided for each account details.
                                Once satisfied, they will have to click the "Save Changes" button below the page.
                                <img src="/manual/employee/profile/update/1.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">6.4.1 Update Employee Profile</h6>
                            </div>
                            <div class="col">
                                Below the profile detail controls the employee can find their submitted resume. They can also update their submitted resume just by uploading it using the provided controls and then clicking the "Save Changes" button below the page.
                                <img src="/manual/employee/profile/update/2.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">6.4.2 Submitted Resume</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                Below the employee profile display is where the "Change Password" button can be found. The employee can click the button if they want to change their password.
                                <img src="/manual/employee/profile/update/4.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">6.4.3 Change Password Button</h6>
                            </div>
                            <div class="col">
                                Once clicked, the employee will be redirected to this page where in they will find the controls to change their account password.
                                They will have to input their current password, their new password, and re-enter the new password to confirm it.
                                Once satisfied, they will have to click "Confirm Changes" button to change their account password.
                                <img src="/manual/employee/profile/update/5.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">6.4.4 Change Password Controls</h6>
                            </div>
                        </div>
                    </div>
                    <div id="profile/function5">
                        <h4 class="text-primary">Resignation</h4>
                        <div class="row">
                            <div class="col">
                                When the employee click the resign button, this module will pop up where in they will be asked to upload their resignation letter.
                                Once they upload their letter, they can then click submit to confirm their resignation.
                            </div>
                            <div class="col">
                                <img src="/manual/employee/profile/9.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">6.5.1 Submittion of Resignation Letter</h6>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                Once a resignation is submitted, the resign button will change into this button
                            </div>
                            <div class="col">
                                <img src="/manual/employee/profile/13.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">6.5.2 Application Submitted Button</h6>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                In order to track their resignation progress, the employee will have to click the "Application Submitted" button.
                                Once the button is clicked this window will show which will display the approval status and their resignation letter.
                                Below the letter is where the employee will find the Delete Application button which is only available when their resignation status is still on pending.
                            </div>
                            <div class="col">
                                <img src="/manual/employee/profile/10.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">6.5.3 Application Submitted Overview</h6>
                            </div>
                        </div>

                    </div>
                    <div id="profile/function6">
                        <h4 class="text-primary">Update Profile Picture</h4>
                        <div class="row my-5">
                            <h4 class="text-primary">Change Picture</h4>
                            <div class="row">
                                <div class="col">
                                    To update the User profile picture, first the user will have to click the "Change Picture" button below the user profile display.
                                </div>
                                <div class="col">
                                    <img src="/manual/common/profile/6.jpg" class="w-100">
                                    <h6 class="text-center w-100 p-3">6.6.1 Change Picture Button</h6>
                                </div>
                            </div>
                            <div class="p-3"></div>

                            <div class="row">
                                <div class="col">
                                    In order to change the user picture, the user will have to upload their new profile picture using the "Choose File" button.
                                </div>
                                <div class="col text-center">
                                    <img src="/manual/common/profile/8.jpg" class="w-50">
                                    <h6 class="text-center w-100 p-3">6.6.2 Choose File button</h6>
                                </div>
                            </div>
                            <div class="p-3"></div>

                            <div class="row">
                                <div class="col">
                                    Once the new picture is upload, the user can click the "Save Changes" button to update the account profile picture
                                </div>
                                <div class="col">
                                    <img src="/manual/common/profile/3.jpg" class="w-100">
                                    <h6 class="text-center w-100 p-3">6.6.3 Save Changes button</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
