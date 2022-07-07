<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PizzaRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => 'required|min:3|max:50',
            'descrizione' => 'required|min:5',
            'immagine' => 'nullable|file|max:10000',
            'prezzo' => 'required|max:99.99|numeric',
            'popolarita' => 'nullable',
            'vegetariana' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Il campo nome è obbligatorio',
            'nome.min' => 'Il campo nome deve avere almeno :min caratteri',
            'nome.max' => 'Il campo nome può avere massimo :max caratteri',
            'descrizione.required' => 'Il campo descrizione è obbligatorio',
            'descrizione.min' => 'Il campo descrizione deve avere almeno :min caratteri',
            'immagine.file' => 'Il file non è stato correttamente caricato',
            'immagine.max' => 'La dimensione del file deve essere inferiore a :max kilobytes',
            'prezzo.required' => 'Il campo prezzo è obbligatorio',
            'prezzo.numeric' => 'Il campo prezzo deve contenere solo numeri',
            'prezzo.max' => 'Il prezzo deve essere inferiore a 100',
        ];
    }
}
