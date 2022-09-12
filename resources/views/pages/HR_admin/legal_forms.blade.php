@extends('layout.admin_app')
    @section('content')
    <div class="container">
        <h1 class="section-title mt-2 pb-1">Legal Forms</h1>
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#SSS">SSS Forms</a></li>
            <li><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#Philhealth">Philhealth Forms</a></li>
            <li><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#Pagibig">Pagibig Forms</a></li>
            <li><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#BIR">BIR Forms</a></li>
        </ul>

        <div class="tab-content">
            <div id="SSS" class="tab-pane in active m-0">
                <div class="container p-5 border shadow-lg">
                    <ul class="nav nav-pills">
                        <li class="active"><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#SSS_1">Employer SSS Forms</a></li>
                        <li><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#SSS_2">All SSS Forms</a></li>
                        <li><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#SSS_3">Accomplished Forms</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="SSS_1" class="tab-pane active in m-0">
                            <div class="container p-3">
                                <h4 class="w-100 text-center display-5 p-3">Employer SSS Forms</h4>
                                <hr>
                                <div class="row">
                                    <div class="col-3 p-0">
                                        <ul class="nav nav-pills p-0 w-100">
                                            @foreach ($files_arr['SSS']['files'] as $key => $item)
                                            @if(!$key)
                                                <li class="active w-100 text-wrap"><a data-toggle="tab" class="nav-item nav-link text-decoration-none m-0 p-3 w-100 text-center border text-wrap" style="word-wrap: break-word;" href="#SSS_files_{{$key}}">{{ $item['name'] }}</a></li>
                                            @else
                                                <li class="w-100 text-wrap"><a data-toggle="tab" class="nav-item nav-link text-decoration-none border m-0 w-100 p-3 text-center text-wrap" style="word-wrap: break-word;" href="#SSS_files_{{$key}}">{{ $item['name'] }}</a></li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="col bg-dark">
                                        <div class="tab-content">
                                            @foreach ($files_arr['SSS']['files'] as $key => $item)
                                            @if(!$key)
                                                <div id="SSS_files_{{$key}}" class="tab-pane active in m-0">
                                                    <div class="container text-center">
                                                        <embed src="/{{$item['path']}}" width="800px" height="1600px" />
                                                    </div>
                                                </div>
                                            @else
                                                <div id="SSS_files_{{$key}}" class="tab-pane in m-0">
                                                    <div class="container text-center">
                                                        <embed src="/{{$item['path']}}" width="800px" height="1600px" />
                                                    </div>
                                                </div>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="SSS_2" class="tab-pane in m-0">
                            <div class="container p-5">
                                @if ($sss == 0)
                                    <h1 class="w-100 text-center"><i class="bi bi-cone-striped text-warning" style="font-size: 150px"></i><i class="bi bi-cone-striped text-warning" style="font-size: 300px"></i><i class="bi bi-cone-striped text-warning" style="font-size: 150px"></i></h1>
                                    <h1 class="w-100 text-center display-3">SSS Server is down</h1>
                                @else
                                    <div class="row">
                                        <div class="col pt-4"><h1 class="display-5">All SSS Forms</h1></div>
                                        <div class="col-3 card border-primary shadow-sm p-3 text-center">All information was retrived from: <br>
                                            <a href="https://www.sss.gov.ph/sss/appmanager/sss_downloads.jsp?type=forms">https://www.sss.gov.ph/sss/appmanager/sss_downloads.jsp?type=forms</a></div>
                                    </div>
                                    <hr>
                                    {!! $sss !!}
                                @endif
                            </div>
                        </div>
                        <div id="SSS_3" class="tab-pane in m-0">
                            <div class="container p-3">
                                <div class="row">
                                    <div class="col pt-4">
                                        <h4 class="w-100 display-5">Accomplished SSS Forms</h4>
                                    </div>
                                    <div class="col-3 card shadow-sm border-success">
                                        <form action="/uploadLegalFormFiles" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="m-3">
                                                <label for="formFile" class="form-label">Upload Accomplished SSS Forms</label>
                                                <input type="hidden" value="SSS" name="form_type">
                                                <input class="form-file" type="file" name='file_input' id="formFile" accept="application/pdf">
                                            </div>
                                            <div class="row p-0 ">
                                                <div class="col m-0 p-0">
                                                    <button class="btn btn-success rounded-0 rounded-bottom w-100 p-2" type="submit">Upload</button>
                                                </div>
                                                <div class="col-3 m-0 p-0">
                                                    <button class="btn btn-outline-danger rounded-0 rounded-bottom w-100 p-2" onclick="location.reload()">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-3 p-0">
                                        <ul class="nav nav-pills p-0 w-100">
                                            @foreach ($accomplished_files_arr['SSS']['files'] as $key => $item)
                                            @if(!$key)
                                            <li class="active w-100 text-wrap d-flex my-1"><a data-toggle="tab" class="nav-item nav-link text-decoration-none m-0 p-3 w-75 text-center border" style="word-wrap: break-word;" href="#SSS_accomplished_files_{{$key}}">{{ $item['name'] }}</a>
                                                <form action="/removeLegalFormFile" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="file_path" value="{{ $item['path'] }}">
                                                    <button type="submit" class="btn btn-outline-danger h-100"><i class="bi bi-trash"></i><br>Remove</button>
                                                </form></li>
                                            @else
                                                <li class="w-100 text-wrap d-flex my-1"><a data-toggle="tab" class="nav-item nav-link text-decoration-none border m-0 w-75 p-3 text-center" style="word-wrap: break-word;" href="#SSS_accomplished_files_{{$key}}">{{ $item['name'] }}</a>
                                                <form action="/removeLegalFormFile" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="file_path" value="{{ $item['path'] }}">
                                                    <button type="submit" class="btn btn-outline-danger h-100"><i class="bi bi-trash"></i><br>Remove</button>
                                                </form></li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="col bg-dark">
                                        <div class="tab-content">
                                            @foreach ($accomplished_files_arr['SSS']['files'] as $key => $item)
                                            @if(!$key)
                                                <div id="SSS_accomplished_files_{{$key}}" class="tab-pane active in m-0">
                                                    <div class="container text-center">
                                                        <embed src="/{{$item['path']}}" width="800px" height="1600px" />
                                                    </div>
                                                </div>
                                            @else
                                                <div id="SSS_accomplished_files_{{$key}}" class="tab-pane in m-0">
                                                    <div class="container text-center">
                                                        <embed src="/{{$item['path']}}" width="800px" height="1600px" />
                                                    </div>
                                                </div>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="Philhealth" class="tab-pane in m-0">
                <div class="container p-5 border shadow-lg">
                    <ul class="nav nav-pills">
                        <li class="active"><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#Philhealth_1">Employer Philhealth Forms</a></li>
                        <li><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#Philhealth_2">All Philhealth Forms</a></li>
                        <li><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#Philhealth_3">Accomplished Forms</a></li>

                    </ul>

                    <div class="tab-content">
                        <div id="Philhealth_1" class="tab-pane active in m-0">
                            <div class="container p-3">
                                <h4 class="w-100 text-center display-6">Employer Philhealth Forms</h4>
                                <hr>
                                <div class="row">
                                    <div class="col-3 p-0">
                                        <ul class="nav nav-pills p-0 w-100">
                                            @foreach ($files_arr['Philhealth']['files'] as $key => $item)
                                            @if(!$key)
                                                <li class="active w-100 text-wrap"><a data-toggle="tab" class="nav-item nav-link text-decoration-none m-0 p-3 w-100 text-center border text-wrap" style="word-wrap: break-word;" href="#Philhealth_files_{{$key}}">{{ $item['name'] }}</a></li>
                                            @else
                                                <li class="w-100 text-wrap"><a data-toggle="tab" class="nav-item nav-link text-decoration-none border m-0 w-100 p-3 text-center text-wrap" style="word-wrap: break-word;" href="#Philhealth_files_{{$key}}">{{ $item['name'] }}</a></li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="col bg-dark">
                                        <div class="tab-content">
                                            @foreach ($files_arr['Philhealth']['files'] as $key => $item)
                                            @if(!$key)
                                                <div id="Philhealth_files_{{$key}}" class="tab-pane active in m-0">
                                                    <div class="container text-center">
                                                        <embed src="/{{$item['path']}}" width="800px" height="1600px" />
                                                    </div>
                                                </div>
                                            @else
                                                <div id="Philhealth_files_{{$key}}" class="tab-pane in m-0">
                                                    <div class="container text-center">
                                                        <embed src="/{{$item['path']}}" width="800px" height="1600px" />
                                                    </div>
                                                </div>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="Philhealth_2" class="tab-pane in m-0">
                            <div class="container p-5">
                                @if ($philhealth == 0)
                                    <h1 class="w-100 text-center"><i class="bi bi-cone-striped text-warning" style="font-size: 150px"></i><i class="bi bi-cone-striped text-warning" style="font-size: 300px"></i><i class="bi bi-cone-striped text-warning" style="font-size: 150px"></i></h1>
                                    <h1 class="w-100 text-center display-3">Philhealth Server is down</h1>
                                @else
                                    <div class="row">
                                        <div class="col pt-4"><h1 class="display-5">All Philhealth Forms</h1></div>
                                        <div class="col-3 card border-primary shadow-sm p-3 text-center">All information was retrived from: <br>
                                            <a href="https://www.philhealth.gov.ph/downloads/">https://www.philhealth.gov.ph/downloads/</a></div>
                                    </div>
                                    <hr>
                                    <style>
                                        li{
                                            list-style: none;
                                        }
                                    </style>
                                    {!! $philhealth !!}
                                @endif
                            </div>
                        </div>
                        <div id="Philhealth_3" class="tab-pane in m-0">
                            <div class="container p-3">
                                <div class="row">
                                    <div class="col pt-4">
                                        <h4 class="w-100 text-center display-6">Accomplished Philhealth Forms</h4>
                                    </div>
                                    <div class="col-3 card shadow-sm border-success">
                                        <form action="/uploadLegalFormFiles" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="m-3">
                                                <label for="formFile" class="form-label">Upload Accomplished Philhealth Forms</label>
                                                <input type="hidden" value="Philhealth" name="form_type">
                                                <input class="form-file" type="file" name='file_input' id="formFile" accept="application/pdf">
                                            </div>
                                            <div class="row p-0 ">
                                                <div class="col m-0 p-0">
                                                    <button class="btn btn-success rounded-0 rounded-bottom w-100 p-2" type="submit">Upload</button>
                                                </div>
                                                <div class="col-3 m-0 p-0">
                                                    <button class="btn btn-outline-danger rounded-0 rounded-bottom w-100 p-2" onclick="location.reload()">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-3 p-0">
                                        <ul class="nav nav-pills p-0 w-100">
                                            @foreach ($accomplished_files_arr['Philhealth']['files'] as $key => $item)
                                            @if(!$key)
                                            <li class="active w-100 text-wrap d-flex my-1"><a data-toggle="tab" class="nav-item nav-link text-decoration-none m-0 p-3 w-75 text-center border text-wrap" style="word-wrap: break-word;" href="#Philhealth_accomplished_files_{{$key}}">{{ $item['name'] }}</a>
                                                <form action="/removeLegalFormFile" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="file_path" value="{{ $item['path'] }}">
                                                    <button type="submit" class="btn btn-outline-danger h-100"><i class="bi bi-trash"></i><br>Remove</button>
                                                </form></li>
                                            @else
                                                <li class="w-100 text-wrap d-flex my-1"><a data-toggle="tab" class="nav-item nav-link text-decoration-none border m-0 w-75 p-3 text-center text-wrap" style="word-wrap: break-word;" href="#Philhealth_accomplished_files_{{$key}}">{{ $item['name'] }}</a>
                                                <form action="/removeLegalFormFile" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="file_path" value="{{ $item['path'] }}">
                                                    <button type="submit" class="btn btn-outline-danger h-100"><i class="bi bi-trash"></i><br>Remove</button>
                                                </form></li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="col bg-dark">
                                        <div class="tab-content">
                                            @foreach ($accomplished_files_arr['Philhealth']['files'] as $key => $item)
                                            @if(!$key)
                                                <div id="Philhealth_accomplished_files_{{$key}}" class="tab-pane active in m-0">
                                                    <div class="container text-center">
                                                        <embed src="/{{$item['path']}}" width="800px" height="1600px" />
                                                    </div>
                                                </div>
                                            @else
                                                <div id="Philhealth_accomplished_files_{{$key}}" class="tab-pane in m-0">
                                                    <div class="container text-center">
                                                        <embed src="/{{$item['path']}}" width="800px" height="1600px" />
                                                    </div>
                                                </div>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="Pagibig" class="tab-pane in m-0">
                <div class="container p-5 border shadow-lg">
                    <ul class="nav nav-pills">
                        <li class="active"><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#Pagibig_1">Employer Pagibig Forms</a></li>
                        <li><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#Pagibig_2">All Pagibig Forms</a></li>
                        <li><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#Pagibig_3">Accomplished Forms</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="Pagibig_1" class="tab-pane active in m-0">
                            <div class="container p-3">
                                <h4 class="w-100 text-center display-6">Employer Pagibig Forms</h4>
                                <hr>
                                <div class="row">
                                    <div class="col-3 p-0">
                                        <ul class="nav nav-pills p-0 w-100">
                                            @foreach ($files_arr['Pagibig']['files'] as $key => $item)
                                            @if(!$key)
                                                <li class="active w-100 text-wrap"><a data-toggle="tab" class="nav-item nav-link text-decoration-none m-0 p-3 w-100 text-center border text-wrap" style="word-wrap: break-word;" href="#Pagibig_files_{{$key}}">{{ $item['name'] }}</a></li>
                                            @else
                                                <li class="w-100 text-wrap"><a data-toggle="tab" class="nav-item nav-link text-decoration-none border m-0 w-100 p-3 text-center text-wrap" style="word-wrap: break-word;" style="word-wrap: break-word;" href="#Pagibig_files_{{$key}}">{{ $item['name'] }}</a></li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="col bg-dark">
                                        <div class="tab-content">
                                            @foreach ($files_arr['Pagibig']['files'] as $key => $item)
                                            @if(!$key)
                                                <div id="Pagibig_files_{{$key}}" class="tab-pane active in m-0">
                                                    <div class="container text-center">
                                                        <embed src="/{{$item['path']}}" width="800px" height="1600px" />
                                                    </div>
                                                </div>
                                            @else
                                                <div id="Pagibig_files_{{$key}}" class="tab-pane in m-0">
                                                    <div class="container text-center">
                                                        <embed src="/{{$item['path']}}" width="800px" height="1600px" />
                                                    </div>
                                                </div>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="Pagibig_2" class="tab-pane in m-0">
                            <div class="container p-5">
                                @if ($pagibig == 0)
                                    <h1 class="w-100 text-center"><i class="bi bi-cone-striped text-warning" style="font-size: 150px"></i><i class="bi bi-cone-striped text-warning" style="font-size: 300px"></i><i class="bi bi-cone-striped text-warning" style="font-size: 150px"></i></h1>
                                    <h1 class="w-100 text-center display-3">Pagibig Server is down</h1>
                                @else
                                    <div class="row">
                                        <div class="col pt-4"><h1 class="display-5">All Pagibig Forms</h1></div>
                                        <div class="col-3 card border-primary shadow-sm p-3 text-center">All information was retrived from: <br>
                                            <a href="https://www.pagibigfund.gov.ph/forms_provident.html">https://www.pagibigfund.gov.ph/forms_provident.html</a></div>
                                    </div>
                                    <hr>
                                    {!! $pagibig !!}
                                @endif
                            </div>
                        </div>
                        <div id="Pagibig_3" class="tab-pane in m-0">
                            <div class="container p-3">
                                <div class="row">
                                    <div class="col pt-4">
                                        <h4 class="w-100 text-center display-6">Accomplished Pagibig Forms</h4>
                                    </div>
                                    <div class="col-3 card shadow-sm border-success">
                                        <form action="/uploadLegalFormFiles" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="m-3">
                                                <label for="formFile" class="form-label">Upload Accomplished Pagibig Forms</label>
                                                <input type="hidden" value="Pagibig" name="form_type">
                                                <input class="form-file" type="file" name='file_input' id="formFile" accept="application/pdf">
                                            </div>
                                            <div class="row p-0 ">
                                                <div class="col m-0 p-0">
                                                    <button class="btn btn-success rounded-0 rounded-bottom w-100 p-2" type="submit">Upload</button>
                                                </div>
                                                <div class="col-3 m-0 p-0">
                                                    <button class="btn btn-outline-danger rounded-0 rounded-bottom w-100 p-2" onclick="location.reload()">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-3 p-0">
                                        <ul class="nav nav-pills p-0 w-100">
                                            @foreach ($accomplished_files_arr['Pagibig']['files'] as $key => $item)
                                            @if(!$key)
                                                <li class="active w-100 text-wrap d-flex my-1"><a data-toggle="tab" class="nav-item nav-link text-decoration-none m-0 p-3 w-75 text-center border text-wrap" style="word-wrap: break-word;" href="#Pagibig_accomplished_files_{{$key}}">{{ $item['name'] }}</a>
                                                <form action="/removeLegalFormFile" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="file_path" value="{{ $item['path'] }}">
                                                    <button type="submit" class="btn btn-outline-danger h-100"><i class="bi bi-trash"></i><br>Remove</button>
                                                </form></li>
                                            @else
                                                <li class="w-100 text-wrap d-flex my-1"><a data-toggle="tab" class="nav-item nav-link text-decoration-none border m-0 w-75 p-3 text-center text-wrap" style="word-wrap: break-word;" href="#Pagibig_accomplished_files_{{$key}}">{{ $item['name'] }}</a>
                                                <form action="/removeLegalFormFile" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="file_path" value="{{ $item['path'] }}">
                                                    <button type="submit" class="btn btn-outline-danger h-100"><i class="bi bi-trash"></i><br>Remove</button>
                                                </form></li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="col bg-dark">
                                        <div class="tab-content">
                                            @foreach ($accomplished_files_arr['Pagibig']['files'] as $key => $item)
                                            @if(!$key)
                                                <div id="Pagibig_accomplished_files_{{$key}}" class="tab-pane active in m-0">
                                                    <div class="container text-center">
                                                        <embed src="/{{$item['path']}}" width="800px" height="1600px" />
                                                    </div>
                                                </div>
                                            @else
                                                <div id="Pagibig_accomplished_files_{{$key}}" class="tab-pane in m-0">
                                                    <div class="container text-center">
                                                        <embed src="/{{$item['path']}}" width="800px" height="1600px" />
                                                    </div>
                                                </div>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="BIR" class="tab-pane in m-0">
                <div class="container p-5 border shadow-lg">
                    <ul class="nav nav-pills">
                        <li class="active"><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#BIR_1">Employer BIR Forms</a></li>
                        <li><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#BIR_2">All BIR Forms</a></li>
                        <li><a data-toggle="tab" class="h5 text-decoration-none m-0" href="#BIR_3">Accomplished Forms</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="BIR_1" class="tab-pane active in m-0">
                            <div class="container p-3">
                                <h4 class="w-100 text-center display-6">Employer BIR Forms</h4>
                                <hr>
                                <div class="row">
                                    <div class="col-3 p-0">
                                        <ul class="nav nav-pills p-0 w-100">
                                            @foreach ($files_arr['BIR']['files'] as $key => $item)
                                            @if(!$key)
                                                <li class="active w-100 text-wrap"><a data-toggle="tab" class="nav-item nav-link text-decoration-none m-0 p-3 w-100 text-center border text-wrap" style="word-wrap: break-word;" href="#BIR_files_{{$key}}">{{ $item['name'] }}</a></li>
                                            @else
                                                <li class="w-100 text-wrap"><a data-toggle="tab" class="nav-item nav-link text-decoration-none border m-0 w-100 p-3 text-center text-wrap" style="word-wrap: break-word;" href="#BIR_files_{{$key}}">{{ $item['name'] }}</a></li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="col bg-dark">
                                        <div class="tab-content">
                                            @foreach ($files_arr['BIR']['files'] as $key => $item)
                                            @if(!$key)
                                                <div id="BIR_files_{{$key}}" class="tab-pane active in m-0">
                                                    <div class="container text-center">
                                                        <embed src="/{{$item['path']}}" width="800px" height="1600px" />
                                                    </div>
                                                </div>
                                            @else
                                                <div id="BIR_files_{{$key}}" class="tab-pane in m-0">
                                                    <div class="container text-center">
                                                        <embed src="/{{$item['path']}}" width="800px" height="1600px" />
                                                    </div>
                                                </div>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="BIR_2" class="tab-pane in m-0">
                            <div class="container p-5">
                                @if ($bir == 0)
                                    <h1 class="w-100 text-center"><i class="bi bi-cone-striped text-warning" style="font-size: 150px"></i><i class="bi bi-cone-striped text-warning" style="font-size: 300px"></i><i class="bi bi-cone-striped text-warning" style="font-size: 150px"></i></h1>
                                    <h1 class="w-100 text-center display-3">BIR Server is down</h1>
                                @else
                                    <div class="row">
                                        <div class="col pt-4"><h1 class="display-5">All BIR Forms</h1></div>
                                        <div class="col-3 card border-primary shadow-sm p-3 text-center">All information was retrived from: <br>
                                            <a href="https://www.bir.gov.ph/index.php/bir-forms.html">https://www.bir.gov.ph/index.php/bir-forms.html</a></div>
                                    </div>
                                    <hr>
                                    {!! $bir !!}
                                @endif
                            </div>
                        </div>
                        <div id="BIR_3" class="tab-pane in m-0">
                            <div class="container p-3">
                                <div class="row">
                                    <div class="col pt-4">
                                        <h4 class="w-100 text-center display-6">Accomplished BIR Forms</h4>
                                    </div>
                                    <div class="col-3 card shadow-sm border-success">
                                        <form action="/uploadLegalFormFiles" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="m-3">
                                                <label for="formFile" class="form-label">Upload Accomplished BIR Forms</label>
                                                <input type="hidden" value="BIR" name="form_type">
                                                <input class="form-file" type="file" name='file_input' id="formFile" accept="application/pdf">
                                            </div>
                                            <div class="row p-0 ">
                                                <div class="col m-0 p-0">
                                                    <button class="btn btn-success rounded-0 rounded-bottom w-100 p-2" type="submit">Upload</button>
                                                </div>
                                                <div class="col-3 m-0 p-0">
                                                    <button class="btn btn-outline-danger rounded-0 rounded-bottom w-100 p-2" onclick="location.reload()">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-3 p-0">
                                        <ul class="nav nav-pills p-0 w-100">
                                            @foreach ($accomplished_files_arr['BIR']['files'] as $key => $item)
                                            @if(!$key)
                                                <li class="active w-100 text-wrap d-flex my-1"><a data-toggle="tab" class="nav-item nav-link text-decoration-none m-0 p-3 w-75 text-center border text-wrap" style="word-wrap: break-word;" href="#BIR_accomplished_files_{{$key}}">{{ $item['name'] }}</a>
                                                <form action="/removeLegalFormFile" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="file_path" value="{{ $item['path'] }}">
                                                    <button type="submit" class="btn btn-outline-danger h-100"><i class="bi bi-trash"></i><br>Remove</button>
                                                </form></li>
                                            @else
                                                <li class="w-100 text-wrap d-flex my-1"><a data-toggle="tab" class="nav-item nav-link text-decoration-none border m-0 w-75 p-3 text-center text-wrap" style="word-wrap: break-word;" href="#BIR_accomplished_files_{{$key}}">{{ $item['name'] }}</a>
                                                <form action="/removeLegalFormFile" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="file_path" value="{{ $item['path'] }}">
                                                    <button type="submit" class="btn btn-outline-danger h-100"><i class="bi bi-trash"></i><br>Remove</button>
                                                </form></li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="col bg-dark">
                                        <div class="tab-content">
                                            @foreach ($accomplished_files_arr['BIR']['files'] as $key => $item)
                                            @if(!$key)
                                                <div id="BIR_accomplished_files_{{$key}}" class="tab-pane active in m-0">
                                                    <div class="container text-center">
                                                        <embed src="/{{$item['path']}}" width="800px" height="1600px" />
                                                    </div>
                                                </div>
                                            @else
                                                <div id="BIR_accomplished_files_{{$key}}" class="tab-pane in m-0">
                                                    <div class="container text-center">
                                                        <embed src="/{{$item['path']}}" width="800px" height="1600px" />
                                                    </div>
                                                </div>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @endsection
