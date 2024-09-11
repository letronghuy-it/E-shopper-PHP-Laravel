<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\updateUser;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Termwind\Components\Dd;

class Usercontroller extends Controller
{

    public function indexprofile()
    {
        $country = Country::all();
        return view('user.Profileuser.Profile', compact('country'));
    }
    public function update(UpdateUserRequest $request)
    {
        $userId = Auth::id();
        $user   = User::findOrFail($userId);
        $data   = $request->all();
        $file   = $request->avatar;
        if(!empty($file)){
            $data['avatar'] = $file->getClientOriginalName();
        }

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }
        if ($user->update($data)) {
            if(!empty($file)){
                $file->move('upload/user/avatar',$file->getClientOriginalName());
            }
            return redirect()->back()->with('success', 'Update profile success');
        } else {
            return redirect()->back()->withErrors('Update profile error');
        }
    }


    // public function edit($id){
    //     $user = Auth::user();
    //     if($user && $user->id == $id){
    //         return view('user.Profileuser.Profile', compact('user'));
    //     } else {
    //         return redirect()->back()->with('error', 'User KHông có ');
    //     }
    // }



}
