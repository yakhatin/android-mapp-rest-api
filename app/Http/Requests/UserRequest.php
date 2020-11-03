<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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

    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'unique:users|string',
            'password' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле "Имя" является обязательным.',
            'email' => 'Поле "Эл. почта" является обязательным.',
            'email.unique' => 'Пользовать с такой эл. почтой уже зарегистрирован.',
            'password.required' => 'Поле "Пароль" является обязательным.',
        ];
    }
}