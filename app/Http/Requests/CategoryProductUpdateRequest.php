<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryProductUpdateRequest extends FormRequest
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
        $id = $this->request->get('category_product_id');
        return [
            'name'  => 'bail|required|unique:danhmucsanpham,ten,'.$id
        ];
    }

    public function messages(){
        return [
            'name.required'  => 'Tên không được trống',
            'name.unique'    => 'Tên đã tồn tại',
        ];
    }
}
