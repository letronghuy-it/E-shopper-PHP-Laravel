<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class addproduct extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name'            => 'required|max:191',
            'price'           => 'required|numeric',
            'id_category'     => 'required|exists:categories,id',
            'id_brand'        => 'required|exists:brands,id',
            'company'         => 'required',
            'image_product'   => 'required',
            'image_product.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required'              => 'Vui lòng nhập Name cho sản phẩm',
            'name.max'                   => 'Name không được vượt quá 191 kí tự',

            'price.required'             => 'Vui lòng nhập price cho sản phẩm',
            'price.numeric'              => 'Price chọn phải là số',

            'id_category.required'       => 'Vui lòng không để trống Category',
            'id_category.exists'         => 'Category không tồn tại trong hệ thống',

            'id_brand.required'          => 'Vui lòng không để trống Brand',
            'id_brand.exists'            => 'Brand không tồn tại trong hệ thống',

            'company.required'           => 'Vui lòng không để trống Company',

            'image_product.required'     => 'Yêu cầu phải chọn ảnh ',
            'image_product.*.mimes'      => 'Hinh anh upload len phai dinh dạng như sau :jpeg,png,jpg,gif',
            'image_product.*.max'        => 'Hinh anh upload len vượt quá kích thước cho :max',
        ];
    }
}
