<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub_categories = SubCategory::with('category')->orderBy('order_by')->get();
        return view('backend.modules.sub_category.index',compact('sub_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id');
        return view('backend.modules.sub_category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());
        $request->validate([
            'name'=>'required|min:3|max:255',
            'slug'=>'required|min:3|max:255|unique:sub_categories',
            'order_by'=>'required|numeric',
            'status'=>'required',
            'category_id'=>'required',
          ]);
  
          $sub_category_data = $request->all();
           $sub_category_data['slug']= Str::slug($request->input('slug')) ;
           SubCategory::create($sub_category_data);
           session()->flash('cls', 'success');
           session()->flash('msg', 'Sub Category Created SuccessFully');
           return redirect()->route('sub-category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        $subCategory->load('category');
        return view('backend.modules.sub_category.show',compact('subCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subCategory)
    {
        $categories = Category::pluck('name', 'id');
        return view('backend.modules.sub_category.edit',compact('subCategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        $request->validate([
            'name'=>'required|min:3|max:255',
            'slug'=>'required|min:3|max:255|unique:sub_categories,slug,'.$subCategory->id,
            'order_by'=>'required|numeric',
            'status'=>'required',
            'category_id'=>'required',
          ]);

         $sub_category_data = $request->all();
         $sub_category_data['slug']= Str::slug($request->input('slug')) ;
         $subCategory->update($sub_category_data);
         session()->flash('cls', 'success');
         session()->flash('msg', 'Sub Category Updated SuccessFully');
         return redirect()->route('sub-category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subCategory)
    {
        $subCategory->delete();
      
      session()->flash('cls', 'error');
      session()->flash('msg', 'Sub Category Deleted SuccessFully');
      return redirect()->route('sub-category.index');
    }

    public function getSubCategoryByCategoryId(int $id){
      $sub_categories = SubCategory::select('id', 'name')->where('status', 0)->where('category_id', $id)->get();
      return response()->json($sub_categories);
    }
}
