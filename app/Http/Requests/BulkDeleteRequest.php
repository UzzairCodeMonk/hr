<?php

namespace Datakraf\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class BulkDeleteRequest extends FormRequest
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
            'ids' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'ids.*.required' => 'Please tick a checkbox to perform bulk delete'
        ];
    }

    public function formatErrors(Validator $validator)
    {
        $messages = $validator->messages();
        foreach ($messages->all() as $message)
        {
            toast($message, 'error', 'top-right');
        }

        return $validator->errors()->all();
    }
}
