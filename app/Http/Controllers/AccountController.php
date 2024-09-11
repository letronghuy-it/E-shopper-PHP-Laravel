<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\InvoiceDetail;
use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function viewAccoutuser()
    {
        $Ac_user = User::select('users.*')->where('level', 0)->get()->toArray();
        return view('user.Account.indexAccount', compact('Ac_user'));
    }

    public function destroyAcountuser($id)
    {
        $user = User::find($id);
        if (!$user) {

            return redirect()->back()->with('error', _(' Xoá Thất Bại'));
        } else {
            $histories = History::where('id_user', $id)->get();

            foreach ($histories as $history) {
                InvoiceDetail::where('id_history', $history->id)->delete();
            }

            History::where('id_user', $id)->delete();

            $user->delete();
            return redirect()->back()->with('error', _('Xoá Thành Công!'));
        }
    }
    public function BlockAcountuser($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', _(' Xoá Thất Bại'));
        } else {
            $user->status = !$user->status;
            $user->save();
            return redirect()->back()->with('sucess', _('Block Thành Công!'));
        }
    }

    public function EditAcountuser($id)
    {
        $Ac_user_edit = User::find($id);
        return view('user.Account.changePassword', compact('Ac_user_edit'));
    }
    public function UpdateAcountuser(Request $request)
    {
        $id     = $request->id;
        $user   = User::where('id', $id)->first();
        if (!empty($request->password) && !empty($request->re_password)) {
            if ($request->password != $request->re_password) {
                return redirect()->back()->with('error', __('Xác Nhận Mật Khẩu chưa chính xác!'));
            } else {
                $user->password = bcrypt($request->password);
                $user->save();
                return redirect()->route('user.Account.indexAccount')
                ->with('success', __('Đổi Mật Khẩu Thành Công!'));            }
        }else {
            return redirect()->back()->with('success', __('Không có thay đổi mật khẩu.'));
        }
    }
}
