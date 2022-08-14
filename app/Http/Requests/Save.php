<?php

namespace App\Http\Requests;


use Illuminate\Validation\Rule;

class Save extends Request
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
        $rules = [
            'description' => [
                'required',
                'string',
            ],
            'amount' => [
                'required',
                'integer',
            ],
            'currency' => [
                'required',
                'string',
            ],
        ];

        return $rules;
    }
}
