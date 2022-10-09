
<header id="header" name="hidden_name" style="z-index: 9999">
    <div class="d-flex flex-column p-0">
        <nav id="navbar" class="nav-menu navbar p-0">
            <ul>
                <li><a onclick="show_loader()" href="/payroll/home"  class="nav-link py-3 w-100" title="Home" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bx bx-home"></i></a></li>
                <li><a onclick="show_loader()" href="/payroll/salary"  class="nav-link py-3" title="Salary Management" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-person-lines-fill"></i></a></li>
                <li><a onclick="show_loader()" href="/payroll/deduction" class="nav-link py-3" title="Employee Deduction" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-calculator"></i></a></li>
                <li><a onclick="show_loader()" href="/payroll/overtime" class="nav-link py-3" title="Overtime Management" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-clock"></i></a></li>
                <li><a onclick="show_loader()" href="/payroll/cashadvance" class="nav-link py-3" title="Cash Advance" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-cash-stack"></i></a></li>
                <li><a onclick="show_loader()" href="/payroll/contributions" class="nav-link py-3" title="Employee Contributions" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-wallet"></i></a></li>
                <li><a onclick="show_loader()" href="/payroll/bonus" class="nav-link py-3" title="Bonus" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-coin"></i></a></li>
                <li><a onclick="show_loader()" href="/payroll/doublepay" class="nav-link py-3" title="Double Pay" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-check-all"></i></a></li>
                <li><a onclick="show_loader()" href="/payroll/holidays" class="nav-link py-3" title="Holidays" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-calendar-event"></i></a></li>
                <li><a onclick="show_loader()" href="/payroll/leave" class="nav-link py-3" title="Leave" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-person-dash"></i></a></li>
                <li><a onclick="show_loader()" href="/payroll/audittrail" class="nav-link py-3" title="Audit Trail" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-list-check"></i></a></li>
                <li><a onclick="show_loader()" href="/payroll/approval" class="nav-link py-3" title="Approval" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-file-earmark-check"></i></a></li>
                <li><a onclick="show_loader()" href="/employees/list" class="nav-link py-3" title="Employees List" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-people-fill"></i></a></li>
                <li><a onclick="show_loader()" href="/profile" class="nav-link py-3" title="Profile" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-person-circle"></i></span></a></li>
                <li><a onclick="show_loader()" href="/message" class="nav-link py-3" title="Messages" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-chat-left-text"></i> <span id='badge' style="font-size: 9px"></span></a></li>
                <li><a onclick="show_loader()" href="/notification" class="nav-link" title="Notifications" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-bell"></i></a></li>
                <li><a onclick="show_loader()" href="/payroll/manual" class="nav-link" title="User Manual" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-info-circle"></i></a></li>
            </ul>
        </nav><!-- .nav-menu -->
    </div>
</header>
<!-- End Header -->

<header id="header" name="show_name" class="d-none" style="z-index: 9999;width:250px">
    <div class="d-flex flex-column p-0">
        <nav id="navbar" class="nav-menu navbar p-0">
        <ul class="w-100">
            <li><a onclick="show_loader()" href="/payroll/home"  class="nav-link py-3" title="Home" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bx bx-home pe-4"></i>Home</a></li>
            <li><a onclick="show_loader()" href="/payroll/salary"  class="nav-link py-3" title="Employee List" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-person-lines-fill pe-4"></i>Salary Management</a></li>
            <li><a onclick="show_loader()" href="/payroll/deduction" class="nav-link py-3" title="Employee Deduction" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-calculator pe-4"></i>Deductions</a></li>
            <li><a onclick="show_loader()" href="/payroll/overtime" class="nav-link py-3" title="Overtime Management" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-clock pe-4"></i>Overtime</a></li>
            <li><a onclick="show_loader()" href="/payroll/cashadvance" class="nav-link py-3" title="Cash Advance" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-cash-stack pe-4"></i>Cash Advance</a></li>
            <li><a onclick="show_loader()" href="/payroll/contributions" class="nav-link py-3" title="Employee Contributions" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-wallet pe-4"></i>Contribution</a></li>
            <li><a onclick="show_loader()" href="/payroll/bonus" class="nav-link py-3" title="Bonus" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-coin pe-4"></i>Employee Bonus</a></li>
            <li><a onclick="show_loader()" href="/payroll/doublepay" class="nav-link py-3" title="Double Pay" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-check-all pe-4"></i>Multi pay</a></li>
            <li><a onclick="show_loader()" href="/payroll/holidays" class="nav-link py-3" title="Holidays" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-calendar-event pe-4"></i>Holiday</a></li>
            <li><a onclick="show_loader()" href="/payroll/leave" class="nav-link py-3" title="Leave" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-person-dash pe-4"></i>Leave</a></li>
            <li><a onclick="show_loader()" href="/payroll/audittrail" class="nav-link py-3" title="Audit Trail" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-list-check pe-4"></i>Audit Logs</a></li>
            <li><a onclick="show_loader()" href="/payroll/approval" class="nav-link py-3" title="Approval" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-file-earmark-check pe-4"></i>Approvals</a></li>
            <li><a onclick="show_loader()" href="/employees/list" class="nav-link py-3" title="Employees list" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-people-fill pe-4"></i>Employees List</a></li>
            <li><a onclick="show_loader()" href="/profile" class="nav-link py-3" title="Profile" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-person-circle pe-4"></i>Profile</a></li>
            <li><a onclick="show_loader()" href="/message" class="nav-link py-3" title="Messages" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-chat-left-text pe-4"></i>Messages <span id='extended_badge' style="font-size: 9px"></span></a></li>
            <li><a onclick="show_loader()" href="/notification" class="nav-link" title="Notifications" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-bell pe-4"></i>Notification</a></li>
            <li><a onclick="show_loader()" href="/payroll/manual" class="nav-link" title="User Manual" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-info-circle pe-4"></i>User Manual</a></li>

        </ul>
        </nav><!-- .nav-menu -->
    </div>
</header>

<button class="btn btn-oultine-dark border-0 btn-lg py-2" onclick="toggleHamburger()">
    <i class="bi bi-list h1"></i>
</button>
<div class="d-none d-xl-none p-4" id="hamburger" style="background-color: rgba(0, 0, 0, 0.585); position: absolute; z-index:9998;">
        <a onclick="show_loader()" href="/payroll/home"  class="btn btn-outline-light w-100 btn-lg p-3" title="Home" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bx bx-home pe-4"></i>Home</a></button>
        <a onclick="show_loader()" href="/payroll/salary"  class="btn btn-outline-light w-100 btn-lg p-3" title="Employee List" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-person-lines-fill pe-4"></i>Salary Management</a></button>
        <a onclick="show_loader()" href="/payroll/deduction" class="btn btn-outline-light w-100 btn-lg p-3" title="Employee Deduction" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-calculator pe-4"></i>Deductions</a></button>
        <a onclick="show_loader()" href="/payroll/overtime" class="btn btn-outline-light w-100 btn-lg p-3" title="Overtime Management" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-clock pe-4"></i>Overtime</a></button>
        <a onclick="show_loader()" href="/payroll/cashadvance" class="btn btn-outline-light w-100 btn-lg p-3" title="Cash Advance" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-cash-stack pe-4"></i>Cash Advance</a></button>
        <a onclick="show_loader()" href="/payroll/contributions" class="btn btn-outline-light w-100 btn-lg p-3" title="Employee Contributions" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-wallet pe-4"></i>Contribution</a></button>
        <a onclick="show_loader()" href="/payroll/bonus" class="btn btn-outline-light w-100 btn-lg p-3" title="Bonus" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-coin pe-4"></i>Employee Bonus</a></button>
        <a onclick="show_loader()" href="/payroll/doublepay" class="btn btn-outline-light w-100 btn-lg p-3" title="Double Pay" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-check-all pe-4"></i>Multi pay</a></button>
        <a onclick="show_loader()" href="/payroll/holidays" class="btn btn-outline-light w-100 btn-lg p-3" title="Holidays" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-calendar-event pe-4"></i>Holiday</a></button>
        <a onclick="show_loader()" href="/payroll/leave" class="btn btn-outline-light w-100 btn-lg p-3" title="Leave" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-person-dash pe-4"></i>Leave</a></button>
        <a onclick="show_loader()" href="/payroll/audittrail" class="btn btn-outline-light w-100 btn-lg p-3" title="Audit Trail" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-list-check pe-4"></i>Audit Logs</a></button>
        <a onclick="show_loader()" href="/payroll/approval" class="btn btn-outline-light w-100 btn-lg p-3" title="Approval" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-file-earmark-check pe-4"></i>Approvals</a></button>
        <a onclick="show_loader()" href="/employees/list" class="btn btn-outline-light w-100 btn-lg p-3" title="Employees list" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-people-fill pe-4"></i>Employees List</a></button>
        <a onclick="show_loader()" href="/profile" class="btn btn-outline-light w-100 btn-lg p-3" title="Profile" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-person-circle pe-4"></i>Profile</a></button>
        <a onclick="show_loader()" href="/message" class="btn btn-outline-light w-100 btn-lg p-3" title="Messages" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-chat-left-text pe-4"></i>Messages <span id='extended_badge' style="font-size: 9px"></span></a></button>
        <a onclick="show_loader()" href="/notification" class="btn btn-outline-light w-100 btn-lg p-3" title="Notifications" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-bell pe-4"></i>Notification</a></button>
        <a onclick="show_loader()" href="/payroll/manual" class="btn btn-outline-light w-100 btn-lg p-3" title="User Manual" data-bs-toggle="tooltip" data-bs-placement="right"><i class="bi bi-info-circle pe-4"></i>User Manual</a></button>
</div>

<script>
     function show_loader(){
        var loader = document.getElementById('loader')
        loader.classList.remove('d-none')
    }

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

        function load_chat_count(){
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
        load_chat_count()

        setInterval(function(){
            load_chat_count()
        }, 3000);
    });
</script>

