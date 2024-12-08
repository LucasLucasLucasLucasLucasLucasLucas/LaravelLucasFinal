<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = \App\Models\categories::all()->sortBy('category');
        return view('categories.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'category_name' => 'required|max:50|unique:categories,category_name'
        ];
        $validator = $this->validate($request, $rules);

        $category = new \App\Models\categories();
        $category->category_name = $request->category_name;
        $category->save();
        
        Session::flash('success', 'A new category has been created');

        
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = \App\Models\Categories::find($id);
        if (!$category) dd("Category Wasn't found");

        return view('categories.edit')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'category_name' => 'required|max:50|unique:categories,category_name'
        ];
        $validator = $this->validate($request, $rules);
        $category = \App\Models\Categories::find($id);
        if (!$category) dd("no category found");

        $category->category_name = $request->category_name;
        $category->save();

        Session::flash('success', 'The category has been updated! ');

        
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        /*
        $category = \App\Models\Categories::find($id);
        if (!$category) {
            Session::flash('error', 'No Category found.');
        } else {
            $category->delete();
            Session::flash('success in deletion', 'Category is now gone');
        }
        return redirect()->route('categories.index');
        */
    }
    /*
    public function categoryDelete(string $id){ }
   */
}
