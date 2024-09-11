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
            'id'         => 'required|exists:users,id',
            'name'       => 'required|max:191',
            'email'      => 'required|email|',
            'password'   => 'required|min:9',
            'phone'      => 'required|numeric',
            'avatar'   => 'required|image|mimes:jpeg,png,jpg,gif|max:5120'
        ];
    }

    public function messages()
    {
        return [
            'id.exists'         => 'Người dùng không tồn tại',
            'required'          => ':attribute không được để trống!',
            'max'               => ':attribute không được quá :max kí tự',
            'email.email'       => ':attribute sai định dạng email',
            'phone.numeric'     => ':attribute yêu cầu phải là số',
            'avatar.image'      => ':attribute phải là hình ảnh',
            'avatar.mimes'      => ':attribute phải có định dạng như sau: jpeg, png, jpg, gif',
            'avatar.max'        => ':attribute vượt quá kích thước cho phép :max KB',
            'password.min'      => ':attribute phải trên 9 kí tự'
        ];
    }
}
