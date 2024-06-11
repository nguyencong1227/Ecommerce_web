<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InfoUserRequest extends FormRequest
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
        $id = $this->request->get('user_id');
        return [
            'name'         => 'required|regex:/(^([a-zA-Z]+)(\d+)?$)/u',
            'phone_number' => 'nullable|numeric|regex:/^[0-9+]{8,16}$/',
            'email'        => 'required|email',

        ];
    }

    public function messages()
    {
        return [
            'name.required'        => 'Tên không được trống',
            'name.regex'           => 'Tên không được chứa ký tự đặc biệt',
            'phone_number.numeric' => 'Số điện thoại chỉ gồm các chữ số',
            'phone_number.regex'   => 'Số điện thoại không thỏa mãn',
            'email.required'       => 'Email không được trống',
            'email.email'          => 'Không đúng định dạng email',
            'email.unique'         => 'Email đã tồn tại',
        ];
    }
}
