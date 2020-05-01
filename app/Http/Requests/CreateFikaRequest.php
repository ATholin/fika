<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFikaRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|between:3,64',
            'slug' => 'required|unique:fikas|string|between:3,32|regex:/^\w+-?\w+$/',
            'times' => 'required|array|between:1,5',
            'times.*.start' => 'required|string|regex:/^\d{2}:\d{2}$/',
            'times.*.end' => 'required|string|regex:/^\d{2}:\d{2}$/',
            'password' => 'nullable|string|min:4'
        ];
    }
}
