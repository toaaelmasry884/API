<?php

namespace App\Models;
use App\Models\Group;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table= 'categories';
    protected $fillable = [
        'name', 
        'subtitle', 
        'image'
    ];

    // public function group(){
    //     return $this->belongsTo(Group::class);
    // }
}
