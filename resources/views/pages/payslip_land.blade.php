
<html>
    <form action="/payslipPdf" id="myForm" method="POST">
        {!! Form::hidden('ps_col1', session('payslip_request_col1_flash')) !!}
        {!! Form::hidden('ps_col2', session('payslip_request_col2_flash')) !!}
        {!! Form::hidden('employees_temp', session('payslip_employee_temp_flash'))!!}
    </form>
    <script>
        document.getElementById("myForm").submit();
    </script>
</html>
