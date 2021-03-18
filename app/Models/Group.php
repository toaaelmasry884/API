<?php

namespace App\Models;
use App\Models\Post;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
    protected $table ="groups";
    protected $fillable = [
        'category_id', 
        'name',
        'about',
        'type',
        'position',
        'image', 
        'group_url', 
        'active',
        'Created_by'
    ];

    // public function post(){
    //     return $this->hasMany(Post::class);
    // }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
