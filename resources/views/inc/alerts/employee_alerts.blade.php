@if (session('insert'))
    <div class="alert alert-success">
        {{session('insert')}}
    </div>
@endif

@if (session('delete'))
    <div class="alert alert-danger">
        {{session('delete')}}
    </div>
@endif

