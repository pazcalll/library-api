<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

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
        $requiredOnStore = Route::is(['books.store']) ? 'required' : 'sometimes';

        $validations = [
            'title' => [$requiredOnStore, 'max:100'],
            'description' => [$requiredOnStore, 'max:255'],
            'publish_date' => [$requiredOnStore, 'date_format:Y-m-d'],
        ];

        if (Route::is(['books.store'])) $validations['author_id'] = ['required', 'exists:authors,id'];

        return $validations;
    }
}
