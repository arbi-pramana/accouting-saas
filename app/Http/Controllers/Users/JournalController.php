<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Coa;
use App\Models\Journal;
use App\Models\JournalItem;
use App\Services\Users\JournalService;
use App\Traits\UserTrait;
use Illuminate\Http\Request;

class JournalController extends Controller
{
    use UserTrait;

    protected $journal;
    public function __construct(JournalService $journal)
    {
        $this->journal = $journal;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['journals'] = Journal::where('create_by',$this->create_by())->get();
        return view('users.journal.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['coas'] = Coa::where('create_by',$this->create_by())->get();
        return view('users.journal.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->journal->store($request);
        return redirect('users/journal')->with('success','Data has been Added');
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
        $data['journal'] = Journal::find($id);
        $data['coas'] = Coa::where('create_by',$this->create_by())->get();
        return view('users.journal.edit',$data);
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
        $this->journal->update($request,$id);
        return redirect('users/journal')->with('success','Data has been Added');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Journal::find($id)->delete();
        JournalItem::where('journal_id',$id)->delete();
        return redirect()->back()->with('danger','Data has been Deleted');
    }
}
