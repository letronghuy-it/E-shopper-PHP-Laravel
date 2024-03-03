<?php

namespace App\Http\Controllers;

use App\Models\Country;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;


class CountryController extends Controller
{
    public function indexcountry(){
        $country = Country::all();
        return view('user.country.country',compact('country'));
    }

    public function store(Request $request){
         $data = $request->all();
         Country::create($data);
         return redirect()->back()->with('success',_('Thêm Mới Thành Công'));

    }
    public function edit(Request $request){
        $country = Country::find($request->id);
        if($country){
                return view('user.country.editcountry',compact('country'));
        }else{
            return redirect()->back();
        }
    }

    public function update(Request $request){
        $country = Country::where('id',$request->id)->first();
        $data = $request->all();
        $country->update($data);
        return redirect('/admin/country')->with('success', _('Cập Nhật Thành Công'));
    }

    public function destroy(Request $request){
        $country  = Country::find($request->id);
        $country->delete();
        return redirect()->back()->with('success',_('Xoá Thành Công'));
    }


}
