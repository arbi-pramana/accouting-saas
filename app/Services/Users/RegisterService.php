<?php
namespace App\Services\Users;

use App\Models\User;

class RegisterService{
    public function __construct()
    {
    }

    public function store($request,$token)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->plan = 1;
        $user->type = "admin";
        $user->register_token = $token;
        $user->is_active = 0;
        $user->save();
    }

    public function verify($request)
    {
        $user = User::where('register_token',$request->register_token)->first();
        if($user){
            $user->is_active = 1;
            $user->register_token = 1;
            $user->email_verified_at = now();
            $user->plan_expire_date = now()->addDay(7);
            $user->save();
            return redirect()->route('users.login')->with('success','Activation account successfully, please login');
        }else{
            return abort(404);
        }
    }

    public function generateConfirmToken($length = 128) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }
}