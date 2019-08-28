<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;

class PasswordUpdateRequest extends FormRequest
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
            'password_current' => 'required',
            'password' => 'required|min:8|confirmed'
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param Validator $validator
     * @return void
     */
    public function withValidator( Validator $validator)
    {
        // checks user's current password
        // before making password update
        $validator->after(function ($validator) {
            if ( !Hash::check($this->password_current, $this->user()->password) ) {
                $validator->errors()->add('password_current', 'Your current password is incorrect.');
            }
        });
        return;
    }
}
