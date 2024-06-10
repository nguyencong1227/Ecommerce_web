<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierStoreRequest extends FormRequest
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
            'name'         => 'bail|required|unique:nhacungcap,Ten',
            'address'      => 'required',
            'phone_number' => 'bail|required|numeric|regex:/^[0-9+]{8,16}$/',
            'email'        => 'bail|required|email',
        ];
    }

    public function messages(){
        return [
            'name.required'         => 'Tên không được trống',
            'name.unique'           => 'Tên đã tồn tại',
            'address.required'      => 'Địa chỉ không được trống',
            'phone_number.required' => 'Số điện thoại không được trống',
            'phone_number.numeric'  => 'Số điện thoại chỉ gồm các chữ số',
            'phone_number.regex'    => 'Số điện thoại không thỏa mãn',
            'email.required'        => 'Email không được trống',
            'email.email'           => 'Không đúng định dạng email',
        ];
    }
}
