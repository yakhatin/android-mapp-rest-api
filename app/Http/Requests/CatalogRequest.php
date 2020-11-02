<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CatalogRequest extends FormRequest
{
    public $rules = [
        'catalog_title' => 'string|required',
        'catalog_description' => 'string|nullable',
        'catalog_parent_id' => 'integer|nullable'
    ];

    public $updateRules = [
        'catalog_title' => 'string',
        'catalog_description' => 'string|nullable',
        'catalog_parent_id' => 'integer|nullable'
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
            'catalog_title.required' => 'Поле "Заголовок" является обязательным.'
        ];
    }
}