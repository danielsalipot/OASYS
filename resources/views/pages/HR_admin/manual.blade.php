@extends('layout.admin_app')

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
                        <div class="col pt-1 text-start">
                            Home / Dashboard
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="manual_button nav-link text-dark h5" id="attendance_btn" onclick="changeButtonColor(this)" href="#attendance">
                    <div class="row text-center">
                        <div class="col-2">
                            <i class="bi bi-calendar-check h4 p-0 m-0"></i>
                        </div>
                        <div class="col pt-1 text-start">
                            Attendance Overiew
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="manual_button nav-link text-dark h5" id="regularization_btn" onclick="changeButtonColor(this)" href="#regularization">
                    <div class="row text-center">
                        <div class="col-2">
                            <i class="bi bi-caret-up-square-fill h4 p-0 m-0"></i>
                        </div>
                        <div class="col pt-1 text-start">
                            Regularization
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="manual_button nav-link text-dark h5" id="assessment_btn" onclick="changeButtonColor(this)" href="#assessment">
                    <div class="row text-center">
                        <div class="col-2">
                            <i class="bi bi-bar-chart-line-fill h4 p-0 m-0"></i>
                        </div>
                        <div class="col pt-1 text-start pe-0">
                            Performance Assessment
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="manual_button nav-link text-dark h5" id="orientation_btn" onclick="changeButtonColor(this)" href="#learning">
                    <div class="row text-center">
                        <div class="col-2">
                            <i class="bi bi-journal-bookmark h4 p-0 m-0"></i>
                        </div>
                        <div class="col pt-1 text-start">
                            Orientation Module
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="manual_button nav-link text-dark h5" id="training_btn" onclick="changeButtonColor(this)" href="#learning">
                    <div class="row text-center">
                        <div class="col-2">
                            <i class="bi bi-briefcase-fill h4 p-0 m-0"></i>
                        </div>
                        <div class="col pt-1 text-start">
                            Training Module
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="manual_button nav-link text-dark h5" id="correction_btn" onclick="changeButtonColor(this)" href="#learning">
                    <div class="row text-center">
                        <div class="col-2">
                            <i class="bi bi-wrench h4 p-0 m-0"></i>
                        </div>
                        <div class="col pt-1 text-start">
                            Correction Module
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="manual_button nav-link text-dark h5" id="audit_btn" onclick="changeButtonColor(this)" href="#audit">
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
                <a class="manual_button nav-link text-dark h5" id="activities_btn" onclick="changeButtonColor(this)" href="#activities">
                    <div class="row text-center">
                        <div class="col-2">
                            <i class="bi bi-person-lines-fill h4 p-0 m-0"></i>
                        </div>
                        <div class="col pt-1 text-start">
                            Employee Activities
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="manual_button nav-link text-dark h5" id="forms_btn" onclick="changeButtonColor(this)" href="#forms">
                    <div class="row text-center">
                        <div class="col-2">
                            <i class="bi bi-file-earmark-text-fill h4 p-0 m-0"></i>
                        </div>
                        <div class="col pt-1 text-start">
                            Legal Forms
                        </div>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="manual_button nav-link text-dark h5" id="employeelist_btn" onclick="changeButtonColor(this)" href="#employeelist">
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
                <a class="manual_button nav-link text-dark h5" id="profile_btn" onclick="changeButtonColor(this)" href="#profile">
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
                <a class="manual_button nav-link text-dark h5" id="messages_btn" onclick="changeButtonColor(this)" href="#messages">
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
                <a class="manual_button nav-link text-dark h5" id="notifications_btn" onclick="changeButtonColor(this)" href="#notifications">
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
        <div class="card" style="overflow-x: hidden; overflow-y: scroll; height:100vh">
            <div class="row p-5"></div><div class="row p-5"></div>
            <h1 class="section-title w-100 text-center mt-1">User Manual</h1>
            <div class="row p-5"></div><div class="row p-5"></div>

            <div id="home" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <script>
                    observer.observe(document.querySelector('#home'));
                </script>
                <h3 class="alert-light p-4">Dashboard / Home</h3>
                <div class="px-4 mx-5">
                    <h6 class="text-primary">Description</h6>
                    <p class="w-75">The Admin dashboard is where the HR Admin will be able to see a brief overview of the status of the time in of the employees in current day. They will also be able to see the status of their onboarded employees and be able to decide who to regularize. They will be able to see the current state of the three learning modules immediately in order to know what to change or improve.</p>

                    <br>
                    <h6 class="text-primary">Functions</h6>
                    <p class="w-75" >The functions of the Admin Dashboard page are listed below:</p>
                    <ul class="ms-5">
                        <li><a class="ps-3 m-3" href="#home/function1">Modules Overview</a></li>
                        <li><a class="ps-3 m-3" href="#home/function2">Time in Overview</a></li>
                        <li><a class="ps-3 m-3" href="#home/function3">Regularization Overview</a></li>
                    </ul>

                    <br><br>

                    <div id="home/function1">
                        <div class="row my-5">
                            <h4 class="text-primary">Modules Overview</h4>
                            <div class="col-3">
                                In the learning module section of the dashboard, the HR admin will be able to see how many videos that are currently included in each module. Beside the number of videos section is the number of employees enrolled. The HR admin will be able to see how many employee that are currently enrolled in that module.
                            </div>
                            <div class="col">
                                <img src="/manual/admin/dashboard/modules.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">1.1 Modules Overview</h6>
                            </div>
                        </div>
                    </div>

                    <br><br>

                    <div id="home/function2">
                        <div class="row my-5">
                            <h4 class="text-primary">Time in Overview</h4>
                            <div class="col-3">
                                Below the learning module overview, the HR admin will find the time in overview. In here the HR manager will be able to see all of the employees that timed in, their health check score, as well as whether they are on time or late.
                            </div>
                            <div class="col">
                                <img src="/manual/admin/dashboard/time in overview.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">1.2 Time in Overview</h6>
                            </div>
                        </div>
                    </div>

                    <br><br>

                    <div id="home/function3">
                        <h4 class="text-primary">Regularization Overview</h4>
                        <div class="row">
                            <div class="col">
                                In the right side of the Admin dashboard is the Regularization overview. The HR admin will be able to see all of the non-regular employees and see how long they have been non regular employees. The HR admin will be able to see and select employees in order to go to the regularization feature of the system.
                            </div>
                            <div class="col text-center">
                                <img src="/manual/admin/dashboard/regularization overview.jpg" class="w-50">
                                <h6 class="text-center w-100 p-3">1.3 Regularization Overview</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="attendance" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <script>
                    observer.observe(document.querySelector('#attendance'));
                </script>

                <h3 class="alert-light p-4">Attendance Overview</h3>
                <div class="px-4 mx-5">
                    <h6 class="text-primary">Description</h6>
                    <p class="w-75">
                        In the Attendance Overview is where the HR admin will be able to see all of the attendance status of employees as well as some graphical representation of the attendance status of the company for the current day and for the whole time.
                        The HR admin will also be able to see the attendance status of each position and departments.
                        All of the attendance status of each individual employees can also be viewed in this module.
                    </p>

                    <h6 class="text-primary">Functions</h6>
                    <p class="w-75" >The functions of the Attendance Overview page are listed below:</p>
                    <ul class="ms-5">
                        <li><a class="ps-3 m-3" href="#attendance/function1">Todays Attendance Overview Table</a></li>
                        <li><a class="ps-3 m-3" href="#attendance/function2">Todays Attendance Overview Graph</a></li>
                        <li><a class="ps-3 m-3" href="#attendance/function3">All time Attendance Overview</a></li>
                        <li><a class="ps-3 m-3" href="#attendance/function4">Employee Attendance Overview</a></li>
                    </ul>

                    <div id="attendance/function1">
                        <div class="row my-5">
                            In this table you can see the overview total of employees that is on time, late, and the number of employees that is absent.
                            <img src="/manual/admin/attendance/attendance today total overview.jpg" class="w-75 m-auto">
                            <h6 class="text-center w-100 p-3">2.1.1 Attendance Overview</h6>
                        </div>
                        <div class="row my-5">
                            <div class="col-3">
                                Attendance Today table also contains the details of each employee such as the employee name, schedule time in and time out, time in and time out of the employee, and their health.

                                <div class="p-3"></div>
                                <h5>1. Entries Filter</h5>
                                By clicking the Entries filter dropdown element, you can select the number of rows to be displayed in the table.

                                <div class="p-2"></div>
                                <h5>2. Search Bar</h5>
                                Select the Search bar located on the top right of the table and type your intended information to be searched. The table will automatically all rows with that information

                            </div>
                            <div class="col">
                                <img src="/manual/admin/attendance/attendance overview employee details table.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">2.1.2 Attendance Today Table</h6>
                            </div>
                        </div>
                    </div>

                    <div id="attendance/function2">
                        <div class="row my-5">
                            <h4 class="text-primary">Todays Attendance Overview Graph</h4>
                            <div class="col">
                                <img src="/manual/admin/attendance/attendance today health check graph.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">2.2.1 Attendance Today Health Check Graph</h6>
                            </div>
                            <div class="col">
                                <img src="/manual/admin/attendance/attendance today graph.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">2.2.2 Attendance Today Attendance Graph</h6>
                            </div>
                        </div>
                        <p class="w-75 m-auto text-center"> On the right side of the page, you can see the Today’s attendance overview graph. You can filter the graph by click the data above the graph.</p>
                        <div class="row my-5">
                            <div class="col">
                                <img src="/manual/admin/attendance/attendance today health check graph sort function.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">2.2.3 Filtering of the health check graph using the filter functions </h6>
                            </div>
                            <div class="col">
                                <img src="/manual/admin/attendance/attendance today graph sort function.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">2.2.4 Filtering of the attendance graph using the filter functions </h6>
                            </div>
                        </div>
                    </div>

                    <div id="attendance/function3">
                        <div class="row my-5">
                            <h4 class="text-primary">All time Attendance Overview</h4>
                            <div class="col">
                                <img src="/manual/admin/attendance/attendance overview alltime homepage.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">2.3.1 All Time Attendance Graph</h6>
                            </div>
                            <div class="col">
                                <img src="/manual/admin/attendance/attendance overview health graph.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">2.3.2 All Time Attendance Health Check Graph</h6>
                            </div>
                        </div>
                        <p class="w-75 m-auto text-center"> In this graph, the admin user can easily monitor the all-time attendance and all-time health overview the employee. It has a function filter by clicking the data above the data. User can also filter the date by setting the date that the use wants located in the upper left of the page. Department Attendance Overview, Positions Attendance Overview has also had same function.</p>
                        <div class="row my-5">
                            <div class="col">
                                <img src="/manual/admin/attendance/attendance overview attendance graph sort function.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">2.3.3 Filtering of the All Time Attendance Graph using the filter functions </h6>
                            </div>
                            <div class="col">
                                <img src="/manual/admin/attendance/attendance overview health graph sort function.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">2.3.4 Filtering of the  All Time Attendance Health Check Graph using the filter functions </h6>
                            </div>
                        </div>
                    </div>

                    <div id="attendance/function4">
                        <div class="row my-5">
                            <h4 class="text-primary">Employee Attendance Overview</h4>
                            <div class="col-3">
                                In this table the admin user can easily monitor the attendance of each individual employee. It has also a filter function on the upper left and search bar on upper right.
                            </div>
                            <div class="col">
                                <img src="/manual/admin/attendance/employee attendance overview.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">2.4.1 Employee Attendance Overview Table</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="regularization" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <script>
                    observer.observe(document.querySelector('#regularization'));
                </script>
                <h3 class="alert-light p-4">Regularization Management</h3>
                <div class="px-4 mx-5">
                    <h6 class="text-primary">Description</h6>
                    <p class="w-75">
                        The Regularization Management is the page where admin user can regular their employees. It can also monitor their performance assessment and view employees’ profile for easy to assess them individually.
                        <img src="/manual/admin/regularization management/regularization overview.jpg" class="w-100">
                        <h6 class="text-center w-100 p-3">3.1 Regularization Management Landing page</h6>
                    </p>

                    <h6 class="text-primary">Functions</h6>
                    <p class="w-75" >The functions of the Attendance Overview page are listed below:</p>
                    <ul class="ms-5">
                        <li><a class="ps-3 m-3" href="#regularization/function1">Regularization Button</a></li>
                        <li><a class="ps-3 m-3" href="#regularization/function2">Performance Assessment Graph</a></li>
                    </ul>

                    <div id="regularization/function1">
                        <div class="row my-5">
                            <h4 class="text-primary">Regularization Button</h4>
                            <p class="w-100">By clicking the Regularize “Green Button” on the upper right part of each employee it will direct you to “Confirmation of Regularization” Page.
                            <img src="/manual/admin/regularization management/when you click regularize button.jpg" class="w-100">
                            <h6 class="text-center w-100 p-3">3.1.1 Regularization Button</h6>
                            </p>
                            <div class="col-3">
                                In Confirmation of Regularization the admin user can view the performance assessment of the employee. By clicking the Regularize button the employee will automatically regular on the database.
                            </div>
                            <div class="col">
                                <img src="/manual/admin/regularization management/regularize platform.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">3.1.2 Confirmation of Regularization</h6>
                            </div>
                        </div>
                    </div>

                    <div id="regularization/function2">
                        <div class="row my-5">
                            <h4 class="text-primary">Performance Assessment Graph</h4>
                            <p class="w-75">This is the Employees for regularization list, where in the HR admin will be able to see all of the onboarded employees that should be regularizeThe Admin user can easily view of each assessment graph of the employee.</p>
                            <img src="/manual/admin/regularization management/regularization overview.jpg" class="w-100">
                            <h6 class="text-center w-100 p-3">3.2.1 Regularization Employee List</h6>

                            <div class="p-3"></div>
                            <p class="w-75">It has also a function to cross out the performance assessment of the employee by simply clicking the performance assessment. </p>
                            <img src="/manual/admin/regularization management/can crossout the assessments in the chart.jpg" class="w-100">
                            <h6 class="text-center w-100 p-3">3.2.2 Employee Assessment graph filtering features</h6>

                            <div class="p-3"></div>
                            <p class="w-75">By clicking the profile of the selected employee, it will direct you to the profile of the employee where the admin can see the employees Attendance Overview, Assessment Overview, and their Assessment History.</p>
                            <img src="/manual/admin/regularization management/regularization management sorting functions.jpg" class="w-100">
                            <h6 class="text-center w-100 p-3">3.2.3 Profile Button on Regularization Employees List</h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="assessment" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <script>
                    observer.observe(document.querySelector('#assessment'));
                </script>
                <h3 class="alert-light p-4">Performance Assessment</h3>
                <div class="px-4 mx-5">
                    <h6 class="text-primary">Description</h6>
                    <p class="w-75">
                        The Performance Assessment is the module that provides controls to create annual quarterly assessment for all employees.
                        The HR admin will be able to view all of the previous quarterly assessment as well as see the graphical representation of the Assessment of the employee.
                        This module provides a comprehensive questionnaire to assess the performance of the employee in four different categories which are the Attendance, Performance, Cooperation, and Character.
                        <br>
                        <img src="/manual/admin/performance assessment/performance Assessment home page.jpg" class="w-100">
                        <h6 class="text-center w-100 p-3">4.1 Performance Assessment Landing Page</h6>
                    </p>

                    <h6 class="text-primary">Functions</h6>
                    <p class="w-75" >The functions of the Performance Assessmentpage are listed below:</p>
                    <ul class="ms-5">
                        <li><a class="ps-3 m-3" href="#assessment/function1">Managing Performance Assessment</a></li>
                        <li><a class="ps-3 m-3" href="#assessment/function2">Viewing of Assessments</a></li>
                    </ul>

                    <div id="assessment/function1">
                        <div class="row my-5">
                            <h4 class="text-primary">Managing Performance Assessment</h4>
                            In this feature of the module, the HR admin will be able to create quarterly assessment. Controls in deleting quarterly assessment is also provided in this part of the feature.

                            <div class="p-3"></div>
                            <h5 class="text-primary">A. Creating Performance Assessments</h5>

                            <p>Creating a quarterly performance assessment involves three steps:</p>
                            <div class="p-2"></div>

                            <h6>1. Selecting an Employee</h6>
                            <div class="row">
                                <div class="col">
                                    In order to select an employee that will be assessed, the HR admin will have to use the employees table. Using the search bar, the HR admin will be able to search details of an employee. By clicking the Column names, the records will be ordered alphabetically.
                                    The progress of the employee annual  assessment is shown in the "Assessment Progress" column .
                                    If the HR admin have decided on who will be assessed, they will have to click the "Create Assessment" button.
                                </div>
                                <div class="col">
                                    <img src="/manual/admin/performance assessment/employee selection table.jpg" class="w-100">
                                    <h6 class="text-center w-100 p-3">4.1.1 Employee Selection Table</h6>
                                </div>
                            </div>

                            <h6>2. Selecting the quarter to be assessed</h6>
                            <div class="row">
                                <div class="col">
                                    After selecting an Employee to be assessed, the HR admin will have to select the quarter that will be assessed.
                                    By click the dropdown labeled "Select Date of Assessment" the selection of quarters will show.
                                    In order to select a quarter, the HR admin will have to click the option with white background.
                                    <br><br>
                                    If the option is green, it means that that quarter has been assessed.
                                </div>
                                <div class="col">
                                    <img src="/manual/admin/performance assessment/assessment selcting date and quarter.jpg" class="w-100">
                                    <h6 class="text-center w-100 p-3">4.1.2 Selecting of Quarter to be assessed</h6>
                                </div>
                            </div>

                            <h6>3. Answering the questionnaire</h6>
                            <p class="w-75">
                                After selecting the Quarter that will be assessed, the HR admin will have to answer all of the questions in the questionnaire as well as provide feedback on each of the category.
                                <br><br>
                                To answer the other categories, the HR admin will have to click the tabs.
                                <img src="/manual/admin/performance assessment/tabs.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">4.1.3 Tabs for navigating through the questionnaire</h6>
                            </p>

                            <div class="p-3"></div>
                            <h6 class="text-success">Here are some sample of the questions in the questionnaire.</h6>
                            <div class="row">
                                <div class="col">
                                    <img src="/manual/admin/performance assessment/survey1.jpg" class="w-100">
                                    <h6 class="text-center w-100 p-3">4.1.4 Sample Questions on Attendance part of the questionnaire</h6>
                                </div>
                                <div class="col">
                                    <img src="/manual/admin/performance assessment/survey2.jpg" class="w-100">
                                    <h6 class="text-center w-100 p-3">4.1.5 Sample Questions on Cooperation part of the questionnaire</h6>
                                </div>
                            </div>


                            <div class="p-4"></div>
                            <h5 class="text-primary">B. Deleting a Performance Assessment</h5>
                            <h6>1. Selecting the quarter to be deleted</h6>
                            <div class="row">
                                <div class="col">
                                    To select a Quarterly assessment that will be deleted, the HR admin will have to select the options that are green which means that an assessment is already made on that quarter.
                                </div>
                                <div class="col">
                                    <img src="/manual/admin/performance assessment/assessment selcting date and quarter.jpg" class="w-100">
                                    <h6 class="text-center w-100 p-3">4.1.6 Selecting an Assessed Quarter</h6>
                                </div>
                            </div>
                            <h6>2. Deleting the Assessment</h6>
                            <div class="row">
                                <div class="col">
                                    After selecting an assessment, right below the assessments is the "Delete Assessment" button.
                                    Clicking the button will remove the assessment, which will enable the HR admin to create a new assessment on that quarter.
                                </div>
                                <div class="col">
                                    <img src="/manual/admin/performance assessment/delete.jpg" class="w-100">
                                    <h6 class="text-center w-100 p-3">4.1.7 Delete Assessment button</h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="assessment/function2">
                        <div class="row my-5">
                            <h4 class="text-primary">Viewing of Assessments</h4>
                            <div class="row py-3">
                                <div class="col">
                                    After selecting an employee, below the employee details the user will see the "View Assessment History" button.
                                    The HR admin will have to click this button to see the Assessment History of the employee.
                                </div>
                                <div class="col">
                                    <img src="/manual/admin/performance assessment/selecting assessment history.jpg" class="w-50 m-auto">
                                    <h6 class="text-center w-100 p-3">4.2.1 Employee Selection Table</h6>
                                </div>
                            </div>

                            <div class="row py-3">
                                <div class="col">
                                    After clicking the "View AssessmentHistory" button, the user will be redirected to the Assessment history page.
                                    In here, the HR admin will be able to see all of the assessment of the employee.

                                    <div class="p-2"></div>

                                    The HR admin will be able to use the year filter in order to view the assessment on different years.
                                    Using the quarter tabs. The HR admin will be able to see the
                                </div>
                                <div class="col">
                                    <img src="/manual/admin/performance assessment/assessment history platform.jpg" class="w-100 m-auto">
                                    <h6 class="text-center w-100 p-3">4.2.2 View AssessmentHistory button</h6>
                                </div>
                            </div>

                            <div class="row py-3">
                                <div class="col">
                                    below the assessments will be the graphical representation of the employee assessments.
                                </div>
                                <div class="col">
                                    <img src="/manual/admin/performance assessment/Assessment history graphs.jpg" class="w-100 m-auto">
                                    <h6 class="text-center w-100 p-3">4.2.3 Assessment History Graphs</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="learning" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <script>
                    observer.observe(document.querySelector('#learning'));
                </script>
                <h3 class="alert-light p-4">Learning Modules (Orientation, Training, Correction)</h3>
                <div class="px-4 mx-5">
                    <h6 class="text-primary">Description</h6>
                    <p class="w-75">
                        In the learning modules is where the HR admin will be able to manage the lessons on the module, track the progress of employees, as well as enroll employees into the module.
                        <img src="/manual/admin/orientation module/orientation module home page.jpg" class="w-100">
                        <h6 class="text-center w-100 p-3">5.1 Learning Module (Orientation) Landing Page</h6>
                    </p>

                    <h6 class="text-primary">Functions</h6>
                    <p class="w-75" >The functions of the Learning Modules page are listed below:</p>
                    <ul class="ms-5">
                        <li><a class="ps-3 m-3" href="#learning/function1">Module Management</a></li>
                        <li><a class="ps-3 m-3" href="#learning/function2">Employee Progress</a></li>
                        <li><a class="ps-3 m-3" href="#learning/function3">Enroll Employees</a></li>
                    </ul>

                    <div id="learning/function1">
                        <div class="row my-5">
                            <h4 class="text-primary">Module Management</h4>
                            <p class="w-75">In this part of the learning modules, the HR admin will be able to view all of the lesson of the learning module, reorganize the order of the lesson, edit lesson, as well as remove lessons.</p>
                            <div class="row my-3">
                                <div class="col-3">
                                    This is where the HR admin will be able to view all of the lessons and see all of the controls to manage the lessons.
                                </div>
                                <div class="col">
                                    <img src="/manual/admin/orientation module/video uploaded successfuly.jpg" class="w-100">
                                    <h6 class="text-center w-100 p-3">5.1.1 Lessons Overview</h6>
                                </div>
                            </div>

                            <div class="row my-3">
                                <h5 class="text-primary">A. Adding Lesson</h5>

                                <div class="row">
                                    <div class="col-4">
                                        The HR admin will have to click the "Add Lesson" button.
                                    </div>
                                    <div class="col">
                                        <img src="/manual/admin/orientation module/orientation module if you want to add a lesson.jpg" class="w-100">
                                        <h6 class="text-center w-100 p-3">5.1.2 Add Lesson Button</h6>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-4">
                                        After clicking the "Add Lesson" button, the HR admin will be redirected in to this page where all of the controls in creating and uploading lessons is located.
                                    </div>
                                    <div class="col">
                                        <img src="/manual/admin/orientation module/orientation module where you can upload video and title and description.jpg" class="w-100">
                                        <h6 class="text-center w-100 p-3">5.1.3 Creation of lesson Page</h6>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-4">
                                        The HR admin will have to click the "Choose File" button to upload the video lesson.
                                    </div>
                                    <div class="col">
                                        <img src="/manual/admin/orientation module/upload video.jpg" class="w-100">
                                        <h6 class="text-center w-100 p-3">5.1.4 Uploading of Video</h6>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-4">
                                        After uploading the video and adding all of the lesson details, the HR admin will have to click the submit to save the new lesson.
                                    </div>
                                    <div class="col">
                                        <img src="/manual/admin/orientation module/upload video click submit.jpg" class="w-100">
                                        <h6 class="text-center w-100 p-3">5.1.5 Submit Button</h6>
                                    </div>
                                </div>
                            </div>

                            <div class="row my-3">
                                <h5 class="text-primary">B. Editing Lesson</h5>

                                <div class="row">
                                    <div class="col-4">
                                        The HR admin will have to click the "Edit Lesson" button on their selected lesson to be edited.
                                        They will be redirected to this page which contains all of the controls in order to edit the details of the lesson.
                                    </div>
                                    <div class="col">
                                        <img src="/manual/admin/orientation module/edit module.jpg" class="w-100">
                                        <h6 class="text-center w-100 p-3">5.1.7 Edit Lesson button</h6>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-4">
                                        In order to change the video of the lesson, the HR admin will have to upload the new video by clicking the "Choose File" button and selecting the new video to be used.
                                        To change the details of the lesson, the user admin will have to change the information that is contained in the controls.
                                    </div>
                                    <div class="col">
                                        <img src="/manual/admin/orientation module/details.jpg" class="w-100">
                                        <h6 class="text-center w-100 p-3">5.1.8 Controls for editing the Lesson Details</h6>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-4">
                                        The HR admin will have to click the "Save Changes" button to save the changes the lesson.
                                    </div>
                                    <div class="col">
                                        <img src="/manual/admin/orientation module/save changes.jpg" class="w-100">
                                        <h6 class="text-center w-100 p-3">5.1.9 Save Changes button</h6>
                                    </div>
                                </div>
                            </div>

                            <div class="row my-3">
                                <h5 class="text-primary">C. Removing Lesson</h5>

                                <div class="row">
                                    <div class="col">
                                        To remove a lesson, the HR admin will have to click the "Remove Lesson" button of the selected lesson.
                                    </div>
                                    <div class="col">
                                        <img src="/manual/admin/orientation module/remove lesson.jpg" class="w-100">
                                        <h6 class="text-center w-100 p-3">5.1.10 Remove Lesson Button</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="learning/function2">
                        <div class="row my-5">
                            <h4 class="text-primary">Employee Progress</h4>

                            <div class="row my-3">
                                <div class="col-3">
                                    In this part of the module, The hr admin will be able to see the progress of the employees that are enrolled in the learning modules.
                                </div>
                                <div class="col">
                                    <img src="/manual/admin/orientation module/oreientation employee progress.jpg" class="w-100">
                                    <h6 class="text-center w-100 p-3">5.2.1 Employee Progress View</h6>
                                </div>
                            </div>

                            <div class="row my-3">
                                <div class="col-3">
                                    When the employee have reached the 100% progress in the module, the HR admin will be able to "mark as complete". Once it is marked as completed, it will be in the completed table and the employee will be removed from the enrolled employee on the learning module.
                                </div>
                                <div class="col">
                                    <img src="/manual/admin/orientation module/orientation module employee complete.jpg" class="w-100">
                                    <h6 class="text-center w-100 p-3">5.2.2 Mark as Complete button</h6>
                                </div>
                            </div>

                            <div class="row my-3">
                                <div class="col-3">
                                    This is where all of the records that are marked as completed will be displayed as well as the details of that record.
                                </div>
                                <div class="col">
                                    <img src="/manual/admin/orientation module/orientation module employee completed list.jpg" class="w-100">
                                    <h6 class="text-center w-100 p-3">5.2.3 View of all Finished and Completed</h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="learning/function3">
                        <div class="row my-5">
                            <h4 class="text-primary">Enroll Employees</h4>
                            <div class="m-auto">
                                This part of the learning modules provides controls in order to enroll employees.
                                <img src="/manual/admin/orientation module/enroll employees orientation module.jpg" class="w-75">
                                <h6 class="text-center w-100 p-3">5.3.1 Enrolling of Employees into module</h6>
                            </div>

                            <p class="w-50">Enrolling employees involves 3 steps.</p>

                            <h5 class="text-primary">1. Selecting Employees</h5>
                            <div class="row">
                                <div class="col">
                                    The HR admin will have to select employees to be enrolled using the employees table. The HR admin will be able to use the search bar in order to input details to be searched in the table. The hr admin can also rearrange the columns alphabetically by clicking the column name.
                                    Once the HR admin has decided on the employees to be enrolled, they can then click the respected select button of the employee. In order to deselect a selected employee, the HR admin will have to click the "Selected" button.

                                    <br><br>

                                    To confirm the selection, all of the employees that are currently selected will show the selected word on their row. Their details will also appear on the selected employee table.
                                </div>
                                <div class="col">
                                    <img src="/manual/admin/orientation module/enroll employees select and duration date.jpg" class="w-100">
                                    <h6 class="text-center w-100 p-3">5.3.2 Selecting using Employee Table</h6>
                                </div>
                            </div>

                            <div class="p-2"></div>

                            <h5 class="text-primary">2. Adding the Enrollment Details</h5>
                            <div class="row">
                                <div class="col">
                                    After selecting the employees to be enrolled, the HR admin will add the start date and the end date of their enrollment using the two date picker with their respected label.
                                </div>
                                <div class="col">
                                    <img src="/manual/admin/orientation module/enrollment details.jpg" class="w-100">
                                    <h6 class="text-center w-100 p-3">5.3.3 Enrollment Details</h6>
                                </div>
                            </div>

                            <h5 class="text-primary">3. Clicking Submit</h5>
                            <div class="row">
                                <div class="col">
                                    Once done, the HR admin will need to click the "Submit" button to record the enrollment.
                                </div>
                                <div class="col">
                                    <img src="/manual/admin/orientation module/enrollment details if complete to select the employees.jpg" class="w-100">
                                    <h6 class="text-center w-100 p-3">5.3.4 Submit Button</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="audit" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <script>
                    observer.observe(document.querySelector('#audit'));
                </script>
                <h4 class="alert-light p-4">Audit Logs</h4>
                <div class="px-4 mx-5">
                    <h6 class="text-primary">Description</h6>
                    <p class="w-75">
                        In the Audit Logs Module is where all of the HR admin actions are listed. The HR admin can search through the records using the search bar as well as change the number of records using the entries filter.
                        The table displays all necessary informationsuch as the HR admin name, a brief description of the activity, affected employee name, and activity details.
                        The displayed records can also be generated into a PDF report. All report is stored in the system a can be viewed in this module.
                    </p>
                    <br>
                    <img src="/manual/admin/audit/audit trail homepage for admin.jpg" class="w-100">
                    <h6 class="text-center w-100 p-3">6.1 Audit Logs Landing Page</h6>

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
                            <h6 class="text-center w-100 p-3">6.1.1 Audit Logs Table</h6>
                            In the Audit Logs section is where the "Audit Logs" table is located. This is where the HR admin will be able to see all of the audit records.
                            Above the "Audit Logs" table, the "Generate Audit Summary" button is located

                            <br>
                            <h5 class="text-primart">Generate Audit Summary</h5>
                            <div class="row">
                                <div class="col">
                                    First, click the "Generate Audit Summary" button.
                                </div>
                                <div class="col">
                                    <img src="/manual/staff/audit/2.jpg" class="w-100">
                                    <h6 class="text-center w-100 p-3">6.1.2 Generate Audit Summary button</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    The "Generate Audit Summary" button will change into two buttons which is the "PDF" and cancel button. Once the "PDF" button is clicked, a new tab will show which will generate the audit summary into a PDF format
                                </div>
                                <div class="col">
                                    <img src="/manual/staff/audit/3.jpg" class="w-100">
                                    <h6 class="text-center w-100 p-3">6.1.3 PDF Button</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="audit/function2">
                        <div class="row my-5">
                            <h4 class="text-primary">Audit History</h4>
                            In the "Audit History" is where all of the generated audit summary can be viewed and download. The HR admin will have to select a audit summary file using the buttons with their file name on it.
                            <img src="/manual/staff/audit/4.jpg" class="w-100">
                            <h6 class="text-center w-100 p-3">6.2.1 Audit History</h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="activities" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <script>
                    observer.observe(document.querySelector('#activities'));
                </script>
                <h3 class="alert-light p-4">Employee Activities</h3>
                <div class="px-4 mx-5">
                    <h6 class="text-primary">Description</h6>
                    <p class="w-75">
                        In the Employee Activity module is where the HR admin will be able to view the Employee Activities as well as generate a PDF report.
                        The HR admin will also be able to view all of the generated reports in this module.
                    </p>
                    <br>
                    <img src="/manual/admin/activities/home.jpg" class="w-100">
                    <h6 class="text-center w-100 p-3">7.1 Employee Activities Landing Page</h6>

                    <h6 class="text-primary">Functions</h6>
                    <p class="w-75" >The functions of the Audit Logs page are listed below:</p>
                    <ul class="ms-5">
                        <li><a class="ps-3 m-3" href="#activities/function1">Employee Activity Logs</a></li>
                        <li><a class="ps-3 m-3" href="#activities/function2">Employee Activity History</a></li>
                    </ul>

                    <div id="activities/function1">
                        <div class="row my-5">
                            <h4 class="text-primary">Employee Activity Logs</h4>

                            <div class="w-75">
                                In the Employee Activity Table is where the all of the activities of the employee will be found. The table has features in order to change the view of the table.
                                In order to search details of records, the HR admin will be able to use the search bar that is located on the top right of the table.
                                Clicking the column names will rearrange the rows alphabetically based on the column that is clicked. Using the date filter, the HR admin will be able to select the date period that the records are displayed.
                                <img src="/manual/admin/activities/table.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">7.1.1 Employee Activities Landing Page</h6>
                            </div>

                            <br>
                            <h5 class="text-primart">Generate Activities Summary</h5>
                            <div class="row">
                                <div class="col">
                                    First, click the "Generate Activities Summary" button.
                                </div>
                                <div class="col">
                                    <img src="/manual/admin/activities/report.jpg" class="w-100">
                                    <h6 class="text-center w-100 p-3">7.1.2 Generate Activities Summary button</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    The "Generate Activities Summary" button will change into two buttons which is the "PDF" and cancel button. Once the "PDF" button is clicked, a new tab will show which will generate the audit summary into a PDF format
                                </div>
                                <div class="col">
                                    <img src="/manual/admin/activities/generate.jpg" class="w-100">
                                    <h6 class="text-center w-100 p-3">7.1.3 Generate Activities PDF button</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="activities/function2">
                        <div class="row my-5">
                            <h4 class="text-primary">Employee Activity History</h4>
                            In the "Employee Activity History" is where all of the generated Employee Activity summary can be viewed and download. The HR staff will have to select a Employee Activity summary file using the buttons with their file name on it.
                            <img src="/manual/admin/activities/pdf.jpg" class="w-100">
                            <h6 class="text-center w-100 p-3">7.2.1 Employee Activity History</h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="forms" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <script>
                    observer.observe(document.querySelector('#forms'));
                </script>
                <h3 class="alert-light p-4">Legal Forms</h3>
                <div class="px-4 mx-5">
                    <p class="w-75">The legal forms module is where all of the Legal forms from SSS, Pagibig, Philhealth, and BIR is located and will be readily downloaded. The HR admin will also be able to upload their accomplished forms for recorded keeping.</p>
                    <img src="/manual/admin/legal forms/home page legal forms.png" class="w-100">
                    <h6 class="text-center w-100 p-3">8.1 Legal Forms Landing Page</h6>


                    <h6 class="text-primary">Functions</h6>
                    <p class="w-75" >The functions of the Legal Forms page are listed below:</p>
                    <ul class="ms-5">
                        <li><a class="ps-3 m-3" href="#forms/function1">SSS Forms</a></li>
                        <li><a class="ps-3 m-3" href="#forms/function2">Pagibig Forms</a></li>
                        <li><a class="ps-3 m-3" href="#forms/function3">Philhealth Forms</a></li>
                        <li><a class="ps-3 m-3" href="#forms/function4">BIR Forms</a></li>
                    </ul>

                    <div id="forms/function1">
                        <div class="row my-5">
                            <h4 class="text-primary">SSS Forms</h4>
                            <div class="col">
                                <h5 class="text-primary">Employer SSS Forms</h5>
                                <p>In the Employer SSS Forms, the HR admin will be able to find all of the essential forms quickly and are ready to be downloaded.</p>
                                <img src="/manual/admin/legal forms/home page legal forms.png" class="w-100">
                                <h6 class="text-center w-100 p-3">8.1.1 Employer SSS Forms</h6>
                            </div>
                            <div class="col">
                                <h5 class="text-primary">All SSS Forms</h5>
                                <p>In the All SSS Forms, the HR admin will be able to find and download all of the available forms on the SSS website</p>
                                <img src="/manual/admin/legal forms/all sss forms.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">8.1.2 All SSS Forms</h6>
                            </div>
                            <div class="col">
                                <h5 class="text-primary">Accomplished SSS Forms</h5>
                                <p>In the Accomplished SSS Forms, the HR admin will able to view and upload all of the accomplished SSS forms </p>
                                <img src="/manual/admin/legal forms/uploaded accomplished sss forms.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">8.1.3 Accomplished SSS Forms</h6>
                            </div>
                        </div>
                    </div>

                    <div class="p-3"></div>
                    <div id="forms/function2">
                        <div class="row my-5">
                            <h4 class="text-primary">Pagibig Forms</h4>
                            <div class="col">
                                <h5 class="text-primary">Employer Pagibig Forms</h5>
                                <p>In the Employer Pagibig Forms, the HR admin will be able to find all of the essential forms quickly and are ready to be downloaded.</p>
                                <img src="/manual/admin/legal forms/Pagibig forms employer.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">8.2.1 Employer Pagibig Forms</h6>
                            </div>
                            <div class="col">
                                <h5 class="text-primary">All Pagibig Forms</h5>
                                <p>In the All Pagibig Forms, the HR admin will be able to find and download all of the available forms on the Pagibig website</p>
                                <img src="/manual/admin/legal forms/all Pagibig forms.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">8.2.2 All Pagibig Forms</h6>
                            </div>
                            <div class="col">
                                <h5 class="text-primary">Accomplished Pagibig Forms</h5>
                                <p>In the Accomplished Pagibig Forms, the HR admin will able to view and upload all of the accomplished Pagibig forms </p>
                                <img src="/manual/admin/legal forms/philhealth acconplished forms complete.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">8.2.3 Accomplished Pagibig Forms</h6>
                            </div>
                        </div>
                    </div>

                    <div class="p-3"></div>
                    <div id="forms/function3">
                        <div class="row my-5">
                            <h4 class="text-primary">Philhealth Forms</h4>
                            <div class="col">
                                <h5 class="text-primary">Employer Philhealth Forms</h5>
                                <p>In the Employer Philhealth Forms, the HR admin will be able to find all of the essential forms quickly and are ready to be downloaded.</p>
                                <img src="/manual/admin/legal forms/employer philheatlh forms.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">8.3.1 Employer Philhealth Forms</h6>
                            </div>
                            <div class="col">
                                <h5 class="text-primary">All Philhealth Forms</h5>
                                <p>In the All Philhealth Forms, the HR admin will be able to find and download all of the available forms on the Philhealth website</p>
                                <img src="/manual/admin/legal forms/all philhealth forms.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">8.3.2 All Philhealth Forms</h6>
                            </div>
                            <div class="col">
                                <h5 class="text-primary">Accomplished Philhealth Forms</h5>
                                <p>In the Accomplished Philhealth Forms, the HR admin will able to view and upload all of the accomplished Philhealth forms </p>
                                <img src="/manual/admin/legal forms/accomplished philhealth forms.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">8.3.3 Accomplished Philhealth Forms</h6>
                            </div>
                        </div>
                    </div>

                    <div class="p-3"></div>
                    <div id="forms/function4">
                        <div class="row my-5">
                            <h4 class="text-primary">BIR Forms</h4>
                            <div class="col">
                                <h5 class="text-primary">Employer BIR Forms</h5>
                                <p>In the Employer BIR Forms, the HR admin will be able to find all of the essential forms quickly and are ready to be downloaded.</p>
                                <img src="/manual/admin/legal forms/BIR forms employer.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">8.4.1 Employer BIR Forms</h6>
                            </div>
                            <div class="col">
                                <h5 class="text-primary">All BIR Forms</h5>
                                <p>In the All BIR Forms, the HR admin will be able to find and download all of the available forms on the BIR website</p>
                                <img src="/manual/admin/legal forms/all bir forms.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">8.4.2 All BIR Forms</h6>
                            </div>
                            <div class="col">
                                <h5 class="text-primary">Accomplished BIR Forms</h5>
                                <p>In the Accomplished BIR Forms, the HR admin will able to view and upload all of the accomplished BIR forms </p>
                                <img src="/manual/admin/legal forms/BIR forms accomplished.jpg" class="w-100">
                                <h6 class="text-center w-100 p-3">8.4.3 Accomplished BIR Forms</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @php ($manual_variable_number = 9)
            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="employeelist" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <script>
                    observer.observe(document.querySelector('#employeelist'));
                </script>
                @include('inc.common_manual.employee_list')
            </div>

            @php ($manual_variable_number += 1)
            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="profile" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <script>
                    observer.observe(document.querySelector('#profile'));
                </script>
                @include('inc.common_manual.profile')
            </div>

            @php ($manual_variable_number += 1)
            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="messages" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <script>
                    observer.observe(document.querySelector('#messages'));
                </script>
                @include('inc.common_manual.messages')
            </div>

            @php ($manual_variable_number += 1)
            <div class="row p-5"></div><div class="row p-5"></div>
            <div id="notifications" class="p-0 m-0" style="font-size: 17px; word-spacing: 6px;">
                <script>
                    observer.observe(document.querySelector('#notifications'));
                </script>
                @include('inc.common_manual.notifications')
            </div>
        </div>
    </div>
</div>
@endsection
