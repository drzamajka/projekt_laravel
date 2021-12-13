<?php

namespace App\Http\Requests\Gatunki;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GatunekRequest extends FormRequest
{
    /**
     * Reguły walidacji
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nazwa_gatunku' => [
                'required', 'string', 'max:100',
                // kolumna name ma ustawiony unique na bazie i możliwy jest 
                // zapis bez podawania nazwy kolumny w ignore
                Rule::unique('gatunek')->ignore($this->nazwa_gatunku)
            ]
        ];
    }

    /**
     * Komunikaty błędów
     *
     * @return void
     */
    public function messages()
    {
        return [];
    }

    /**
     * Tłumaczenia atrybutów
     *
     * @return void
     */
    public function attributes()
    {
        return [
            'nazwa_gatunku' => __('translations.gatunki.attribute.name')
        ];
    }
}
