<?php

namespace App\Http\Requests;

use App\Functions\Helpers;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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

    // Funzione che prepara i dati per la validazione
    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Helpers::generateSlug($this->name."-".Auth::id()),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'restaurant_id' => 'exists:restaurants,id',
            'name' => 'required|max:100',
            'slug' => ['required', 'max:110', Rule::unique('products')->ignore($this->product)],
            'price' => 'required|decimal:0,2',
            'description' => 'nullable',
            'image' => 'nullable|max:255',
            'visibility' => 'nullable',
            'category' => 'nullable|max:50'
        ];
    }

    public function messages()
    {
        return [
            'slug.unique' => 'Il nome del piatto è già presente nel menù.',
        ];
    }
}
