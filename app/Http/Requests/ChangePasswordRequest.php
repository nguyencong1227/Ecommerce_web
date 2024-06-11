<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'current_password'  =>'required',
            'new_password'  =>'required',
            'retype_password' => 'required|same:new_password'
        ];
    }

    public function  messages(){
        return [

            'current_password.required'  => 'Nhập vào mật khẩu hiện tại ',
            'txtPassword.required'       => 'Nhập vào mật khẩu mới',
            'retype_password.required'   => 'Nhập lại mật khẩu',
            'retype_password.same'       => 'Mật khẩu không trùng khớp',
        ];
    }
}
