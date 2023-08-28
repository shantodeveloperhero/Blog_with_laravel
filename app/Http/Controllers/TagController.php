<?php

namespace App\Http\Controllers;

use App\Models\tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::orderBy('order_by')->get();
        return view('backend.modules.tag.index',compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.modules.tag.create');
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
            'slug'=>'required|min:3|max:255|unique:tags',
            'order_by'=>'required|numeric',
            'status'=>'required',
          ]);
  
          $tag_data = $request->all();
           $tag_data['slug']= Str::slug($request->input('slug')) ;
           Tag::create($tag_data);
           session()->flash('cls', 'success');
           session()->flash('msg', 'Tag Created SuccessFully');
           return redirect()->route('tag.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(tag $tag)
    {
        return view('backend.modules.tag.show',compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(tag $tag)
    {
        return view('backend.modules.tag.edit',compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tag $tag)
    {
        $request->validate([
            'name'=>'required|min:3|max:255',
            'slug'=>'required|min:3|max:255|unique:tags,slug,'.$tag->id,
            'order_by'=>'required|numeric',
            'status'=>'required',
          ]);

          $tag_data = $request->all();
         $tag_data['slug']= Str::slug($request->input('slug')) ;
         $tag->update($tag_data);
         session()->flash('cls', 'success');
         session()->flash('msg', 'Tag Updated SuccessFully');
         return redirect()->route('tag.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(tag $tag)
    {
        $tag->delete();
      
      session()->flash('cls', 'error');
      session()->flash('msg', 'Tag Deleted SuccessFully');
      return redirect()->route('tag.index');
    }
}
