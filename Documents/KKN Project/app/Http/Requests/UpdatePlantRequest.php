<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['required', 'string', 'min:3', 'max:1024'],
            'benefit' => ['required', 'string', 'min:3', 'max:1024'],
            'expiration' => ['required', 'integer', 'min:0'],
            'image' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:10240'],
        ];
    }
}
