<?php

namespace App\Http\Requests\gwiazdy;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GwiazdaRequest extends FormRequest
{
    /**
     * Reguły walidacji
     *
     * @return array
     */
    public function rules()
    {
        return [
            'imie_gwiazdy' => ['required', 'string', 'max:255'],
            'nazwisko_gwiazdy' => ['required', 'string', 'max:255']
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
            'imie_gwiazdy' => __('translations.gwiazdy.attribute.name'),
            'nazwisko_gwiazdy' => __('translations.gwiazdy.attribute.lastname'),
        ];
    }
}
