<?php

namespace App\Http\Controllers;

use App\Models\ReviewProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticalController extends Controller
{
    public function viewStatistical()
    {
        return view('user.Statistacal.indexView');
    }
    public function handleStatisticalAll(Request $request)
    {
        $startDate = Carbon::parse($request->start_date)->format('Y-m-d');
        $endDate  = Carbon::parse($request->end_date)->format('Y-m-d');
        return $this->calculateRevenue($startDate, $endDate);
    }

    public function LoadStatisticalAll()
    {
        return $this->calculateRevenue();
    }

    private function calculateRevenue($startDate = null, $endDate = null)
    {
        // Doanh Thu
        $totalSales = DB::table('invoice_details');
        if ($startDate && $endDate) {
            $totalSales->whereDate('created_at', '>=', $startDate)
                ->whereDate('created_at', '<=', $endDate);
        }
        $totalSales = $totalSales->select(DB::raw('SUM(total_amount) as total_sales'))->first();

        // Công Nợ
        $totalImports = DB::table('import_products');
        if ($startDate && $endDate) {
            $totalImports->whereDate('day_import', '>=', $startDate)
                ->whereDate('day_import', '<=', $endDate);
        }
        $totalImports = $totalImports->select(DB::raw('SUM(COALESCE(total_imports, 0)) as total_imports'))->first();

        // Tổng Thu Chi
        $netRevenue = ($totalSales->total_sales ?? 0) - ($totalImports->total_imports ?? 0);

        // Fetch items sold within the date range ( lọc item đã bán được theo ngày tháng năm )
        $soldProductsQuery = DB::table('invoice_details');
        if ($startDate && $endDate) {
            $soldProductsQuery->whereDate('created_at', '>=', $startDate)
                ->whereDate('created_at', '<=', $endDate);
        }
        // Order by most recently sold(các mặt hàng bán gần nhất)
        $soldProducts = $soldProductsQuery->select('name_product', 'qty', 'price', 'total_amount', 'created_at')
            ->orderBy('created_at', 'desc')
            ->get();

        if ($startDate && $endDate) {
            $inventory = DB::table('detail_import_products as dip')
                ->select(
                    'dip.name_product',
                    DB::raw('SUM(CASE
                            WHEN dip.created_at >= "' . $startDate . '" AND
                                 dip.created_at <= "' . $endDate . '"
                            THEN dip.quantity_import ELSE 0 END) as total_imported'),
                    DB::raw('COALESCE(SUM(CASE
                            WHEN id.created_at >= "' . $startDate . '" AND
                                 id.created_at <= "' . $endDate . '"
                            THEN id.qty ELSE 0 END), 0) as total_sold'),
                    DB::raw('SUM(CASE
                            WHEN dip.created_at >= "' . $startDate . '" AND
                                 dip.created_at <= "' . $endDate . '"
                            THEN dip.quantity_import ELSE 0 END) -
                            COALESCE(SUM(CASE
                            WHEN id.created_at >= "' . $startDate . '" AND
                                 id.created_at <= "' . $endDate . '"
                            THEN id.qty ELSE 0 END), 0) as total_quantity')
                )
                ->leftJoin('invoice_details as id', 'dip.id_product', '=', 'id.id_product')
                ->groupBy('dip.name_product')
                ->having('total_quantity', '>', 0)
                ->get();
        } else {
            $inventory = DB::table('detail_import_products as dip')
                ->select(
                    'dip.name_product',
                    DB::raw('SUM(dip.quantity_import) as total_imported'),
                    DB::raw('COALESCE(SUM(id.qty), 0) as total_sold'),
                    DB::raw('SUM(dip.quantity_import) - COALESCE(SUM(id.qty), 0) as total_quantity')
                )
                ->leftJoin('invoice_details as id', 'dip.id_product', '=', 'id.id_product')
                ->groupBy('dip.name_product')
                ->having('total_quantity', '>', 0)
                ->get();
        }

        return response()->json([
            'status'        => 200,
            'message'       => 'Get dữ liệu thành công!',
            'total_sales'   => $totalSales->total_sales ?? 0,
            'total_imports' => $totalImports->total_imports ?? 0,
            'net_revenue'   => $netRevenue,
            'soldProduct'    => $soldProducts,
            'inventory'     => $inventory
        ]);
    }
    public function LoaduserReview()
    {
        $review = ReviewProduct::all();
        return response()->json([
            'status' => 200,
            'message' => 'Load dữ liệu thành công!',
            'data' => $review
        ]);
    }

    public function DestoyuserReview(Request $request)
    {
        $id     = $request->idReview;
        $Review = ReviewProduct::find($id);
        if (!isset($Review)) {
            return response()->json([
                'status' => 500,
                'message' => 'Bài đánh giá không tồn tại',
            ]);
        }
        $Review->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Xoá bài đánh giá thành công!',
        ]);
    }
}
