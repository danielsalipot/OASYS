<!-- ======= Header ======= -->
<header id="header" name="hidden_name" style="z-index: 9999">
    <div class="d-flex flex-column p-0">
        <nav id="navbar" class="nav-menu navbar p-0">
        <ul>
            <li><a href="/staff/home" class="nav-link py-3 pt-0" title="Home" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-house-door-fill"></i></a></li>
            <li><a href="/staff/onboarding"  class="nav-link py-3" title="Onboarding" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-person-check-fill"></i></a></li>
            <li><a href="/staff/termination" class="nav-link py-3" title="Termination/Resignation" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-dash-circle-fill"></i></a></li>
            <li><a href="/staff/offboarding" class="nav-link py-3" title="Offboarding" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-person-x-fill"></i></a></li>
            <li><a href="/staff/schedules" class="nav-link py-3" title="Schedules" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-calendar2-week"></i></a></li>
            <li><a href="/staff/interview" class="nav-link py-3" title="Interviews" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-file-earmark-person-fill"></i></a></li>
            <li><a href="/staff/department" class="nav-link py-3" title="Departments" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-building"></i></a></li>
            <li><a href="/staff/position" class="nav-link py-3" title="Positions" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-person-workspace"></i></a></li>
            <li><a href="/staff/audittrail" class="nav-link py-3" title="Performance" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-list-check"></i></a></li>
            <li><a href="/employees/list" class="nav-link py-3" title="Employees List" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-people-fill"></i></a></li>
            <li><a href="/profile" class="nav-link py-3" title="Profile" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-person-circle"></i></span></a></li>
            <li><a href="/message" class="nav-link py-3" title="Messages" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-chat-left-text"></i> <span id='badge' style="font-size: 9px"></span></a></li>
            <li><a href="/notification" class="nav-link py-3"   title="Notifications" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-bell"></i></a></li>
        </ul>
        </nav><!-- .nav-menu -->
    </div>
</header>
<!-- End Header -->

<header id="header" name="show_name" class="d-none" style="z-index: 9999;width:250px">
    <div class="d-flex flex-column p-0">
        <nav id="navbar" class="nav-menu navbar p-0">
        <ul>
            <li><a href="/staff/home" class="nav-link py-3 pt-0" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-house-door-fill pe-4"></i>Home</a></li>
            <li><a href="/staff/onboarding"  class="nav-link py-3" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-person-check-fill  pe-4"></i> Onboarding Management</a></li>
            <li><a href="/staff/termination" class="nav-link py-3" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-dash-circle-fill  pe-4"></i> Offboarding Management</a></li>
            <li><a href="/staff/offboarding" class="nav-link py-3" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-person-x-fill  pe-4"></i>Offboardee Management</a></li>
            <li><a href="/staff/schedules" class="nav-link py-3" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-calendar2-week  pe-4"></i>Schedule Management</a></li>
            <li><a href="/staff/interview" class="nav-link py-3" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-file-earmark-person-fill  pe-4"></i> Interview Management</a></li>
            <li><a href="/staff/department" class="nav-link py-3"  data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-building  pe-4"></i>Department Management</a></li>
            <li><a href="/staff/position" class="nav-link py-3" title="Positions" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-person-workspace  pe-4"></i>Position Management</a></li>
            <li><a href="/staff/audittrail" class="nav-link py-3" title="Performance" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-list-check pe-4"></i> Audit Logs</a></li>
            <li><a href="/employees/list" class="nav-link py-3" title="Employees list" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-people-fill pe-4"></i>Employees List</a></li>
            <li><a href="/profile" class="nav-link py-3" title="Profile" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-person-circle pe-4"></i>Profile</a></li>
            <li><a href="/message" class="nav-link py-3" title="Messages" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-chat-left-text  pe-4"></i>Messages <span id='extended_badge' style="font-size: 9px"></span></a></li>
            <li><a href="/notification" class="nav-link py-3" title="Notifications" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-bell  pe-4"></i>Notification</a></li>
        </ul>
        </nav><!-- .nav-menu -->
    </div>
</header>


<button class="btn btn-oultine-dark border-0 btn-lg py-2" onclick="toggleHamburger()">
    <i class="bi bi-list h1"></i>
</button>
<div class="d-none d-xl-none p-4" id="hamburger" style="background-color: rgba(0, 0, 0, 0.585); position: absolute; z-index:9998;">
    <li><a href="/staff/home" class="btn btn-outline-light w-100 btn-lg p-3" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-house-door-fill pe-4"></i>Home</a></li>
    <li><a href="/staff/onboarding"  class="btn btn-outline-light w-100 btn-lg p-3" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-person-check-fill  pe-4"></i> Onboarding Management</a></li>
    <li><a href="/staff/termination" class="btn btn-outline-light w-100 btn-lg p-3" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-dash-circle-fill  pe-4"></i> Offboarding Management</a></li>
    <li><a href="/staff/offboarding" class="btn btn-outline-light w-100 btn-lg p-3" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-person-x-fill  pe-4"></i>Offboardee Management</a></li>
    <li><a href="/staff/schedules" class="btn btn-outline-light w-100 btn-lg p-3" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-calendar2-week  pe-4"></i>Schedule Management</a></li>
    <li><a href="/staff/interview" class="btn btn-outline-light w-100 btn-lg p-3" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-file-earmark-person-fill  pe-4"></i> Interview Management</a></li>
    <li><a href="/staff/department" class="btn btn-outline-light w-100 btn-lg p-3"  data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-building  pe-4"></i>Department Management</a></li>
    <li><a href="/staff/position" class="btn btn-outline-light w-100 btn-lg p-3" title="Positions" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-person-workspace  pe-4"></i>Position Management</a></li>
    <li><a href="/staff/audittrail" class="btn btn-outline-light w-100 btn-lg p-3" title="Performance" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-list-check pe-4"></i> Audit Logs</a></li>
    <li><a href="/employees/list" class="btn btn-outline-light w-100 btn-lg p-3" title="Employees list" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-people-fill pe-4"></i>Employees List</a></li>
    <li><a href="/profile" class="btn btn-outline-light w-100 btn-lg p-3" title="Profile" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-person-circle pe-4"></i>Profile</a></li>
    <li><a href="/message" class="btn btn-outline-light w-100 btn-lg p-3" title="Messages" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-chat-left-text  pe-4"></i>Messages <span id='extended_badge' style="font-size: 9px"></span></a></li>
    <li><a href="/notification" class="btn btn-outline-light w-100 btn-lg p-3" title="Notifications" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-bell  pe-4"></i>Notification</a></li>
</div>

<script>
    function toggleHamburger(){
        $('#hamburger').toggleClass('d-none')
    }

    $(document).ready(function(){

        $("[name='hidden_name']").hover(
            function (){

                $("[name='hidden_name']").toggleClass('d-none')
                $("[name='show_name']").toggleClass('d-none')
            },
            function (){
                $("[name='hidden_name']").toggleClass('d-none')
                $("[name='show_name']").toggleClass('d-none')
            }
        )

        $("[name='show_name']").hover(
            function (){

                $("[name='hidden_name']").toggleClass('d-none')
                $("[name='show_name']").toggleClass('d-none')
            },
            function (){
                $("[name='hidden_name']").toggleClass('d-none')
                $("[name='show_name']").toggleClass('d-none')
            }
        )

        function load_chat(){
                $.ajax({
                url: `/fetchNavBarMessageCount`,
                type: 'get',
                success: function(response){
                    var badge = document.getElementById('badge')
                    var extended_badge = document.getElementById('extended_badge')

                    if(parseInt(response)){
                        var badgeClass = 'badge badge-pill bg-danger p-2 ms-3 rounded'
                        badge.innerHTML = response
                        extended_badge.innerHTML = response

                        badge.className = badgeClass
                        extended_badge.className = badgeClass
                    }else{
                        var badgeClass = 'badge badge-pill bg-danger p-2 ms-1 rounded d-none'
                        badge.className = badgeClass
                        extended_badge.className = badgeClass
                    }
                }
            });
            }
            load_chat()
            setInterval(function(){
                load_chat()
            }, 3000);
    });
</script>
