<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryProductStoreRequest extends FormRequest
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
            'name' => 'bail|required|unique:danhmucsanpham,ten'
        ];
    }

    public function messages(){
        return [
            'name.required'  => 'Tên không được trống',
            'name.unique'    => 'Tên đã tồn tại'
        ];
    }
}
