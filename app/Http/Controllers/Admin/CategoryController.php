<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderByDesc('id')->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate
        $request->validate([
            'name_en' | 'required',
            'name_ar' | 'required'
        ]);

        //store file

        $img_name = 'no-image.png';
        if ($request->hasFile('image')) {
            $img_name = rand() . time() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/categories'), $img_name);
        }

        //store in db

        Category::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'image' => $img_name,
            'parent_id' => $request->parent_id
        ]);

        //redirect

        return redirect()->route('admin.categories.index')->with('msg', 'Category added successfully')->with('type', 'success');
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
        //
    }
}
