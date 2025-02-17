<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\InvoiceDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class historyController extends Controller
{
    public function indexhistory()
    {
        $history = History::select('histories.id', 'histories.name', 'histories.email', 'histories.phone', 'histories.slug_history', 'histories.approve', 'histories.created_at', DB::raw('COUNT(histories.id) as total_histories'), DB::raw('SUM(histories.price) as total_price'))
            ->groupBy('histories.id', 'histories.name', 'histories.email', 'histories.phone', 'histories.slug_history', 'histories.approve', 'histories.created_at')
            ->get()
            ->toArray();

        return view('user.Histories.history', compact('history'));
    }
    public function destroy(Request $request)
    {
        $history = History::find($request->id);
        if ($history) {
            InvoiceDetail::where('id_history', $request->id)->delete();
            $history->delete();
            return redirect()->back()->with('success', _('Xoá Thành Công Đơn Hàng!'));
        } else {
            return redirect()->back()->withErrors('success', _('Không Tìm Thầy Đơn Hàng Cần Xoá'));
        }
    }

    public function changeApprove($id)
    {
        $history = History::find($id);
        if (isset($history)) {
            $history->approve = !$history->approve;
            $history->save();
            return redirect()->back()->with('success', _('Duyệt Thành Công Đơn Hàng!'));
        } else {
            return redirect()->back()->withErrors('success', _('Không Tìm Thầy Đơn Hàng '));
        }
    }

    public function paided()
    {
        $paided = History::join('users', 'histories.id_user', '=', 'users.id')
            ->where('histories.approve', '=', 1)
            ->where('histories.slug_history', '=', 1)
            ->select('histories.*', 'users.email', 'users.phone', 'users.name')
            ->get()
            ->toArray();
        return view('user.Histories.paided', compact('paided'));
    }
    public function unpaid()
    {
        $unpaided = History::join('users', 'histories.id_user', '=', 'users.id')
            ->where('histories.slug_history', '=', 0)
            ->select('histories.*', 'users.email', 'users.phone', 'users.name')
            ->get()
            ->toArray();
        return view('user.Histories.unpaid', compact('unpaided'));
    }

    public function unapprove()
    {
        $unapprove = History::join('users', 'histories.id_user', '=', 'users.id')
            ->where('histories.approve', '=', 0)
            ->select('histories.*', 'users.email', 'users.phone', 'users.name')
            ->get()
            ->toArray();
        return view('user.Histories.unapprove', compact('unapprove'));
    }

    public function viewinvoicedetail($id_history)
    {
        $invoice_detail = InvoiceDetail::where('id_history', $id_history)->get();

        if ($invoice_detail->isEmpty()) {
            return redirect()->back()->with('error', 'Không tìm thấy chi tiết hoá đơn phù hợp.');
        }

        return view('user.Histories.invoicedetail', compact('invoice_detail'));
    }
}
