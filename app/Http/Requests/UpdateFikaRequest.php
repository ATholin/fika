<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFikaRequest extends FormRequest
{
    /**
     * Prepare the request for validation.
     *
     */
    public function prepareForValidation()
    {
        if ($this->has('password')) {
            if ($this->filled('password')) {
                return;
            }
        }

        $this->request->remove('password');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'filled|string|between:3,64',
            'slug' => 'filled|string|between:3,32|regex:/^\w+-?\w+$/',
            'times' => 'filled|array|between:1,5',
            'times.*.start' => 'filled|string|regex:/^\d{2}:\d{2}$/',
            'times.*.end' => 'filled|string|regex:/^\d{2}:\d{2}$/',
            'password' => 'sometimes|string|min:4'
        ];
    }
}
