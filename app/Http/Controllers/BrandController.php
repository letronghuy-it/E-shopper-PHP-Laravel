<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function indexBrand(){
        $brand = Brand::all();
        return view('user.Brand.brand',compact('brand'));
    }

    public function store(Request $request){
        $data = $request->all();
        Brand::create($data);
        return redirect()->back()->with('success',_('Thêm Mới Thành Công'));

   }
   public function edit(Request $request){
       $brand = Brand::find($request->id);
       if($brand){
               return view('user.Brand.editbrand',compact('brand'));
       }else{
           return redirect()->back();
       }
   }

   public function update(Request $request){
       $brand = Brand::where('id',$request->id)->first();
       $data = $request->all();
       $brand->update($data);
       return redirect('/admin/brand')->with('success', _('Cập Nhật Thành Công'));
   }

   public function destroy(Request $request){
       $brand  = Brand::find($request->id);
       $brand->delete();
       return redirect()->back()->with('success',_('Xoá Thành Công'));
   }

}
