<?php

namespace App\Http\Controllers;

use App\Http\Requests\UAT\registerRequest;
use App\Http\Requests\User\addproduct;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Country;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;


use PhpParser\Node\Stmt\Return_;

class Membercontroller extends Controller
{

    //Show Page Register
    public function indexregister()
    {
        $country = Country::all();
        return view('Fontend.page.UAT.Register.indexregister', compact('country'));
    }
    //Show Page Login
    public function indexLogin()
    {
        return view('Fontend.page.UAT.Login.indexLogin');
    }
    //  Register
    public function createuser(registerRequest $request)
    {
        $data   = $request->all();
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
            return redirect('/shop/login-user')->with('success', _('Bạn đã Đăng kí thành công!'));
        } else {
            return redirect('/shop/login-user')->with('success', _('Bạn đã Đăng kí thành công!'));
        }
    }
    //  Login
    public function ActionLogin(Request $request)
    {
        $login = [
            'email'    => $request->email,
            'password' => $request->password,
            'level'    => 0
        ];
        $remember = false;
        if ($request->remember_me) {
            $remember = true;
        }
        if (Auth::attempt($login, $remember)) {
            session()->put('Islogin', true);
            return redirect('/shop');
        } else {
            return redirect()->back()->withErrors('Tài Khoản Hoặc Mật khẩu chưa chính xác');
        }
    }
    // LogOut
    public function ActionLogout(Request $request)
    {
        // Xóa session
        Auth::logout();
        $request->session()->forget('Islogin');
        return redirect('/shop/login-user');
    }

    // Account Member
    public function IndexAccount()
    {
        $country = Country::all();
        return view('Fontend.page.Account.UpdateMemberFE', compact('country'));
    }


    // Update Account Member
    public function UpdateAccount(UpdateUserRequest $request)
    {
        $userId = Auth::id();
        $user   = User::findOrFail($userId);
        $data   = $request->all();
        $file   = $request->avatar;
        if (!empty($file)) {
            $data['avatar'] = $file->getClientOriginalName();
        }

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            $data['password'] = $user->password;
        }
        if ($user->update($data)) {
            if (!empty($file)) {
                $file->move('upload/user/avatar', $file->getClientOriginalName());
            }
            return redirect()->back()->with('success', 'Update profile success');
        } else {
            return redirect()->back()->withErrors('Update profile error');
        }
    }

    // Show Index ADD-PRODUCT
    public function IndexAddproduct()
    {
        $category =  Category::all();
        $brand    = Brand::all();
        return view('Fontend.page.Account.Addproduct', compact('category', 'brand'));
    }

    // ADD PRODUCT
    public function Addproduct(addproduct $request)
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

        if (Product::create($data)) {
            return redirect()->back()->with('success', _('Thêm Mới Thành Công'));
        } else {
            return redirect()->back()->withErrors('success', _('Thêm Mới Thất bại'));
        }
    }

    //My-product
    public function Myproduct(Request $request)
    {
        $userId    = Auth::id();
        $myproduct = Product::where('id_user', $userId)->get();
        return view('Fontend.page.Account.Myproduct', compact('myproduct'));
    }

    // Delete-Product
    public function destroyProduct(Request $request)
    {
        $product = Product::find($request->id);
        if ($product) {
            $product->delete();
            return redirect()->back()->with('success', _('Xoá Thành Công Sản Phẩm'));
        } else {
            return redirect()->back()->withErrors('success', _('Sản phẩm không tồn tại'));
        }
    }
    // Edit product
    public function EditProduct(Request $request)
    {
        $product = Product::find($request->id);
        $category = Category::all();
        $brand    = Brand::all();
        if ($product) {
            return view('Fontend.page.Account.Editproduct', compact('product', 'category', 'brand'));
        } else {
            return redirect()->back()->withErrors('success', _('Không Tìm Thấy Blog'));
        }
    }
    public function UpdateProduct($id, Request $request)
    {
        $data = $request->all();
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

        if ($files) {
            if (is_array($files)) {
                foreach ($files as $file) {
                    if ($file) {
                        $filename = $file->getClientOriginalName();
                        $file->move($userDirectory, $filename);

                        $img = Image::make($userDirectory . '/' . $filename);
                        $img->save($userDirectory . '/1_' . $filename);
                        $img->save($userDirectory . '/2_' . $filename);
                        $filenames[] = $filename;
                    }
                }
            } else {
                if ($files) {
                    $filename = $files->getClientOriginalName();
                    $files->move($userDirectory, $filename);

                    $img = Image::make($userDirectory . '/' . $filename);
                    $img->save($userDirectory . '/1_' . $filename);
                    $img->save($userDirectory . '/2_' . $filename);

                    $filenames[] = $filename;
                }
            }
        }
        $data['image_product'] = json_encode($filenames); // Chuyển Lại Mảng = json;

        //Lấy mảng củ
        $product = Product::where('id', $id)->first();
        //mảng củ để so sánh
        $arrimage = json_decode($product['image_product'], true); // Chuyển Lại json = Mảng;

        //Mảng ảnh để xoá
        $Del_image = $request->removeimage;
        if (!empty($Del_image)) {
            foreach ($Del_image as $key => $value) {
                //Check xem giá trị mảng cần xoá có trong mảng không
                if (in_array($value, $arrimage)) {
                    //unset key mảng ảnh muốn xoá
                    unset($arrimage[$key]);
                }
            }
            // Trả về mảng liên tục sau khi unset
            $arrimage = array_values($arrimage);
        }

        // Gộp mảng chứa ảnh
        $mergedArray = array_merge($arrimage, $filenames);

        // Kiểm tra số lượng ảnh
        if (count($mergedArray) < 1 || count($mergedArray) > 3) {
            return redirect()->back()->withErrors(['error' => _('Số lượng ảnh phải lớn hơn 1 và nhỏ hơn 3')]);
        }

        // Cập nhật lại mảng ảnh sau khi xoá và thêm
        $data['image_product'] = json_encode($mergedArray);
        $product->save();

        if ($product->update($data)) {
            return redirect()->back()->with('success', _('Cập nhật sản phẩm thành công'));
        } else {
            return redirect()->back()->withErrors('success', _('Cập Nhật thất bại'));
        }
    }
    //Search-Product
    public function SearchProduct(Request $request)
    {
        $data = Product::where('name', 'like', '%' . $request->key_search . '%')->get();

        return response()->json([
            'status'  => 200,
            'message' => 'Tìm Kiếm Thành Công!',
            'data'    => $data
        ]);
    }
}
