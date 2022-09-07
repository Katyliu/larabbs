<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Handlers\ImageUploadHandler;
use Illuminate\Support\Facades\File;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    public function update(UserRequest $request, ImageUploadHandler $uploader, User $user)
    {
        $this->authorize('update', $user);
        $data = $request->all();
        if($request->avatar){
            $result = $uploader->save($request->avatar, 'avatars', $user->id, 416);
            if($result){
                $data['avatar'] = $result['path'];
            }
            //删除旧的图片
            $old_path = public_path().str_ireplace(config('app.url'), '', $user->avatar);
            if (File::exists($old_path)) {
                File::delete($old_path);
            }
        }

        $user->update($data);

        return redirect()->route('users.show', $user->id)->with('success', '个人资料更新成功！');
    }


}
