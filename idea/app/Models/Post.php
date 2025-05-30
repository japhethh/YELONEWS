<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Categories;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'image',
        'body',
        'published_at',
        'featured',
    ];
    public function scopePublished($query)
    {
        $query->where('published_at', '<=', Carbon::now());
    }

    public function scopeWithCategory($query, string $category)
    {
       $query->whereHas('categories',function($query) use ($category){
            $query->where('slug',$category);
        });
    }


    protected $casts = [
        'published_at' => 'datetime',
    ];
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    //Comment::class = post_id
    }

    public function likes(){
        return $this->belongsToMany(User::class,'post_like')->withTimestamps();
    }

    public function scopeFeatured($query)
    {
        $query->where('featured', true);
    }
    public function scopePopular($query)
    {
        $query->withCount('likes')->orderBy('likes_count','desc');
    }
    public function scopeSearch($query,$search = ''){
        $query->where('title', 'like', "%{$search}%");
    }

    public function getExcerpt(){
        return Str::limit(strip_tags($this->body),150);
    }
    public function getReadingTime(){
         $mins =  round(str_word_count($this->body) / 250);
         return ($mins < 1)? 1:$mins;
    }

    public function getThumbnailUrl()
    {
        $isUrl = str_contains($this->image, 'https');

      return ($isUrl) ? $this->image : Storage::disk('public')->url($this->image);
    }
}
