<?php 

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Traits\UserTrait;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    use UserTrait;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data['customers'] = Customer::where('create_by',$this->create_by())->get();
        return view('users.customer.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['remarks'] = $this->remarks();
        $data['create_by'] = $this->create_by();
        Customer::create($data);
        return redirect()->back()->with('success','Data has been Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        $customer = Customer::find($id);
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->description = $request->description;
        $customer->remarks = $this->remarks();
        $customer->create_by = $this->create_by();
        $customer->save();
        return redirect()->back()->with('success','Data has been Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Customer::find($id)->delete();
        return redirect()->back()->with('danger','Data has been Deleted');
    }
}   

?>