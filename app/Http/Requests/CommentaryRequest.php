<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentaryRequest extends FormRequest
{
    public $rules = [
        'comment_text' => 'string|required',
        'article_id' => 'integer|required'
    ];

    public $updateRules = [
        'comment_text' => 'string',
        'article_id' => 'integer'
    ];

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
            //
        ];
    }

    public function messages()
    {
        return [
            'comment_text.required' => 'Поле "Текст комментария" является обязательным.',
            'article_id.required' => 'Поле "Статья" является обязательным.'
        ];
    }
}