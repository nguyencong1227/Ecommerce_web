<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'name'         => 'bail|required',
            'phone_number' => 'nullable|numeric|regex:/^[0-9+]{8,16}$/',
            'email'        => 'bail|required|email|unique:nguoidung,email',
            'password'     => 'bail|required|min:8|max:20',
        ];
    }

    public function messages(){
        return [
            'name.required'        => 'Tên không được trống',
            'name.unique'          => 'Tên đã tồn tại',
            'phone_number.numeric' => 'Số điện thoại chỉ gồm các chữ số',
            'phone_number.regex'   => 'Số điện thoại không thỏa mãn',
            'email.required'       => 'Email không được trống',
            'email.email'          => 'Không đúng định dạng email',
            'email.unique'         => 'Email đã tồn tại',
            'password.required'    => 'Password không được trống',
            'password.min'         => 'Password tối thiểu 8 ký tự',
            'password.max'         => 'Password tối đa 20 ký tự',
        ];
    }
}
