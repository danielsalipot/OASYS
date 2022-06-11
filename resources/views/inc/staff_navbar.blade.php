<!-- ======= Header ======= -->
<header id="header" name="hidden_name" style="z-index: 9999">
    <div class="d-flex flex-column">
        <nav id="navbar" class="nav-menu navbar">
        <ul>
            <li><a href="/staff/home" class="nav-link py-3 pt-0" title="Home" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-house-door-fill"></i></a></li>
            <li><a href="/staff/onboarding"  class="nav-link py-3" title="Onboarding" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-person-check-fill"></i></a></li>
            <li><a href="/staff/termination" class="nav-link py-3" title="Termination/Resignation" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-dash-circle-fill"></i></a></li>
            <li><a href="/staff/offboarding" class="nav-link py-3" title="Offboarding" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-person-x-fill"></i></a></li>
            <li><a href="/staff/schedules" class="nav-link py-3" title="Schedules" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-calendar2-week"></i></a></li>
            <li><a href="/staff/interview" class="nav-link py-3" title="Interviews" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-file-earmark-person-fill"></i></a></li>
            <li><a href="/staff/department" class="nav-link py-3" title="Departments" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-building"></i></a></li>
            <li><a href="/staff/position" class="nav-link py-3" title="Positions" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-person-workspace"></i></a></li>
            <li><a href="/message" class="nav-link py-3" title="Messages" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-chat-left-text"></i></a></li>
            <li><a href="/notification" class="nav-link py-3" title="Notifications" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-bell"></i></a></li>
        </ul>
        </nav><!-- .nav-menu -->
    </div>
</header>
<!-- End Header -->

<header id="header" name="show_name" class="d-none" style="z-index: 9999;width:250px">
    <div class="d-flex flex-column" >
        <nav id="navbar" class="nav-menu navbar">
        <ul>
            <li><a href="/staff/home" class="nav-link py-3 pt-0" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-house-door-fill pe-4"></i>Home</a></li>
            <li><a href="/staff/onboarding"  class="nav-link py-3" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-person-check-fill  pe-4"></i> Onboarding Management</a></li>
            <li><a href="/staff/termination" class="nav-link py-3" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-dash-circle-fill  pe-4"></i> Offboarding Management</a></li>
            <li><a href="/staff/offboarding" class="nav-link py-3" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-person-x-fill  pe-4"></i>Offboardee Management</a></li>
            <li><a href="/staff/schedules" class="nav-link py-3" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-calendar2-week  pe-4"></i>Schedule Management</a></li>
            <li><a href="/staff/interview" class="nav-link py-3" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-file-earmark-person-fill  pe-4"></i> Interview Management</a></li>
            <li><a href="/staff/department" class="nav-link py-3"  data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-building  pe-4"></i>Department Management</a></li>
            <li><a href="/staff/position" class="nav-link py-3" title="Positions" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-person-workspace  pe-4"></i>Position Management</a></li>
            <li><a href="/message" class="nav-link py-3" title="Messages" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-chat-left-text  pe-4"></i>Messages</a></li>
            <li><a href="/notification" class="nav-link py-3" title="Notifications" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-bell  pe-4"></i>Notification</a></li>
        </ul>
        </nav><!-- .nav-menu -->
    </div>
</header>

<script>
    $(document).ready(function(){

        $("[name='hidden_name']").hover(
            function (){
                console.log('hover')
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
                console.log('hover')
                $("[name='hidden_name']").toggleClass('d-none')
                $("[name='show_name']").toggleClass('d-none')
            },
            function (){
                $("[name='hidden_name']").toggleClass('d-none')
                $("[name='show_name']").toggleClass('d-none')
            }
        )
    });
</script>
