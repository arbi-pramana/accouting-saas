<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Coa;
use App\Models\Journal;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Services\Users\PurchaseService;
use App\Traits\UserTrait;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    use UserTrait;

    protected $purchase;
    public function __construct(PurchaseService $purchase)
    {
        $this->purchase = $purchase;
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
        $data['suppliers'] = Supplier::where('create_by',$this->create_by())->get();
        $data['purchases'] = Purchase::where('create_by',$this->create_by())->get();
        return view('users.purchase.index',$data);
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
        $this->purchase->store($request);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Purchase::find($id)->delete();
        Journal::where('type','purchase')->where('reference_id',$id)->delete();
        return redirect()->back()->with('danger','Data has been Deleted');
    }
}
