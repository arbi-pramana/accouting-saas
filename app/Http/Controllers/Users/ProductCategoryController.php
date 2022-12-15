<?php 

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Traits\UserTrait;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller 
{
    use UserTrait;

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data['product_categorys'] = ProductCategory::where('create_by',$this->create_by())->get();
        return view('users.product-category.index',$data);
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
		ProductCategory::create($data);
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
		$product_category = ProductCategory::find($id);
        $data = $request->all();
        $data['remarks'] = $this->remarks();
		$data['create_by'] = $this->create_by();
		$product_category->update($data);
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
		ProductCategory::find($id)->delete();
        return redirect()->back()->with('danger','Data has been Deleted');
	}
}

?>