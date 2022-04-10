@extends('layout.datatables')
    @section('content')
    <div class="container mt-5">
        <table class="table table-bordered table-striped" id="order_table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Item</th>
                    <th>Value</th>
                    <th>Date</th>
                </tr>
            </thead>
        </table>
    </div>
    <script>
        $(document).ready( function () {
            $('#order_table').DataTable( {
                ajax: {
                    url: '/userDetail',
                    dataSrc: ''
                },
                columns: [
                    { data: 'full_name' },
                    { data: 'fname' },
                    { data: 'fname' },
                    { data: 'fname' },
                    { data: 'fname' }
                ]
            });
        });
    </script>
    @endsection
