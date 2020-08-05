<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class PitchCommentStoreRequest extends FormRequest
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
            'comment' => 'required',
            'customer_id' => 'required',
            'pitch_id' => 'required',
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
            'comment.required' => 'التعليق مطلوب',
            'customer_id.required' => 'المستخدم مطلوب',
            'pitch_id.required' => 'الملعب مطلوب',
        ];
    }

}
