<?php

namespace App\Http\Controllers\Staff\JSONControllers;

use App\Http\Controllers\Controller;
use App\Models\UserCredential;
use Illuminate\Http\Request;

class JsonController extends Controller
{
    public function applicantjson(){
        $applicants = UserCredential::where('user_type','applicant')
            ->join('user_details','user_details.login_id','=','user_credentials.login_id')
            ->join('applicant_details','applicant_details.login_id','=','user_credentials.login_id')
            ->get();

        return datatables()->of($applicants)
        ->addColumn('full_name',function($data){
            $full_name = $data->fname .' '. $data->mname . ' '. $data->lname ;

            return $full_name;
        })
        ->addColumn('img',function($data){
            $img = "<img src='/".$data->picture."' height='50px' width='50px' class='rounded-circle'>";

            return $img;
        })
        ->addColumn('onboard',function($data){
            $onboard ="<button class='btn btn-outline-primary px-3 py-3'
                data-toggle='modal' data-target='#profile_modal".$data->login_id."'>
                <i class='h4 bi bi-check2-circle'></i><br>
                Onboard
                </button>" ;
            return $onboard;
        })
        ->addColumn('delete',function($data){
            $onboard ="<button class='btn btn-outline-danger px-3 py-3'>
                <i class='h4 bi bi-trash-fill'></i><br>
                Delete
                </button>" ;
            return $onboard;
        })
        ->rawColumns(['full_name','img','onboard','delete'])
        ->make(true);
    }

    public function interviewjson(){
        $applicants = UserCredential::where('user_type','applicant')
            ->join('user_details','user_details.login_id','=','user_credentials.login_id')
            ->join('applicant_details','applicant_details.login_id','=','user_credentials.login_id')
            ->get();

        return datatables()->of($applicants)
        ->addColumn('full_name',function($data){
            $full_name = $data->fname .' '. $data->mname . ' '. $data->lname ;
            return $full_name;
        })
        ->addColumn('img',function($data){
            $img = "<img src='/".$data->picture."' height='80px' width='80px' class='rounded-circle'>";
            return $img;
        })
        ->addColumn('first',function($data){
            $add_sched = "
                <form>
                    <h5>Add Interview Schedule</h5>
                    <input type='text' class='form-control w-75 my-2' placeholder='asdasd'>
                    <br>
                    <button class='btn btn-primary w-75'>Add Schedule</button>
                </form>";
            return $add_sched;
        })
        ->addColumn('second',function($data){
            $add_sched = "
                <h4>Scheduled On</h4>
                <h6>2000-22-05</h6>
                <div class='row text-center'>
                    <div class='col'></div>
                    <div class='col-4'>
                        <button class='w-100 h-100 btn btn-outline-success'><i class='h1 bi bi-telephone'></i><br>Responded</button>
                    </div>
                    <div class='col-4'>
                        <button class='w-100 h-100 btn btn-outline-danger'><i class='h1 bi bi-telephone-x-fill'></i><br>Not Responded</button>
                    </div>
                    <div class='col'></div>
                </div>";
            return $add_sched;
        })
        ->rawColumns(['full_name','img','first','second'])
        ->make(true);
    }
}
