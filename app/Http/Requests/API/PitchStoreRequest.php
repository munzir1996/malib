<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class PitchStoreRequest extends FormRequest
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
            'name' => 'required',
            'phone' => 'required|min:10',
            'location' => 'required',
            'description' => 'required',
            'price' => 'required',
            'area_id' => 'required',
            'owner_id' => 'required'
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'الأسم مطلوب',
            'phone.required' => 'رقم الهاتف مطلوب',
            'location.required' => 'الموقع مطلوب',
            'description.required' => 'الوصف مطلوب',
            'phone.min' => 'يجب أن يكون رقم الهاتف 10 ارقام',
            'price.required' => 'السعر مطلوب',
            'area_id.required' => 'المنطقة مطلوبة',
            'owner_id.required' => 'المالك مطلوب',
        ];
    }
}
