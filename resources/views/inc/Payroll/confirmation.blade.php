<div class="shadow-lg ps-3 py-1 my-5">
    <h4 class="w-100 text-center display-4 pt-3">Payroll Progress Confirmation</h4>
    <p class="w-100 text-center h6 pb-3">Confirmation of Payroll processes before proceeding to Report Generation</p>
    <div class="progress me-3">
        <div class="progress-bar" role="progressbar" style="width:{!!session()->get('progress')!!}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{!!session()->get('progress')!!}%</div>
    </div>

    <div class="row my-3 px-3">
        <div class="col">
            <h4 class="text-primary w-100">Employee Salary Rate</h4>
            <div class="row">
                <div class="col p-0">
                    @if (str_contains(session()->get('progress_btn'),'1'))
                        <button disabled class="btn btn-outline-primary w-100 p-3">Confirm</button>
                    @else
                        <a href="/payroll/progress/1" class="btn btn-outline-primary w-100 p-3">Confirm</a>
                    @endif

                </div>
                <div class="col-3 p-0 pe-3">
                    <a href="/payroll/employeelist" class="btn btn-primary w-100 p-3"><i class="bi bi-caret-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col">
            <h4 class="text-dark">Employee Deductions</h4>
            <div class="row">
                <div class="col p-0">
                    @if (str_contains(session()->get('progress_btn'),'2'))
                        <button disabled class="btn btn-outline-dark w-100 p-3">Confirm</button>
                    @else
                        <a href="/payroll/progress/2" class="btn btn-outline-dark w-100 p-3">Confirm</a>
                    @endif
                </div>
                <div class="col-3 p-0 pe-3">
                    <a href="/payroll/deduction" class="btn btn-dark w-100 p-3"><i class="bi bi-caret-right"></i></a>
                </div>
            </div>
        </div>

        <div class="col">
            <h4 class="text-success ">Overtime Payments</h4>
            <div class="row">
                <div class="col p-0">
                    @if (str_contains(session()->get('progress_btn'),'3'))
                        <button disabled class="btn btn-outline-success w-100 p-3">Confirm</button>
                    @else
                        <a href="/payroll/progress/3" class="btn btn-outline-success w-100 p-3">Confirm</a>
                    @endif
                </div>
                <div class="col-3 p-0 pe-3">
                    <a href="/payroll/overtime" class="btn btn-success w-100 p-3"><i class="bi bi-caret-right"></i></a>
                </div>
            </div>
        </div>

        <div class="col">
            <h4 class="text-info">Cash Advance</h4>
            <div class="row">
                <div class="col p-0">
                    @if (str_contains(session()->get('progress_btn'),'4'))
                        <button disabled class="btn btn-outline-info w-100 p-3">Confirm</button>
                    @else
                        <a href="/payroll/progress/4" class="btn btn-outline-info w-100 p-3">Confirm</a>
                    @endif
                </div>
                <div class="col-3 p-0 pe-3">
                    <a href="/payroll/cashadvance" class="btn btn-info w-100 p-3"><i class="bi bi-caret-right"></i></a>
                </div>
            </div>
        </div>

        <div class="col">
            <h4 class="text-secondary">Contributions</h4>
            <div class="row">
                <div class="col p-0">
                    @if (str_contains(session()->get('progress_btn'),'5'))
                        <button disabled class="btn btn-outline-secondary w-100 p-3">Confirm</button>
                    @else
                        <a href="/payroll/progress/5" class="btn btn-outline-secondary w-100 p-3">Confirm</a>
                    @endif
                </div>
                <div class="col-3 p-0 pe-3">
                    <a href="/payroll/contributions" class="btn btn-secondary w-100 p-3"><i class="bi bi-caret-right"></i></a>
                </div>
            </div>
        </div>

        <div class="col">
            <h4 class="text-warning">Employee Bonus</h4>
            <div class="row">
                <div class="col p-0">
                    @if (str_contains(session()->get('progress_btn'),'6'))
                        <button disabled class="btn btn-outline-warning w-100 p-3">Confirm</button>
                    @else
                        <a href="/payroll/progress/6" class="btn btn-outline-warning w-100 p-3">Confirm</a>
                    @endif
                </div>
                <div class="col-3 p-0 pe-3">
                    <a href="/payroll/bonus" class="btn btn-warning w-100 p-3"><i class="bi bi-caret-right"></i></a>
                </div>
            </div>
        </div>

        <div class="col">
            <h4 class="text-danger">Double/Triple Pay</h4>
            <div class="row">
                <div class="col p-0">
                    @if (str_contains(session()->get('progress_btn'),'7'))
                        <button disabled class="btn btn-outline-danger w-100 p-3">Confirm</button>
                    @else
                        <a href="/payroll/progress/7" class="btn btn-outline-danger w-100 p-3">Confirm</a>
                    @endif
                </div>
                <div class="col-3 p-0 pe-3">
                    <a href="/payroll/doublepay" class="btn btn-danger w-100 p-3"><i class="bi bi-caret-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
