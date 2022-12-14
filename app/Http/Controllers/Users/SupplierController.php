<?php 

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller 
{
    use UserTrait;

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data['suppliers'] = Supplier::where('create_by',$this->create_by())->get();
        return view('users.supplier.index',$data);
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
		Supplier::create($data);
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
		$supplier = Supplier::find($id);
		$supplier->name = $request->name;
		$supplier->email = $request->email;
		$supplier->phone = $request->phone;
		$supplier->address = $request->address;
		$supplier->description = $request->description;
        $supplier->remarks = $this->remarks();
		$supplier->create_by = $this->create_by();
		$supplier->save();
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
		Supplier::find($id)->delete();
        return redirect()->back()->with('danger','Data has been Deleted');
	}
}

?>