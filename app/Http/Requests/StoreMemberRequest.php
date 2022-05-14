<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMemberRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'id_number' => 'nullable|digits:13',
            'date_of_birth' => 'required',
            'home_address' => 'nullable',
            'email' => 'nullable|email', // check unique, check update create
            'phone' => ['required','regex:/^(\+27|0)[6-8][0-9]{8}$/'],
        ];
    }
}
