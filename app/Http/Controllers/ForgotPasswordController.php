<?php

namespace App\Http\Controllers;

use App\Models\UserCredential;
use App\Models\UserDetail;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class ForgotPasswordController extends Controller
{
    public function sendForgotPassword(Request $request){
        $config = \SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');
        $apiInstance = new \SendinBlue\Client\Api\TransactionalEmailsApi(
            // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
            // This is optional, `GuzzleHttp\Client` will be used as default.
            new \GuzzleHttp\Client(),
            $config
        );

        if(isset($request->username)){
            $user = UserCredential::where('username',$request->username)->first();
            if(!isset($user)){
                return back()->with(['user_err'=>'Incorrect credentials was submitted']);
            }

            $check = UserDetail::where('fname',$request->fname)
                ->where('lname',$request->lname)
                ->where('login_id',$user->login_id)
                ->first();

            if(!isset($check)){
                return back()->with(['user_err'=>'Incorrect credentials was submitted']);
            }

            $template = view('EmailTemplates.forgotPassword')
                ->with(['link' => $this->generateChangePasswordLink($check->login_id)])
                ->render();

            $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail();
            $sendSmtpEmail['subject'] = 'Forgot Password';
            $sendSmtpEmail['htmlContent'] = $template;
            $sendSmtpEmail['sender'] = array('name' => 'Oasys', 'email' => 'noreply@oasys.com');
            $sendSmtpEmail['to'] = array(
                array('email' => $check->email, 'name' => $check->fname . ' ' . $check->lname)
            );
            $sendSmtpEmail['headers'] = array('Some-Custom-Name' => 'unique-id-1234');
            $sendSmtpEmail['params'] = array('parameter' => 'My param value', 'subject' => 'New Subject');
        }
        elseif(isset($request->email)){
            $check = UserDetail::where('fname',$request->fname)
                ->where('lname',$request->lname)
                ->where('email',$request->email)
                ->first();

            if(!isset($check)){
                return back()->with(['user_err'=>'Incorrect credentials was submitted']);
            }

            $template = view('EmailTemplates.forgotPassword')
                ->with(['link' => $this->generateChangePasswordLink($check->login_id)])
                ->render();


            $sendSmtpEmail = new \SendinBlue\Client\Model\SendSmtpEmail();
            $sendSmtpEmail['subject'] = 'Forgot Password';
            $sendSmtpEmail['htmlContent'] =  $template;
            $sendSmtpEmail['sender'] = array('name' => 'Oasys', 'email' => 'noreply@oasys.com');
            $sendSmtpEmail['to'] = array(
                array('email' => $check->email, 'name' => $check->fname . ' ' . $check->lname)
            );
            $sendSmtpEmail['headers'] = array('Some-Custom-Name' => 'unique-id-1234');
            $sendSmtpEmail['params'] = array('parameter' => 'My param value', 'subject' => 'New Subject');
        }
        else{
            return back();
        }

        try {
            $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
            session()->flash('forgotPassCheck', 1);
            return view('pages.forgot_password.sent');
        } catch (Exception $e) {
            echo 'Exception when calling TransactionalEmailsApi->sendTransacEmail: ', $e->getMessage(), PHP_EOL;
        }
    }

    function generateChangePasswordLink($id){
        $date = Carbon::Now();
        return 'http://localhost:8000/Password/Forget/'.md5(md5($id)).'/'.md5($date);
    }

    function forgotPassword(Request $request){
        session()->reflash();
        $request->validate([
            'newpass' =>['required',
                            Password::min(8)
                                ->mixedCase() // allows both uppercase and lowercase
                                ->letters() //accepts letter
                                ->numbers() //accepts numbers
                                ->symbols() //accepts special character
                                ->uncompromised(),//check to be sure that there is no data leak
                    ],
            'confirmpass' =>'required',
        ]);

        $all = UserCredential::all();
        foreach ($all as $key => $value) {
            if(md5(md5($value->login_id)) == $request->id){
                if ($request->newpass == $request->confirmpass) {
                    UserCredential::where('login_id',$value->login_id)->update([
                        'password' => md5(md5($request->newpass))
                    ]);

                    return redirect('/logout');
                }
            }
        }

        return back()->with([
            'confirmation' => 'The new password and confirmation does not match'
        ]);
    }
}
