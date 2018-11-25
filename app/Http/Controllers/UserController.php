<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Http\Resources\User as UserResource;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();
        
        return UserResource::collection($users);
    }
 
    public function show($id)
    {
        $User = User::findOrfail($id);
 
        return new UserResource($User);
    }
 
    public function destroy($id)
    {
        $User = User::findOrfail($id);
        
        if($User->delete()) {
            return new UserResource($User);
        } 
    }
 
    public function store(Request $request, $id = null) {
        $User = $request->isMethod('put') ? User::findOrFail($id) : new User;
            
        $User->name = $request->input('name');
        $User->email = $request->input('email');
 
        if($User->save()) {
            return new UserResource($User);
        }
    }
}