<?php

namespace Modules\Leave\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplyLeaveRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'leavetype_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'leavetype_id.required' => 'Please specify the leave type',
            'start_date.required' => 'When will the leave start?',
            'end_date.required' => 'When will you be back in the office?'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
