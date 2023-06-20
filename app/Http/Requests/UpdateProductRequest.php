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
            'price' => 'required|numeric|min:0|decimal:0,2',
            'description' => 'nullable',
            'image' => 'image|nullable|max:255',
            'visibility' => 'boolean',
            'category' => 'nullable|max:50'
        ];
    }

    public function messages()
    {
        return [
            'slug.unique' => 'Il nome del piatto è già presente nel menù.',
            'name.required' => 'Il nome del piatto è richiesto',
            'name.max' => 'Il nome del piatto non può contenere più di :max caratteri',
            'price.required' =>'Il prezzo è richiesto',
            'price.decimal' => 'Impossibile inserire il prezzo richiesto',
            'price.numeric' => 'Il prezzo non può contenere lettere',
            'price.min' => 'il prezzo non può essere negativo',
            'image.image' => 'Il formato del file non è un immagine'
        ];
    }
}
