<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditModelDataRequest extends FormRequest
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
            'name' => 'required|max:40|min:1',
        ];

        return null;
    }

    public function messages()
    {
        return [
            'name.required' => 'Name field must be filled.',
            'name.max' => 'Name field must be shorter than or equal to 40 characters.',
            'name.min' => 'Name field must be longer than or equal to 1 character(s).',
        ];
    }
}
