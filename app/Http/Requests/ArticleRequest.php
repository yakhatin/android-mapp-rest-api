<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    public $rules = [
        'article_title' => 'string|required',
        'article_text' => 'string|required',
        'catalog_id' => 'integer|required'
    ];

    public $updateRules = [
        'article_title' => 'string',
        'article_text' => 'string',
        'catalog_id' => 'integer'
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
            'article_title.required' => 'Поле "Заголовок" является обязательным.',
            'article_text.required' => 'Поле "Текст статьи" является обязательным.',
            'catalog_id.required' => 'Поле "Каталог" является обязательным.'
        ];
    }
}