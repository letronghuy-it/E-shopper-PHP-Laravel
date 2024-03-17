<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class historyController extends Controller
{
    public function indexhistory (){
        $history = History::join('users','histories.id_user','users.id')
                            ->select('histories.*')
                            ->get()->toArray();

                            return view('user.Histories.history',compact('history'));

    }
    public function destroy(Request $request){
        $history = History::find($request->id);
        if ($history) {
            $history->delete();
            return redirect()->back()->with('success', _('Xoá Thành Công Đơn Hàng!'));
        } else {
            return redirect()->back()->withErrors('success', _('Không Tìm Thầy Đơn Hàng Cần Xoá'));
        }
    }
}
