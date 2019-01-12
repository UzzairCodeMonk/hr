<?php

namespace Modules\Leave\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLeaveCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'days' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Leave category name is required',
            'days.required' => 'This leave entitled for how many days?',
            'days.integer' => 'Days should be in numbers. I thought you know that.'
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
