<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait UserTrait{
    public function create_by()
    {
        if(!empty(Auth::guard('users')->user()->create_by)){
            return Auth::guard('users')->user()->create_by;
        } else {
            return Auth::guard('users')->id();
        }
    }

    public function remarks()
    {
        return Auth::guard('users')->user()->name;
    }
}