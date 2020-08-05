<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class BookingStoreRequest extends FormRequest
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
            'customer_id' => 'required',
            'pitch_schedule_id' => 'required',
            'book_date' => 'required|date',
            'status' => 'required',
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
            'customer_id.required' => 'العميل مطلوب',
            'pitch_schedule_id.required' => 'جدول الملع مطلوب',
            'book_date.required' => 'تاريخ الحجز مطلوب',
            'book_date.date' => 'يجب ان يكون تاريخ',
            'status.required' => 'الحالة مطلوبة',
        ];
    }
}
