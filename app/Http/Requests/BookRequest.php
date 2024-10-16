<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'author_id' => ['required', 'exists:authors,id'],
            'title' => ['required', 'max:100'],
            'description' => ['required', 'max:255'],
            'publish_date' => ['required', 'date_format:Y-m-d'],
        ];
    }
}
