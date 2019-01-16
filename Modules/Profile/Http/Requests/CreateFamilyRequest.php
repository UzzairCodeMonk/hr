<?php

namespace Modules\Profile\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFamilyRequest extends FormRequest
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
            'ic_number' => 'required',
            'relationship_id' => 'required',                        
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Family member name is required',
            'ic_number' => 'Family IC number is required',
            'relationship_id'=> 'Please define your connection with this person'
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
