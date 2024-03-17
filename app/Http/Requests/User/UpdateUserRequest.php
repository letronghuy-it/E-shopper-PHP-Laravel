<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [

            'name'       => 'required|max:191',
            'email'      => 'required|email|',
            'password'   => 'required|min:9',
            'phone'      => 'required|numeric',
            'avatar'     => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }

    public function messages()
    {
        return [

            'required'          => ':attribute: Không được để trống!',
            'max'               => ':attribute: Không được quá :max kí tự',
            'email.email'       => ':attribute: email sai định dạng',
            'phone.*'           => ':attribute: Yêu cầu phải là số  Phải là số',
            'avatar'            => ':attribute: Hinh anh upload lên phải là hình',
            'mimes:'            => ':attribute: Hinh anh upload len phai dinh dạng như sau :jpeg,png,jpg,gif',
            'avatar'            => ':attribute: Hinh anh upload len vượt quá kích thước cho :max',
            'password.*'        => ':attribute: Phải trên 9 kí tự'
        ];
    }
}
