<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class PitchScheduleStoreRequest extends FormRequest
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
            'pitch_id' => 'required',
            'day' => 'required',
            'start' => 'required|date',
            'end' => 'required|date',
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
            'pitch_id.required' => 'الملعب مطلوب',
            'day.required' => 'اليوم مطلوب',
            'start.required' => 'تاريخ بدء مطلوب',
            'start.date' => 'يجب ان يكون تاريخ',
            'end.required' => 'تاريخ الأنتهاء مطلوب',
            'end.date' => 'يجب ان يكون تاريخ',
        ];
    }

}
