<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Coa;
use App\Traits\UserTrait;
use Illuminate\Http\Request;

class CoaController extends Controller
{
    use UserTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['coas'] = Coa::where('create_by',$this->create_by())->get();
        return view('users.coa.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['remarks'] = $this->remarks();
        $data['create_by'] = $this->create_by();
        Coa::create($data);
        return redirect()->back()->with('success','Data has been Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $coa = Coa::find($id);
        $data['remarks'] = $this->remarks();
        $data['create_by'] = $this->create_by();
        $coa->update($data);
        return redirect()->back()->with('success','Data has been Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Coa::find($id)->delete();
        return redirect()->back()->with('danger','Data has been Deleted');
    }
}
