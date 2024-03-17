<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AddproductRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class Membercontroller extends Controller
{
    public function createuser(RegisterRequest $request)
    {
        $data   = $request->all();
        $file   = $request->avatar;
        if (!empty($file)) {
            $data['avatar'] = $file->getClientOriginalName();
        }
        $data['level'] = 0;
        $data['password'] = bcrypt($data['password']);

        if ($getuser = User::create($data)) {
            if (!empty($file)) {
                $file->move('upload/user/avatar', $file->getClientOriginalName());
            }
            return response()->json([
                'status'    => 200,
                'message'   => 'Thành công',
                'user'   =>   $getuser
            ], 200);
        } else {
            return response()->json([
                'status'    => 500,
                'message'   => 'Thất bại',
            ], 500);
        }
    }

    public function actionLogin(Request $request)
    {
        $login = [
            'email'     => $request->email,
            'password'  => $request->password,
            'level'     => 0
        ];
        $remember = true;
        if ($request->remember_me) {
            $remember = true;
        }
        if (Auth::attempt($login, $remember)) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json(
                [
                    'success' => 'success',
                    'token' => $token,
                    'Auth' => Auth::user()
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'response' => 'error',
                    'errors' => ['errors' => 'invalid email or password'],
                ],
                500
            );
        }
    }
    public function store(AddproductRequest $request)
    {
        $data   =  $request->all();
        $files  =  $request->file('image_product');
        $filenames = [];

        //id user
        $userId = Auth::id();

        //Nối Đường dẫn có id_user của người thêm sản phẩm
        $userDirectory = 'upload/user/' . $userId . '/image_product';

        //Kiểm tra xem file có tồn tại hay không
        if (!file_exists($userDirectory)) {

            mkdir($userDirectory, 0755, true);
        }

        if (is_array($files)) {
            foreach ($files as $file) {
                $filename = $file->getClientOriginalName();
                $file->move($userDirectory, $filename);

                $img = Image::make($userDirectory . '/' . $filename);
                $img->save($userDirectory . '/1_' . $filename);
                $img->save($userDirectory . '/2_' . $filename);
                $filenames[] = $filename;
            }
        } else {
            $filename = $files->getClientOriginalName();
            $files->move($userDirectory, $filename);

            $img = Image::make($userDirectory . '/' . $filename);
            $img->save($userDirectory . '/1_' . $filename);
            $img->save($userDirectory . '/2_' . $filename);

            $filenames[] = $filename;
        }
        // Chuyển mảng tên tệp thành chuỗi JSON
        $data['image_product'] = json_encode($filenames);

        if ($product = Product::create($data)) {
            return response()->json([
                'response' => 'success',
                'data' => $product
            ], 200);
        } else {
            return response()->json(
                [
                    'response' => 'error',
                    'errors' => ['errors' => 'invalid email or password'],
                ],
                500
            );
        }
    }
    public function myProduct(Request $request){
        $userId    = Auth::id();
        $myproduct = Product::where('id_user', $userId)->get();

        return response()->json([
            'status'    => 200,
            'data'   => $myproduct,
        ],200);
    }
}
