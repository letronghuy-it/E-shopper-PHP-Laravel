<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class Membercontroller extends Controller
{
    public function createuser(Request $request){
        $data   = $request->all();
echo 11;
        var_dump($data);


        exit;



        $file   = $request->avatar;
        if (!empty($file)) {
            $data['avatar'] = $file->getClientOriginalName();
        }
        $data['level'] = 0;
        $data['password'] = bcrypt($data['password']);

        if (User::create($data)) {
            if (!empty($file)) {
                $file->move('upload/user/avatar', $file->getClientOriginalName());
            }
           return response()->json([
            'status'    => true,
            'message'   => 'Thành công',
           ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Thất bại',
               ]);
        }
    }
}
