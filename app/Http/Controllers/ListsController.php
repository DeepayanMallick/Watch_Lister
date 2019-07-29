<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lists;
use App\User;
use App\Share;

class ListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        
        
    }
    
    public function index()
    {   
        // My List Page 
        $user_id = auth()->user()->id;
        $listings = Lists::where('user_id',$user_id)->get();
       
        return view('mylist.index', compact('listings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Create Mylist

        $user_id = auth()->user()->id;
        $listings = Lists::where('user_id',$user_id)->get();
        return view('mylist.create', compact('listings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Store Data To Mylist

        $this->validate($request, [
            'title' => 'required',
        ]);
        
        $mylist = new Lists;
        $mylist->title = $request->input('title');
        $mylist->user_id = auth()->user()->id;
        $mylist->privacy_id = 1;
        $mylist->save();

        return redirect('/mylist/create')->with('success', 'List Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {      
        //List View Page
        
        $list = Lists::find($id);
        $users = User::all();
        if (!isset($list)){
            return redirect('/mylist')->with('error', 'No List Found');
        }
 
        return view('mylist.show', compact('list', 'users'));
    }

    public function privacy(Request $request, $id)
    {      
        //Share option 
        $listing = Lists::find($id);             

        $this->validate($request, [
            'user_id' => 'required',
        ]);
        
        $users_id = $request->input('user_id');
        
        foreach ($users_id as $data) {
            $share = new Share;
            $share->user_id = $data;
            $share->lists_id = $listing->id;
            $share->save();
        }
        
        $listing->privacy_id = 3;
        $listing->save();

        return redirect('/mylist')->with('success', 'List Shared Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        // Update Mylist
        $list = Lists::find($id);        
        
        if (!isset($list)){
            return redirect('/mylist/create')->with('error', 'No List Found');
        }

        return view('mylist.edit', compact('list'));
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
        $this->validate($request, [
            'title' => 'required',
            'privacy_id' => 'required',
        ]);

        // Update Mylist        
        $list = Lists::find($id);
        $list->title = $request->input('title');
        $list->privacy_id = $request->input('privacy_id');
        $list->save();

        return redirect('/mylist')->with('success', 'List Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        // Delete a List
        $list = Lists::find($id);        
       
        $list->delete();
        return redirect('/mylist')->with('error', 'List Removed');
    }
}
