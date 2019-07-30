<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lists;
use App\Item;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        //
    }

    public function search() {
        //Search movie or tv shows
        $user_id = auth()->user()->id;
        $listings = Lists::where('user_id',$user_id)->get();
        // dd($listings);
        
        return view('item.search', compact('listings'));
        
    }
    public function store(Request $request) 
    { 
        // Get item id    
        $item_id =  $request->input('item_id');
        // dd($item_id); 

        //Get item details
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://api.themoviedb.org/3/movie/' . $item_id . '?api_key=3789176a07559b7b185cdcf1d3339e49');
        $response = $response->getBody();
        $item = json_decode($response);
        // dd($item);

        //Save the item into database
        $items = new Item;
        $items->title = $item->title;
        $items->lists_id = $request->input('mylist');
        $items->popularity = $item->popularity;
        $items->overview = $item->overview;
        $items->release_date = $item->release_date;
        $base_poster_path = "https://image.tmdb.org/t/p/original";
        $items->poster = $base_poster_path . $item->poster_path;
        // dd($items);
        $items->save();

        return redirect('/mylist')->with('success', 'Item Added Successfully');

    }


        
}

      