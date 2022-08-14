<!-- ======= Header ======= -->

<header id="header" name="hidden_name" style="z-index: 9999">
    <div class="d-flex flex-column">
        <nav id="navbar" class="nav-menu navbar">
            <ul>
                <li><a href="/admin/home"  class="nav-link py-3" title="Home" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-house-door-fill"></i></a></li>
                <li><a href="/admin/attendance" class="nav-link py-3" title="Attendance" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-calendar-check"></i></a></li>
                <li><a href="/admin/regulazation" class="nav-link py-3" title="Regularization" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-caret-up-square-fill"></i></a></li>
                <li><a href="/admin/performance" class="nav-link py-3 pb-4" title="Performance" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-bar-chart-line-fill"></i></a></li>
                <li><a href="/admin/orientation/module" class="nav-link py-3 pb-4" title="Performance" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-journal-bookmark"></i></a></li>
                <li><a href="/admin/training/module" class="nav-link py-3 pb-4" title="Performance" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-briefcase-fill"></i></a></li>
                <li><a href="/admin/correction/module" class="nav-link py-3 pb-4" title="Performance" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-wrench"></i></a></li>
                <li><a href="/admin/audittrail" class="nav-link py-3 pb-4" title="Performance" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-list-check"></i></a></li>
                <li><a href="/message" class="nav-link py-3 pt-1" title="Messages" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-chat-left-text"></i> <span id='badge' style="font-size: 9px"></span></a></li>
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
                <li><a href="/admin/home"  class="nav-link py-3" title="Home" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-house-door-fill pe-4"></i> Home</a></li>
                <li><a href="/admin/attendance" class="nav-link py-3" title="Attendance" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-calendar-check pe-4"></i> Attendance Overview</a></li>
                <li><a href="/admin/regularization" class="nav-link py-3" title="regularization" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-caret-up-square-fill pe-4"></i> Regularization</a></li>

                <li><a href="/admin/performance" class="nav-link py-3 pb-4" title="Performance" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-bar-chart-line-fill pe-4"></i> Performance Assessment</a></li>
                <li><a href="/admin/orientation/module" class="nav-link py-3 pb-4" title="Performance" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-journal-bookmark pe-4"></i> Orientation Module</a></li>
                <li><a href="/admin/training/module" class="nav-link py-3 pb-4" title="Performance" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-briefcase-fill pe-4"></i> Training Module</a></li>
                <li><a href="/admin/correction/module" class="nav-link py-3 pb-4" title="Performance" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-wrench pe-4"></i> Correction Module</a></li>
                <li><a href="/admin/audittrail" class="nav-link py-3 pb-4" title="Performance" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-list-check pe-4"></i> Audit Logs</a></li>

                <li><a href="/message" class="nav-link py-3 pt-1" title="Messages" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-chat-left-text pe-4"></i> Messages <span id='extended_badge' style="font-size: 9px"></span></a></li>
                <li><a href="/notification" class="nav-link py-3" title="Notifications" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-bell pe-4"></i> Notifications</a></li>

            </ul>
        </nav><!-- .nav-menu -->
    </div>
</header>

<script>
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
            myInterval = setInterval(function(){
                load_chat()
            }, 5000);
    });
</script>

