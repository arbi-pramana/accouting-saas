<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Mail\MailForgotPassword;
use App\Models\PasswordReset;
use App\Models\User;
use App\Services\Users\ForgotPasswordService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    protected $forgot_password;
    public function __construct(ForgotPasswordService $forgot_password)
    {
        $this->forgot_password = $forgot_password;
    }

    public function index()
    {
        return view('users.forgot-password');
    }

    public function newPassword ()
    {
        return view('users.new-password');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email'=>'required',
        ]);
        
        $user = User::where('email',$request->email)->first();
        if(empty($user)){
            return redirect()->back()->with('danger','Your email Not Found');
        }
        
        $token = $this->forgot_password->generateConfirmToken();
        $this->forgot_password->store($request->email,$token);

        Mail::to($request->email)->send(new MailForgotPassword($request->email,$token));
        return redirect()->back()->with('success','Forgot password has been sent, Please check your email');
    }

    public function storeNewPassword(Request $request)
    {
        $request->validate([
            'password' => [
                'required',
                'min:8',
            ],
            'confirm_password' => 'required_with:password|same:password'
        ]);
        $password_reset = PasswordReset::where('token',$request->token)->latest()->first();
        if(empty($password_reset)){
            return redirect()->back()->with('danger','Your data is Invalid');
        }
        $this->forgot_password->update($password_reset->email,$request->password);
        return redirect()->route('users.login')->with('success','Your password has been change');
    }
}
