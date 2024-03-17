<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'title'             => 'required|',
            'image'             => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description'       => 'required|',
            'content'           => 'required|',
        ];
    }
    public function messages()
    {
        return [
            'title.*'             => 'Vui lòng không được để trống Tiêu đề',
            'image.required'      => 'Vui lòng không được để trống trường ảnh',
            'description.*'       => 'Vui lòng không được để trống description',
            'content.*'           => 'Vui lòng không được để trống content',
            'image.mimes'         => 'Hinh anh upload len phai dinh dạng như sau :jpeg,png,jpg,gif',
        ];
    }
}
