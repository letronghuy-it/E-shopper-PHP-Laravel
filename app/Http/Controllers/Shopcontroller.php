<?php

namespace App\Http\Controllers;

use App\Mail\Sendemailbill;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Country;
use App\Models\History;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Console\Input\Input;

class Shopcontroller extends Controller
{

    //Show Home
    public function index()
    {
        $category = Category::all();
        $brand    =    Brand::all();
        return view('Fontend.page.Home.index', compact('category', 'brand'));
    }
    // Data product
    public function loadProducts($products)
    {
        $data = [];

        foreach ($products as $product) {
            if (isset($data[$product['id']])) {
                continue;
            }

            $images = json_decode($product['image_product']);
            $image = $images[0];

            $data[$product['id']] = [
                'product' => $product,
                'image' => $image
            ];
        }

        return array_values($data);
    }
    // Load data product
    public function loadproduct(Request $request)
    {
        $products = Product::orderby('created_at', 'desc')->get()->toArray();
        $data = $this->loadProducts($products);
        return response()->json(['dataproduct' => $data]);
    }

    // Search product
    public function Searchproduct(Request $request)
    {
        $query = Product::query();
        if (isset($request->search_name)) {
            $query->where('name', 'like', '%' . $request->search_name . '%');
        }
        if (isset($request->search_price)) {
            $price_range = explode('-', $request->search_price);
            $min_price   = $price_range[0];
            $max_price = $price_range[1];
            $query->whereBetween('price', [$min_price, $max_price]);
        }
        if (isset($request->search_category)) {
            $query->where('id_category', $request->search_category);
        }

        if (isset($request->search_brand)) {
            $query->where('id_brand', $request->search_brand);
        }

        if (isset($request->key_price_slide)) {
            $price_range = $request->key_price_slide;
            $min_price = $price_range[0];
            $max_price = $price_range[1];
            $query->whereBetween('price', [$min_price, $max_price]);
        }

        $products = $query->orderBy('id')->get();
        $data = $this->loadProducts($products);

        return response()->json(['status' => true, 'data' => $data]);
    }


    // SHOW PRODUCT DETAIL
    public function productdetail($id, Request $request)
    {   $category      = Category::all();
        $brand         =    Brand::all();
        $productdetail = Product::where('products.id', $request->id)
            ->join('brands', 'products.id_brand', 'brands.id')
            ->join('categories', 'products.id_category', 'categories.id')
            ->select('products.*', 'brands.brand as brand', 'categories.category as category')
            ->first();
        return view('Fontend.page.Home.Productdetail', compact('productdetail','category','brand'));
    }

    public function Addtocart(Request $request)
    {
        $id_product  =  $request->product_id;
        $id_user     = Auth::id();
        $product     = Product::where('id', $id_product)->first()->toArray();
        if ($product) {
            if (session()->has('cart')) {
                $cart = session()->get('cart');
            } else {
                $cart = [];
            }
            //Kiểm tra id_product có tồn tại trong  mảng cart hay không nếu có tăng qty nếu chưa thêm product mới vào
            if (array_key_exists($id_product, $cart)) {
                $cart[$id_product]['quantity']++;
            } else {
                $image_product = json_decode($product['image_product'], true); //Tham số true kết quả trả về dưới dạng một mảng chứ không phải là một đối tượng
                $first_image = $image_product[0];  //lấy ảnh đầu tiên của mảng
                $cart[$id_product] = [
                    'image'    => $first_image,
                    'id_user'  => $id_user,
                    'name'     => $product['name'],
                    'price'    => $product['price'],
                    'quantity' => 1
                ];
            }
            //cập nhật lại cart
            session()->put('cart', $cart);
            // tính tổng qty
            $totalQuantity = array_sum(array_column($cart, 'quantity'));
            //cập nhật lại qty
            session()->put('totalQuantity', $totalQuantity);
            return response()->json([
                'status'    => true,
                'message'   => 'Thêm Mới thành công',
                'totalqty' =>  $totalQuantity
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Không có Product',
            ]);
        }
    }

    public function indexCart()
    {
        $getcart = session()->get('cart');
        return view('Fontend.page.Home.cart', compact('getcart'));
    }

    public function loadDatacart()
    {   //Lấy cart hiện tại
        $getcart = session()->get('cart');
        $getproduct = Product::all();
        //Tổng giá tiền
        $totalprice = 0;
        if (isset($getcart)) {
            foreach ($getcart as $product) {
                $totalprice += $product['price'] * $product['quantity'];
            }
        }
        //tổng Quantity
        $totalQuantity = array_sum(array_column($getcart, 'quantity'));
        return response()->json([
            'status'      => true,
            'getcart'     => $getcart,
            'totalprice'  => $totalprice,
            'totalqty'    =>  $totalQuantity,
            'getproduct'  => $getproduct
        ]);
    }

    public function ActioninCart(Request $request)
    {
        // Lấy cart hiện tại trong session
        $getcart = session()->get('cart');
        $action = $request->action;
        // lấy key của product
        $keyproduct = $request->key_product;
        if (isset($getcart[$keyproduct])) {
            switch ($action) {
                case 'delete':
                    unset($getcart[$keyproduct]);
                    $totalQuantity = array_sum(array_column($getcart, 'quantity'));
                    //cập nhật lại qty
                    session()->put('totalQuantity', $totalQuantity);
                    session()->put('cart', $getcart);
                    break;
                case 'cart_quantity_up':
                    if (isset($getcart)) {
                        $getcart[$keyproduct]['quantity']++;
                    }
                    $totalQuantity = array_sum(array_column($getcart, 'quantity'));
                    //cập nhật lại qty
                    session()->put('totalQuantity', $totalQuantity);
                    session()->put('cart', $getcart);
                    break;
                case 'cart_quantity_down':
                    if (isset($getcart)) {
                        $getcart[$keyproduct]['quantity']--;
                    }
                    if ($getcart[$keyproduct]['quantity'] < 1) {
                        unset($getcart[$keyproduct]);
                    }
                    $totalQuantity = array_sum(array_column($getcart, 'quantity'));
                    //cập nhật lại qty
                    session()->put('totalQuantity', $totalQuantity);
                    session()->put('cart', $getcart);
                    break;
                default:
                    return response()->json([
                        'status'    => false,
                        'message'   => 'Lỗi hệ thống'
                    ]);
                    break;
            }
            return response()->json([
                'status'    => true,
                'getcart'   => $getcart,
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Lỗi Hệ thống'
            ]);
        }
    }

    public function Checkout()
    {
        $country = Country::all();
        $getcart = session()->get('cart');

        //Lấy id_user
        $product     = Product::all()->toArray();
        $get_id_user =  $product[0]['id_user'];

        // Tính tổng tiền
        $totalprice = 0;
        if (isset($getcart)) {
            foreach ($getcart as $product) {
                $totalprice += $product['price'] * $product['quantity'];
            }
        }
        return view('Fontend.page.Home.checkout', compact('country', 'getcart', 'totalprice', 'get_id_user'));
    }
    public function Oder(Request $request)
    {
        $getcart = session()->get('cart');
        $userId  = Auth::id();
        $member  = User::where('id', $userId)->first()->toArray();
        // Get id_user
        $product = Product::all()->toArray();
        $get_id_user =  $product[0]['id_user'];

        // Tính tổng tiền
        $totalprice = 0;
        if (isset($getcart)) {
            foreach ($getcart as $product) {
                $totalprice += $product['price'] * $product['quantity'];
            }
        }
        //data send to email
        $data = [
            'cart'          => $getcart,
            'member'        => $member,
            'totalprice'    => $totalprice,
            'get_id_user'   => $get_id_user
        ];

        //history member buy product
        $history = [
            'email'     => $member['email'],
            'phone'     => $member['phone'],
            'name'      => $member['name'],
            'id_user'   => $member['id'],
            'price'     => $totalprice
        ];
        if (!empty($getcart)) {
            Mail::to($member['email'])->send(new Sendemailbill($data));
            History::create($history);
            session()->forget('cart');
            session()->forget('totalQuantity');
            return response()->json([
                'status'    => true,
                'message'   => 'Bạn đã đặt thành công đơn hàng vui lòng kiểm tra Email',
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Lỗi hệ thống',
            ]);
        }
    }
    public function PageShop(Request $request){
        $category = Category::all();
        $brand    =    Brand::all();
        return view('Fontend.page.Home.shop',compact('category', 'brand'));
    }
    // session()->has('cart'): kiem tra co SS k
    // session()->get('cart');  lấy SS ra
    // session()->put('cart',$getSession); update 1 cái
    // session()->push('cart',$array); dua 1 mang vao SS

}
