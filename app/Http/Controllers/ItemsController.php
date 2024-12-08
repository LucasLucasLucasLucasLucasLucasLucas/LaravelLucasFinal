<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

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
        $items = \App\Models\Items::all();
        return view('items.createitem')->with ('items', $items)->with('categories', $categories);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //desc, price, quantity, and picture do not need to be unique... so the tag for it was removed. they are, however, all required.
        $rules = [
            'category_id' => 'required|max:50|',
            'title' => 'required|max:50|unique:items,title',
            'description' => 'required|max:150',
            'price' => 'required|max:50',
            'quantity' => 'required|max:50',
            'sku' => 'required|max:50|unique:items,sku',
            'picture' => 'required|image|max:2048|unique:items,picture'
        ];
        //Picture (research one) checks to see if the format is an image and if it is 2mb or lower.
        $validator = $this->validate($request, $rules); 

        //RESEARCH PART---------------------------------------------------------------------------------------------------------
        $target = null;
        if ($request->hasFile('picture') && $request->file('picture')->isValid()) {
            //gets original file name like kitty.png
            $filename = $request->file('picture')->getClientOriginalName();
            $pathForFile = public_path('images/' . $filename);

            //checks if the image exists
            if (file_exists($pathForFile)) {
                Session::flash('error', 'The image you have selected is already in the db');
                return redirect()->route('items.create')->withInput();
            } else {
                //this will execute if the file didn't already exist. the if above returns a redirect to back meaning this part won't be executed.
                $request->file('picture')->move(public_path('images'), $filename);
                $target = 'images/' . $filename;
            }

            
        }
        //----------------------------------------------------------------------------------------------------------------------

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
        $rules = [
            'category_id' => 'required|max:50|unique:items,category_id'.$id,
            'title' => 'required|max:50|unique:items,title'.$id,
            'description' => 'required|max:150',
            'price' => 'required|max:50',
            'quantity' => 'required|max:50',
            'sku' => 'required|max:50|unique:items,sku'.$id,
            'picture' => 'required|image|max:2048|unique:items,picture'.$id
        ];
        
        $validator = $this->validate($request, $rules); 
        $item = \App\Models\Items::find($id);
        if (!$item) dd("no category found");

        //RESEARCH PART---------------------------------------------------------------------------------------------------------
        $target = null;
        if ($request->hasFile('picture') && $request->file('picture')->isValid()) {
            //gets original file name like kitty.png
            $filename = $request->file('picture')->getClientOriginalName();
            $pathForFile = public_path('images/' . $filename);

            //checks if the image exists
            if (file_exists($pathForFile)) {
                Session::flash('error', 'The image you have selected is already in the db');
                return redirect()->back();
            }

            //this will execute if the file didn't already exist. the if above returns a redirect to back meaning this part won't be executed.
            $request->file('picture')->move(public_path('images'), $filename);
            $target = 'images/' . $filename;
        }
        //----------------------------------------------------------------------------------------------------------------------
        

        $item->category_id = $request->category_id;
        $item->title = $request->title;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->quantity = $request->quantity;
        $item->sku = $request->sku;
        $item->picture = $target;
        
        $item->save();
        
        
        Session::flash('success', 'A new category has been created');

        
        return redirect()->route('items.index');
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
            //RESEARCH PART ------------------------------------------------------
            $imagePath = public_path($items->picture);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            //--------------------------------------------------------------------
            $items->delete();
            Session::flash('success in deletion', 'Item is now gone');
        }
        return redirect()->route('items.index');
        
    }
    public function itemsDelete(string $id) {
        Session::flash('js_message', 'hi');
    }
}
