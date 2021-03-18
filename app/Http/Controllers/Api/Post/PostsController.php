<?php

namespace App\Http\Controllers\Api\Post;
use App\Models\Post;
use App\Models\Like;
use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    use GeneralTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       $posts = Post::all();
    //    return response()->json($posts);
       return $this -> returnData('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // try{
        //     $rules =[
        //         "image" => "required|string",
        //         "title" => "required",
        //         "content" => "required",
        //         "user_id" => "required|unique:users"
        //     ];
        //     $validator = Validator::make($request->all(), $rules);
        //      //register

        //      if ($validator->fails()) {
        //         return $this->returnValidationError('e001',$validator);
                   
        //      }
        //      else {
        //      $newuser = new Post;
        //      $newuser -> name = request('name');
        //      $newuser -> email = request('email');
        //      $newuser -> password = bcrypt(request('password'));
        //      $newuser -> phone = request('phone');

             
        //      $newuser -> save();
        //      return $this -> returnData('user successful register', $newuser);
        //      }
        // }catch(\Exception $ex){
        //     return $this -> returnError($ex->getCode(), $ex->getMessage());
        // } 
        





        $image=$request->file('image');
        if($request -> hasFile('image')){
            $new_name =rand().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('/uploads/images'),$new_name);
        }
        // $image =$request->file('image')->move(public_path('/'));
        // $photoUrl = url('',$image);
        $posts = Post::create([
        'title'=>$request->title,
        'content'=>$request->content,
        
        // 'position'=>$request->position,
        'user_id'=>$request->user_id,
        'group_id'=>$request->group_id,
        'image'=>$new_name,
        // 'video'=>$video
    ]);

    $posts->save();
    // $posts = posts::all();
       return $this -> returnData('posts', $posts);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $posts = Post::find($id);
        if (!$posts)
        return $this ->returnError('001','this Post not found');
        return $this -> returnData('posts', $posts);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $image=$request->file('image');
        if($request -> hasFile('image')){
            $new_name =rand().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('/uploads/images'),$new_name);
        }
        $post = Post::find($id);
        $post->update([
            'title'=>$request->title,
            'content'=>$request->content,
        
            'position'=>$request->position,
            // 'user_id'=>$request->user_id,
            // 'group_id'=>$request->group_id,
            'image'=>$new_name,
        ]);
        $post->save();
        return $this -> returnData('posts', $post);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post =Post::find($id);
        $post ->delete();
        return $this->returnSuccessMessage('Delete post successfully');     

    }

    public function like(){
        $posts = Post::all();
        return view('post.post',compact('posts'));
    }
}
