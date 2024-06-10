<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
        $id = $this->request->get('product_id');
        return [
            'name'        => 'bail|required|unique:sanpham,Ten,'.$id,
            'price'       => 'bail|required|regex:/^\d*(\.\d{1,3})?$/',
            'description' => 'bail|required',
            'quantities'  => 'bail|required|integer',
            'image'       => 'bail|nullable|image|max:5000',
            'size'        => 'bail|required',
        ];
    }

    public function messages(){
        return [
            'name.required'        => 'Tên không được trống',
            'name.unique'          => 'Tên đã tồn tại',
            'price.required'       => 'Gía không được trống',
            'price.regex'          => 'Gía phải thỏa mãn 123.456 hoặc 123',
            'description.required' => 'Nội dung không được trống',
            'quantities.required'  => 'Số lượng không được trống',
            'quantities.integer'   => 'Số lượng phỉa là số nguyên',
            'image.image'          => 'Không phải định dạng jpeg, png, bmp, gif, svg, or webp',
            'image.max'            => 'Ảnh quá 5000 ký tự',
            'size.required'        => 'Bạn vui lòng chọn size cho sản phẩm',
        ];
    }
}
