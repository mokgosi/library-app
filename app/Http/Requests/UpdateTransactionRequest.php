<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTransactionRequest extends FormRequest
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
            'book_id' => 'required',
            'date_issued' => 'required|date',
            'date_due' => 'required|date',
            'date_returned' => 'nullable|date',
            'status' => 'nullable',
            'penalty' => 'nullable',
            'transaction_id' => 'required' 
        ];
    }
}

