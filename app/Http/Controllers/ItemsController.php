<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = \App\Models\Items::all()->sortBy('item');
        return view('items.indexitem')->with('items', $items);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //TO LINK THEM (for later): follow along with what CompanyController does with its index return view. It has a with example.
        $categories = \App\Models\categories::all();
        return view('items.createitem')->with ('categories', $categories);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //desc, price, quantity, and picture do not need to be unique... so the tag for it was removed. they are, however, all required.
        $rules = [
            'category_id' => 'required|max:50|unique:items,category_id',
            'title' => 'required|max:50|unique:items,title',
            'description' => 'required|max:150',
            'price' => 'required|max:50',
            'quantity' => 'required|max:50',
            'sku' => 'required|max:50|unique:items,sku',
            'picture' => 'required|image|max:2048'
        ];
        //Picture (research one) checks to see if the format is an image and if it is 2mb or lower.
        $validator = $this->validate($request, $rules); 

        //Research -- part for PICTURE.
        $target = null;
        if ($request->hasFile('picture') && $request->file('picture')->isValid()) {
            $target = $request->file('picture')->store('images', 'public');
        }

        $item = new \App\Models\Items();
        $item->category_id = $request->category_id;
        $item->title = $request->title;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->quantity = $request->quantity;
        $item->sku = $request->sku;
        $item->picture = $target;
        
        $item->save();
        //RESEARCH PART ---- PICTURES
        
        Session::flash('success', 'A new category has been created');

        
        return redirect()->route('items.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $items = \App\Models\Items::find($id);
        if (!$items) dd("Item Wasn't found");

        $categories = \App\Models\categories::all();
  

        return view('items.edititem')->with('item', $items)->with('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $items = \App\Models\Items::find($id);
        if (!$items) {
            Session::flash('error', 'No Item found.');
        } else {
            $items->delete();
            Session::flash('success in deletion', 'Item is now gone');
        }
        return redirect()->route('items.index');
        
    }
}
