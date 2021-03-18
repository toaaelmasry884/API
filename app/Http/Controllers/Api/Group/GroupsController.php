<?php

namespace App\Http\Controllers\Api\Group;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

use Auth;
class GroupsController extends Controller
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
       $group = Group::get();
       return $this -> returnData('groups', $group);

        // return response()->json($group);
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
        // dd(auth()->user());

           
            // JWTAuth::setToken($token)->invalidate();
            $image=$request->file('image');
            if($request -> hasFile('image')){
                $new_name =rand().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('/uploads/images'),$new_name);
            }  
                $group = Group::create([
                    'category_id'=>$request->category_id,
                    'name'=>$request->name,
                    'about'=>$request->about,
                    'type'=>$request->type,
                    'position'=>$request->position,
                    'Created_by'=> auth()->user()->name,
                    'image'=>$new_name
                ]);
                $group->save();
                
                return $this -> returnData('groups', $group);    
                 
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
        $group = Group::find($id);
        if (!$group)
        return $this ->returnError('001','this Group not found');
        return $this -> returnData('groups', $group);

        // return response()->json($group);

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
        $group = Group::find($id);
        $group->update([
            'category_id'=>$request->category_id,
            'name'=>$request->name,
            'about'=>$request->about,
            'type'=>$request->type,
            'position'=>$request->position,
            'Created_by'=>auth()->user()->name,
            'image'=>$new_name
        ]);
        
        $group->save();
        return $this -> returnData('groups', $group);  

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
        $group =Group::find($id);
        $group ->delete();
        return $this->returnSuccessMessage('Delete group successfully');  
    }
}
