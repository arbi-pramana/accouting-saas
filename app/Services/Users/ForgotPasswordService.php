<?php

namespace App\Services\Users;

use App\Models\PasswordReset;
use App\Models\User;

class ForgotPasswordService{

    public function store($email,$token)
    {
        $forgot_password = new PasswordReset();
        $forgot_password->email = $email;
        $forgot_password->token = $token;
        $forgot_password->save();
    }

    public function update($email,$password)
    {
        $user = User::where('email',$email)->first();
        $user->password = bcrypt($password);
        $user->save();
    }

    public function generateConfirmToken($length = 128) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }
}