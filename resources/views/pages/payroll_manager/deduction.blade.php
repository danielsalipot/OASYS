@extends('layout.payroll_app')
    @section('content')
    <div class="row mt-4">
        <div class="col-1" style="width:6vw"></div>
        <div class="col">
            <div class="container p-2">
                <h1 class="display-2 pb-5 pt-5">Deduction Management</h1>
                <table class="table table-striped text-center table-dark" id="deduction_table">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Employee Details</th>
                            <th scope="col">Deduction Name</th>
                            <th scope="col">Deduction Date</th>
                            <th scope="col">Deduction Amount</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#deduction_table').DataTable({
                ajax: {
                        url: '/deductionjson',
                        dataSrc: ''
                    },
                columns: [
                    { data: 'fname',
                        render : (data,type,row)=>{
                            return `<b>${row.fname} ${row.mname} ${row.lname}</b><br>
                                        ${row.department}<br>
                                        ${row.position}`
                        }
                    },
                    { data: 'deduction_name',
                        render : (data,type,row)=>{
                            return `<b>${data}</b>`
                        }
                    },
                    { data: 'deduction_date',
                        render : (data,type,row)=>{
                            return `<b>${data}</b>`
                        }
                    },
                    { data: 'deduction_amount',
                        render : (data,type,row)=>{
                            return `<b>₱${data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}</b>`
                        }
                    },
                ]
            })
        })
    </script>
@endsection










{{--

            <div class="col-5 border rounded me-4">
                <h1 class="h1 w-100 text-center text-primary p-3">Add new Deduction</h1>
                <div class="d-flex w-50 m-auto">
                    <input type="text" class="rounded-left w-100" placeholder="Search">
                    <button class="btn btn-primary rounded-0 rounded-end"><i class="bi bi-search"></i></button>
                </div>
                <div class="row p-5">
                    <div class="col">
                        <img src="pictures/1.png" style="height: 150px; width:150px">
                    </div>
                <div class="col">
                    <h2>Name</h2>
                    <h5>Employee ID</h5>
                    <h5>Employee Position</h5>
                    <h5>Employment Status</h5>
                </div>

                <div class="ps-5 pe-5 pt-4">
                    <h3 class="w-100">Deduction Name</h3>
                    <select id="inputState" name="position" class="border-secondary p-1 w-100 rounded ">
                        <option class="dropdown-item" selected>Teacher</option>
                        <option class="dropdown-item">Staff</option>
                        <option class="dropdown-item">Principal</option>
                    </select>
                    <h3 class="mt-3">Deduction Amount</h3>
                    <input type="text" class="mb-3 p-1 w-100 rounded" placeholder="Amount">
                </div>
                <div class="row text-center ps-5 pe-5 pb-2">
                    <div class="col">
                        <button class="btn btn-success w-75">Save</button>
                    </div>
                    <div class="col">
                        <button class="btn btn-danger w-75">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
