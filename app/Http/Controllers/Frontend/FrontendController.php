<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PostCountController;

class FrontendController extends Controller
{
    public function index()
    {
        
       $posts = Post::with('category', 'sub_category', 'tag', 'user')->where('is_approved', 1)->where('status', 1)->latest()->take(5)->get();
       $slider_posts = Post::with('category', 'tag', 'user')->where('is_approved', 1)->where('status', 1)->inRandomOrder()->take(6)->get();
        return view('frontend.layouts.includes.modules.index', compact('posts','slider_posts'));
    }

    public function single($slug)
    {
        $post = Post::with('category', 'sub_category', 'tag', 'user', 'comment', 'comment.user', 'comment.replay', 'post_read_count')
                    ->where('is_approved', 1)
                    ->where('status', 1)
                    ->where('slug', $slug)
                    ->firstOrFail();
                    
        return view('frontend.layouts.includes.modules.single', compact('post'));
    }

    public function all_post()
    {
        $posts = Post::with('category', 'sub_category', 'tag', 'user')->where('is_approved', 1)->where('status', 1)->latest()->Paginate(10);
        $title = 'All Post';
        $sub_title = 'View All List Post';
         return view('frontend.layouts.includes.modules.all-post', compact('posts', 'title', 'sub_title'));
    }

    public function search(Request $request)
    {
        $posts = Post::with('category', 'sub_category', 'tag', 'user')
                ->where('is_approved', 1)
                ->where('status', 1)
                ->where('title', 'like', '%'.$request->input('search').'%')
                ->latest()
                ->Paginate(10);
                $title = 'View Search Result';
                $sub_title = $request->input('search');
        return view('frontend.layouts.includes.modules.all-post', compact('posts', 'title', 'sub_title'));
    }

    public function category($slug){
        $category = Category::where('slug', $slug)->first();
        if ($category) {
            $posts = Post::with('category', 'sub_category', 'tag', 'user')
            ->where('is_approved', 1)
            ->where('status', 1)
            ->where('category_id', $category->id)
            ->latest()
            ->Paginate(10);
        }
        $title = $category->name;
        $sub_title = 'Post By Category';
        return view('frontend.layouts.includes.modules.all-post', compact('posts', 'title', 'sub_title'));
    }

    public function sub_category($slug, $sub_slug){
        $sub_category = SubCategory::where('slug', $sub_slug)->first();
        if ($sub_category) {
            $posts = Post::with('category', 'sub_category', 'tag', 'user')
            ->where('is_approved', 1)
            ->where('status', 1)
            ->where('sub_category_id', $sub_category->id)
            ->latest()
            ->Paginate(10);
        }
        $title = $sub_category->name;
        $sub_title = 'Post By Sub Category';
        return view('frontend.layouts.includes.modules.all-post', compact('posts', 'title', 'sub_title'));
    }

    public function tag($slug){
        $tag = Tag::where('slug', $slug)->first();

        $post_ids = DB::table('post_tag')->where('tag_id', $tag->id)->distinct('post_id')->pluck('post_id');

        if ($tag) {
            $posts = Post::with('category', 'sub_category', 'tag', 'user')
            ->where('is_approved', 1)
            ->where('status', 1)
            ->whereIn('id', $post_ids)
            ->latest()
            ->Paginate(10);
        }
        $title = $tag->name;
        $sub_title = 'Post By Tag';
        return view('frontend.layouts.includes.modules.all-post', compact('posts', 'title', 'sub_title'));
    }

    final public function contact_us()
    {
        return view('frontend.layouts.includes.modules.contact_us');
    }

    final public function postReadCount($post_id)
    {
        $postCount = new PostCountController($post_id);
        $postCount->postReadCount();
        //(new PostCountController($post->id))->postReadCount();
    }

    
}
