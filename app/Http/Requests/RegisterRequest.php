<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class RegisterRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name' => 'required',
            'email' => 'required|email|unique:nguoidung,email,',
            'phone_number' => 'required',
            'address' => 'required',
            'password' => 'required'
        ];
    }

    public function messages(){
        return [
            'name.required'        => 'Tên không được trống',
            'email.required'       => 'Email không được trống',
            'email.email'          => 'Không đúng định dạng email',
            'email.unique'         => 'Email đã tồn tại',
            'phone_number.required'   => 'Số điện thoại không được trống',
            'address.required'        => 'Địa chỉ không được trống',
            'password.required'        => 'Mật khẩu không được trống',

        ];
    }
}
