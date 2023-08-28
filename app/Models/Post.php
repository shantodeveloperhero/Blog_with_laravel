<?php

namespace App\Models;
use App\Models\Tag;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tag(){
        return $this->belongsToMany(Tag::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class)->whereNull('comment_id');
    }

    public function post_read_count()
    {
        return $this->hasOne(PostCount::class, 'post_id');
    }
}
