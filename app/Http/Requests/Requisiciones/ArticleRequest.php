<?php

namespace App\Http\Requests\Requisiciones;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
        $rules = [
            'name' => 'required',
            'trademark' => 'required',
            'unit' => 'required',
            'cost' => 'required|integer',
            'tariff' => 'required|integer',
            'category' => 'required',
            'description' => 'required|min:12'
        ];

        if($this->get('imagen'))
            $rules = array_merge($rules, ['imagen'         => 'mimes:jpg,jpeg,png']);

        return $rules;
    }
}
