<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(5);
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:100', 
                'slug' => 'required|string|unique:categories,slug', 
            ]
        );

        if($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
        // proses insert category
        try {
            Category::create([
                'name' => $request->name,
                'slug' => $request->slug
            ]);
            Alert::success('Add Category', 'Success');
            return redirect()->route('categories.index');
        } catch (\Throwable $th) {
            Alert::error('Add Category', 'Error' . $th->getMessage());
            return redirect()->back()->withInput($request->all());
        }
        // dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:100', 
                'slug' => 'required|string|unique:categories,slug,'. $category->id, 
            ]
        );

        if($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        // proses insert category
        try {
            $category->update([
                'name' => $request->name,
                'slug' => $request->slug
            ]);
            Alert::success('Update Category', 'Success');
            return redirect()->route('categories.index');
        } catch (\Throwable $th) {
            Alert::error('Update Category', 'Error' . $th->getMessage());
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            Alert::success('Delete Category', 'Success');
        } catch (\Throwable $th) {
            Alert::error('Delete Category', 'Error' . $th->getMessage());
        }
        return redirect()->back();
    }
}
