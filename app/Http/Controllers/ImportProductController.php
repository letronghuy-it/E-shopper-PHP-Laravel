<?php

namespace App\Http\Controllers;

use App\Models\DetailImportProduct;
use App\Models\ImportProduct;
use App\Models\InvoiceDetail;
use App\Models\Product;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImportProductController extends Controller
{

    public function viewImportProduct()
    {
        $supplier = Supplier::all();
        return view('user.ImportProduct.viewImport', compact('supplier'));
    }

    public function LoadDataProduct()
    {
        $data = Product::all();
        return response()->json([
            'status'    => 200,
            'message'   => 'Success',
            'data' => $data
        ]);
    }

    public function loadProductInBill()
    {
        $data  = DetailImportProduct::where('id_import_product', 0)->where('status', 0)->get()->toArray();

        $totalAmount = DetailImportProduct::where('id_import_product', 0)
            ->where('status', 0)
            ->sum('Total_amount');

        if (!$data) {
            return response()->json([
                'status'    => 500,
                'message'   => 'Load Data fail',
            ]);
        } else {
            return response()->json([
                'status'    => 200,
                'message'   => 'Success',
                'data' => $data,
                'total' => $totalAmount

            ]);
        }
    }


    public function addProductInBill(Request $request)
    {
        $idProduct = $request->id;
        $product       = Product::find($idProduct);
        $DetailImport  = DetailImportProduct::where('id_product', $idProduct)
            ->where('id_import_product', 0)
            ->where('status', 0)
            ->first();
        if ($DetailImport) {
            $DetailImport->quantity_import = $DetailImport->quantity_import + 1;
            $DetailImport->Total_amount    = $DetailImport->price_import * $DetailImport->quantity_import;
            $DetailImport->save();
        } else {
            DetailImportProduct::create([
                'id_product'        => $product->id,
                'name_product'      => $product->name,
                'quantity_import'   => 1,
                'price_import'      => $product->price,
                'Total_amount'      => $product->price * 1,
                'id_import_product' => 0,
                'status'            => 0
            ]);
        }
        return response()->json([
            'status'  => true,
            'message' => "Thêm mới món ăn vào hóa đơn nhập hàng thành công!",
            'data'    => $DetailImport

        ]);
    }
    //Search-DetailImportProduct
    public function searchProductInBill(Request $request)
    {
        $data = DetailImportProduct::where('name_product', 'like', '%' . $request->key_search . '%')
            ->orwhere('price_import', 'like', '%' . $request->key_search . '%')
            ->get();
        if ($data->isEmpty()) {
            return response()->json([
                'status'  => 500,
                'message' => 'Không Tìm Thấy Sản Phẩm !!',
            ]);
        }

        return response()->json([
            'status'  => 200,
            'message' => 'Tìm Kiếm Thành Công!',
            'data'    => $data
        ]);
    }
    //Import Product
    public function ImportProductInBill(Request $request)
    {
        if ($request->id_suppliers != 0) {
            $data = $request->all();
            $data['code_import_product'] = uniqid();
            $data['day_import'] = Carbon::now()->format('Y-m-d');
            $data['id_user']  = Auth::id();
            $DetailImport  = DetailImportProduct::where('id_import_product', 0)->where('status', 0)->get();
            if (count($DetailImport) > 0) {
                $importProduct = ImportProduct::create($data);
                if ($importProduct) {
                    foreach ($DetailImport as $key => $value) {
                        $value->id_import_product = $importProduct->id;
                        $value->status = 1;
                        $value->save();
                    }
                    return response()->json([
                        'status'    => 200,
                        'message'   => 'Đã nhập hàng thành công!',
                        'data'      => $importProduct
                    ]);
                } else {
                    return response()->json([
                        'status'    => 500,
                        'message'   => 'Đã có lỗi xãy ra!',
                    ]);
                }
            } else {
                return response()->json([
                    'status'    => 500,
                    'message'   => 'Không Có Hoá đơn !',
                ]);
            }
        } else {
            return response()->json([
                'status'    => 500,
                'message'   => 'Vui Lòng Chọn Nhà Cung Cấp !',
            ]);
        }
    }
    // LoadInvoice ImportProduct
    public function LoadInvoiceImportProduct(Request $request)
    {
        $data = ImportProduct::join('users', 'users.id', 'import_products.id_user')
            ->join('suppliers', 'suppliers.id', 'import_products.id_suppliers',)
            ->select('import_products.*', 'users.name', 'suppliers.name_company')->get();
        return response()->json([
            'status'  => 200,
            'data'    => $data
        ]);
    }
    public function DeleteImportProductInBill(Request $request)
    {
        $DetailImport = DetailImportProduct::where('id', $request->id)
            ->where('id_import_product', 0)
            ->where('status', 0)
            ->first();

        if (!isset($DetailImport)) {
            return response()->json([
                'status'  => 500,
                'message' => 'Không Tìm Thấy Sản Phẩm !!',
            ]);
        } else {
            $DetailImport->delete();
            return response()->json([
                'status'  => 200,
                'message' => 'Xoá sản phẩm thành công!',
            ]);
        }
    }

    public function DeleteImportProduct(Request $request)
    {
        $imporformProduct = ImportProduct::find($request->id);

        if (!isset($imporformProduct)) {
            return response()->json([
                'status'  => 500,
                'message' => 'Không có hoá đơn phù hợp!',
            ]);
        }

        DetailImportProduct::where('id_import_product', $request->id)->where('status', 1)->delete();
        $imporformProduct->delete();
        return response()->json([
            'status'  => 200,
            'message' => 'Xoá Thành Công!',
        ]);
    }
    public function DetailImportProductInBill ($id){
        $detailformImport = DetailImportProduct::where('id_import_product',$id)->where('status',1)->get();
        return view('user.ImportProduct.DetailImportPD',compact('detailformImport'));

    }
}
