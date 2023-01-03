<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Coa;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Supplier;
use App\Services\Users\SaleService;
use App\Traits\UserTrait;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    use UserTrait;

    protected $sale;
    public function __construct(SaleService $sale)
    {
        $this->sale = $sale;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['coas'] = Coa::whereIn('category_2',["1.1 Kas","1.2 Bank"])->where('create_by',$this->create_by())->get();
        $data['products'] = Product::where('create_by',$this->create_by())->get();
        $data['customers'] = Customer::where('create_by',$this->create_by())->get();
        $data['sales'] = Sale::where('create_by',$this->create_by())->get();
        return view('users.sale.index',$data);
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
        $this->sale->store($request);
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
        $this->sale->update($request,$id);
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
        Sale::find($id)->delete();
        return redirect()->back()->with('danger','Data has been Deleted');
    }
}
