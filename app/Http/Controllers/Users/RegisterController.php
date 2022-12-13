<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Mail\MailConfirmation;
use App\Services\Users\RegisterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    protected $register;

    public function __construct(RegisterService $register)
    {
        $this->register = $register;
    }

    public function index()
    {
        return view('users.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'phone'=>'required',
            'email'=>'required|unique:users',
            'password' => [
                'required',
                'min:8',
            ],
            'confirm_password' => 'required_with:password|same:password'
        ]);
        $token = $this->register->generateConfirmToken();
        $this->register->store($request,$token);
        Mail::to($request->email)->send(new MailConfirmation($request->name,$request->email,$token));
        return redirect()->back()->with('success','Register has been successfully, Please check your email');
    }

    public function verify(Request $request)
    {
        return $this->register->verify($request);
    }
}
