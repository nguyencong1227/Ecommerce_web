<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InformationUpdateRequest extends FormRequest
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
        $id = $this->request->get('information_id');
        return [
            'title' => 'bail|required|unique:thongtincuahang,TieuDe,'.$id,
            'contents' => 'bail|required'
        ];
    }

    public function messages(){
        return [
            'title.required'    => 'Tiêu đề không được trống',
            'title.unique'      => 'Tiêu đề đã tồn tại',
            'contents.required' => 'Nội dung không được trống'
        ];
    }
}
