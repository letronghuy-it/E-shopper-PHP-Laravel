<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function indexcategory(){
        $category = Category::all();
        return view('user.Category.category',compact('category'));
    }

    public function store(Request $request){
        $data = $request->all();
        Category::create($data);
        return redirect()->back()->with('success',_('Thêm Mới Thành Công'));

   }
   public function edit(Request $request){
       $category = Category::find($request->id);
       if($category){
               return view('user.Category.editcategory',compact('category'));
       }else{
           return redirect()->back();
       }
   }

   public function update(Request $request){
       $category = Category::where('id',$request->id)->first();
       $data = $request->all();
       $category->update($data);
       return redirect('/admin/category')->with('success', _('Cập Nhật Thành Công'));
   }

   public function destroy(Request $request){
       $category  = Category::find($request->id);
       $category->delete();
       return redirect()->back()->with('success',_('Xoá Thành Công'));
   }
}
