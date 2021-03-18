<?php

namespace App\Http\Controllers\Api\Category;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    use GeneralTrait;
    public function index()
    {
        //select('id','name'.app() -> getLocale() .' as name')->
       $categories = Category::get();
       return $this -> returnData('categories', $categories);


    }
    public function CategoryById($id)
    {

        //selection()->
        $category = Category::find($id);
        if (!$category)
        return $this ->returnError('001','this category not found');
        return $this -> returnData('category', $category);
        
    }
    
}
