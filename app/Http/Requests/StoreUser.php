<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
            'username' => ['required','max:50','unique'],
            'firstname' => ['required','max:50','regex:/^[a-zA-Z]+$/u'],
            'lastname' => ['required','max:50','regex:/^[a-zA-Z]+$/u'],
            'phone_number' => ['required','max:50','numeric'],
            'email' => ['required','email'],
            'gender' => ['required'],
        ];
    }
}
