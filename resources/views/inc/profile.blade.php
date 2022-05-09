<div id="profile_div" class="position-fixed top-0 end-0 card p-0 border py-2 border-dark rounded text-center" style="width:50px; z-index: 999;">
    <div class="d-flex flex-row justify-content-center align-items-center">
        <div class="col">
            <button onclick="collapse()" id="collapse_btn"class="btn btn-none text-primary" style="font-size:20px" ><i class="bi bi-person"></i></button>
        </div>
        <div class="col-1 d-none" id="details"></div>
        <div class="col-2 d-none" id="details">
            <a href="/change_picture"><img src="/{{$profile->picture}}" style="object-fit: cover;"  class="m-0 rounded-circle" width="50px" height="50px"></a>
        </div>
        <div class="col-6 d-none" id="details">
            <h5 class="mb-0">{{ $profile->fname }} {{ $profile->mname }} {{ $profile->lname }}</h5>
            <h6 class="mb-0">{{ ucfirst(session('user_type')) }}</h6>
            <p class="mb-0">ID: #{{ $profile->login_id }}</p>
        </div>
        <div class="col d-none" id="details"></div>
        <div class="col-1 text-center d-none me-2" id="details">
            <a href="/logout"  title="Logout" data-bs-toggle="tooltip" style="font-size:25px"><i class="bi bi-box-arrow-left"></i></a>
        </div>
    </div>
</div>

<script>
    function collapse(){
        if($('#collapse_btn').html() == '<i class="bi bi-chevron-double-right"></i>'){
            var zoomin = setInterval(function () {
                if($('#profile_div').width() > 50){
                    var wid= $('#profile_div').width();
                    $('#profile_div').width(`${wid - 10}px`)
                    if($('#profile_div').width() < 200){
                        $("[id=details]").addClass('d-none')
                        $('#collapse_btn').html('<i class="bi bi-person"></i>')
                    }
                }
                else{
                    clearInterval(zoomin)
                }
            }, 15);
        }

        if($('#collapse_btn').html() == '<i class="bi bi-person"></i>'){
            var zoomout = setInterval(function () {
                if($('#profile_div').width() < 350){
                    var wid= $('#profile_div').width();
                    $('#profile_div').width(`${wid + 10}px`)
                    if($('#profile_div').width() > 200){
                        $("[id=details]").removeClass('d-none')
                        $('#collapse_btn').html('<i class="bi bi-chevron-double-right"></i>')
                    }
                }
                else{
                    clearInterval(zoomout)
                }
            }, 15);
        }
    }
</script>
