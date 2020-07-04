<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;

class RegisterRequest extends FormRequest
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
            'username' => 'required|unique:users',
            'password' => PasswordRules::register($this->request->get('username')),
            'password_confirmation' => 'required',
            'name' => 'required|alpha',
            'grade' => 'numeric|between:1,3',
            'class' => 'numeric|between:1,10',
            'number' => 'numeric|between:1,30',
        ];
    }
}
