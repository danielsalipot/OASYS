@extends('layout.messaging')

@section('title')
    <h1 class="section-title mt-5 pb-2">Notification</h1>
    <style>
        p{
            font-size: 20px;
        }
    </style>
@endsection

@section('content')

    @foreach ($notif as $data)
        <div class="row shadow-lg p-3 my-5">
            <div class="col-5 d-flex flex-row flex-wrap align-items-center p-0">
                <h3 class="display-4 w-100 text-center">Recepients</h3>
                @foreach ($data->receivers as $item)
                    <div class="col-4 card">
                        <div class="row">
                            <div class="col-4">
                                <img src="{{ URL::asset($item->data->picture)}}" alt="" height="50px" width="50px" class="rounded">
                            </div>
                            <div class="col mt-4">
                                {{ $item->data->fname }} {{ $item->data->mname }} {{ $item->data->lname }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col border ">
                <h1>Notification Title</h1>
                <input disabled type="type" value="{{ $data->title }}" class="h4 p-3 w-100">
                <h3>Notification Body</h3>
                {!! $data->message !!}
            </div>
        </div>
    @endforeach
@endsection
