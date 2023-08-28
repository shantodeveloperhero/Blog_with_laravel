<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Http\Controllers\PhotoUploadController;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if (Auth::user()->role == User::USER) {
            $posts = Post::with('category', 'sub_category', 'user', 'tag')->where('user_id', Auth::id())->latest()->paginate(20);
        } else{
            $posts = Post::with('category', 'sub_category', 'user', 'tag')->latest()->paginate(20);
        }
        
        return view('backend.modules.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status', 0)->pluck('name', 'id');
        $tags = Tag::where('status', 0)->select('name', 'id')->get();
        return view('backend.modules.post.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request)
    {

        $post_data = $request->except(['tag_ids', 'photo', 'slug']);
        $post_data['slug'] = Str::slug($request->input('slug'));
        $post_data['user_id'] = Auth::user()->id;
        

        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $name = Str::slug($request->input('slug'));
            $height = 400;
            $width = 1000;
            $thumb_height = 150;
            $thumb_width = 300;
            $path = 'image/post/original/';
            $thumb_path = 'image/post/thumbnail/';

            $post_data['photo'] = PhotoUploadController::imageUpload($name, $height, $width, $path, $file);
            PhotoUploadController::imageUpload($name, $thumb_height, $thumb_width, $thumb_path, $file);
        }

        $post = Post::create($post_data);
        $post->tag()->attach($request->input('tag_ids'));

        session()->flash('cls', 'success');
         session()->flash('msg', 'Post Created SuccessFully');
         return redirect()->route('post.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if (Auth::user()->role == User::USER && $post->user_id != Auth::id()) {
            abort(403, 'Unauthorized');
        }
        $post->load(['category', 'sub_category', 'user', 'tag']);
        return view('backend.modules.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::where('status', 0)->pluck('name', 'id');
        $tags = Tag::where('status', 0)->select('name', 'id')->get();
        $selected_tags = DB::table('post_tag')->where('post_id', $post->id)->pluck('tag_id', 'id')->toArray();
        return view('backend.modules.post.edit', compact('post', 'categories', 'tags', 'selected_tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        $post_data = $request->except(['tag_ids', 'photo', 'slug']);
        $post_data['slug'] = Str::slug($request->input('slug'));
        $post_data['user_id'] = Auth::user()->id;
        

        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $name = Str::slug($request->input('slug'));
            $height = 400;
            $width = 1000;
            $thumb_height = 150;
            $thumb_width = 300;
            $path = 'image/post/original/';
            $thumb_path = 'image/post/thumbnail/';
            PhotoUploadController::ImageUnlink($path, $post->photo);
            PhotoUploadController::ImageUnlink($thumb_path, $post->photo);


            $post_data['photo'] = PhotoUploadController::imageUpload($name, $height, $width, $path, $file);
            PhotoUploadController::imageUpload($name, $thumb_height, $thumb_width, $thumb_path, $file);
        }

        $post->update($post_data);
        $post->tag()->sync($request->input('tag_ids'));
        session()->flash('cls', 'success');
         session()->flash('msg', 'Post Updated SuccessFully');
         return redirect()->route('post.index');
    }

    public function pending()
    {
       $posts = Post::where('is_approved',0)->get();
       
       return view('backend.modules.post.pending', compact('posts'));
    }
    public function approval ($id)
    {
        $post = Post::find($id);
        if ($post->is_approved == 0) {
            $post->update(['is_approved' =>1]);
            
        }
    
        session()->flash('cls', 'error');
      session()->flash('msg', 'Post Upload SuccessFully');
      return redirect()->route('post.index');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
      
      session()->flash('cls', 'error');
      session()->flash('msg', 'Post Deleted SuccessFully');
      return redirect()->route('post.index');
    }
}
