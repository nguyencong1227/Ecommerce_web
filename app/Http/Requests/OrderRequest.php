<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'name'      => 'required',
            'email'     => 'required|email',
            'address'   => 'required',
            'phone'     => 'required|numeric|regex:/^[0-9+]{8,16}$/',
        ];
    }

    public function messages(){
        return [
            'name.required'        => 'Họ tên không được trống',
            'phone.required'       => 'Số điện thoại không được trống',
            'phone.numeric'        => 'Số điện thoại chỉ gồm các chữ số',
            'phone.regex'          => 'Số điện thoại không thỏa mãn',
            'email.required'       => 'Email không được trống',
            'email.email'          => 'Không đúng định dạng email',
            'address.required'     => 'Address không được trống',
        ];
    }
}
