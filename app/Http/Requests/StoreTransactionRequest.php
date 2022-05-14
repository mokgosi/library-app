<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
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
            'member_id' => 'required',
            'book_id' => 'nullable',
            'date_issued' => 'required|date',
            'date_due' => 'required|date',
            'date_returned' => 'required|date',
            'status' => 'required',
            'penalty' => 'nullable' 
        ];
    }
}

