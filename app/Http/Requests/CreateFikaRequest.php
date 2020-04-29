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
            'title' => 'required|string',
            'times' => 'required|array|between:1,5',
            'times.*' => 'required|string|regex:/^\d{2}:\d{2}$/'
        ];
    }
}
