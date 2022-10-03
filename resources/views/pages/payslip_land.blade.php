
<html>
    <style>
        body{
            background-color: #f1f1e7;
        }
    </style>
    @include('inc.datatables')
    @include('inc.navIncludes')
    <h1 class="text-primary w-100 text-center">OASYS</h1>
    <h4 class="text-secondary w-100 text-center">Preparing Employee Payslips . . . </h4>
    <div class="bg-white text-center w-100 h-100" id="loader" style="position: fixed; top:0; left:0; z-index:9998">
        <img src="https://cdn.dribbble.com/users/891352/screenshots/4176504/spreadsheet_loader.gif" style="margin-top:7vw;" height="450px" width="500px">
    </div>

    <form action="/payslipPdf" id="myForm" method="POST">
        {!! Form::hidden('ps_col1', session('payslip_request_col1_flash')) !!}
        {!! Form::hidden('ps_col2', session('payslip_request_col2_flash')) !!}
        {!! Form::hidden('employees_temp', session('payslip_employee_temp_flash'))!!}
    </form>
    <script>
        document.getElementById("myForm").submit();
    </script>
</html>
