<?php

namespace App\Http\Requests;

use App\Functions\Helpers;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
        // $this->merge([
        //     'slug' => Helpers::generateSlug($this->name),
        // ]);
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
            'price' => 'required|decimal:0,2',
            'description' => 'nullable',
            'image' => 'nullable|max:255',
            'visibility' => 'nullable',
            'category' => 'nullable|max:50'
        ];
    }
}
