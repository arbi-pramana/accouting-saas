<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusinessInfoController extends Controller
{
    public function index(Request $request)
    {
        $data['setting'] = Setting::where('create_by',Auth::guard('users')->user()->id)->first();
        return view('users.business-info',$data);
    }

    public function store(Request $request)
    {
        $setting = Setting::updateOrCreate(
            ['create_by' => Auth::guard('users')->user()->id],
        );
        $setting->company = $request->company;
        $setting->address = $request->address;
        $setting->accounting_periods = $request->accounting_periods;
        $setting->save();
        return redirect()->back()->with('success','Data has been Updated');
    }
}
