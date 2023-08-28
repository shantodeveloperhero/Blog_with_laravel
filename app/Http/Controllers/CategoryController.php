<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Support\Str;
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
        $categories = Category::orderBy('order_by')->get();
        return view('backend.modules.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.modules.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
          'name'=>'required|min:3|max:255',
          'slug'=>'required|min:3|max:255|unique:categories',
          'order_by'=>'required|numeric',
          'status'=>'required',
        ]);

        $category_data = $request->all();
         $category_data['slug']= Str::slug($request->input('slug')) ;
         Category::create($category_data);
         session()->flash('cls', 'success');
         session()->flash('msg', 'Category Created SuccessFully');
         return redirect()->route('category.index');
        
        //Category::create([
           // 'name' => $request->name,
            //'slug' => strtolower(str_replace(' ','-',$request->name)),
            //'order_by'=>$request->order_by,
            //'status'=>$request->status

        //]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('backend.modules.category.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('backend.modules.category.edit',compact('category'));
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

        $request->validate([
            'name'=>'required|min:3|max:255',
            'slug'=>'required|min:3|max:255|unique:categories,slug,'.$category->id,
            'order_by'=>'required|numeric',
            'status'=>'required',
          ]);

          $category_data = $request->all();
         $category_data['slug']= Str::slug($request->input('slug')) ;
         $category->update($category_data);
         session()->flash('cls', 'success');
         session()->flash('msg', 'Category Updated SuccessFully');
         return redirect()->route('category.index');

       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
      $category->delete();
      
      session()->flash('cls', 'error');
      session()->flash('msg', 'Category Deleted SuccessFully');
      return redirect()->route('category.index');

    }
}
