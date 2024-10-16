<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class AuthorRequest extends FormRequest
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
        $requiredOnStore = Route::is(['authors.store']) ? 'required' : 'sometimes';

        return [
            'name' => [$requiredOnStore, 'max:100', 'min:3'],
            'bio' => [$requiredOnStore, 'max:255'],
            'birth_date' => [$requiredOnStore, 'date_format:Y-m-d'],
        ];
    }
}
