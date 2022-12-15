<?php
namespace App\Services\Users;

use App\Models\Coa;
use App\Models\User;
use Illuminate\Support\Facades\File;

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

            //add COA to table coas
            $path = storage_path('json')."/coa.json";
            $json = json_decode(File::get($path));
            foreach ($json as $data) {
                $coa = new Coa();
                $coa->coa = $data->coa;
                $coa->category_1 = $data->category_1;
                $coa->category_2 = $data->category_2;
                $coa->name = $data->name;
                $coa->opening_balance_db = 0;
                $coa->opening_balance_cr = 0;
                $coa->total_opening_balance = 0;
                $coa->create_by = $user->id;
                $coa->remarks = $user->name;
                $coa->is_locked = $data->is_locked;
                $coa->date = now();
                $coa->save();
            }
            return redirect()->route('users.login')->with('success','Activation account successfully, please login');
        }else{
            return abort(404);
        }
    }

    public function generateConfirmToken($length = 128) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }
}