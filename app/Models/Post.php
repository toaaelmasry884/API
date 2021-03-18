<?php

namespace App\Models;
use App\Models\Group;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $table = 'posts';
    protected $fillable = [
        'title',
        'content',
        'image',
        'video',
        'comment',
        'content_url', 
        'view_number',
        'user_id', 
        'group_id', 
        'react'
    ];

    public function group(){
        return $this->belongsTo(Group::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
