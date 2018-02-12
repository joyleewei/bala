<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;
class UsersController extends Controller{

    public function __construct(){
        $this->middleware('auth',['except'=>['show']]);
    }

    // 显示用户资料
    public function show(User $user){
        return view('users.show',compact('user'));
    }

    // 编辑用户资料
    public function edit(User $user){
        $this->authorize('update',$user);
        return view('users.edit',compact('user'));
    }



    // 更新用户资料
    public function update(UserRequest $request,User $user,ImageUploadHandler $uploader){
        $this->authorize('update',$user);

        $data = $request->all();
        if($request->avatar){
            $result = $uploader->save($request->avatar,'avatars',$user->id);
            if($result){
                $data['avatar'] = $result['path'];
            }
        }

        $user->update($data);
        return redirect()->route('users.show',$user->id)->with('success','个人资料更新成功!');
    }
}