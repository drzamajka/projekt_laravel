<?php

namespace App\Http\Requests\Filmy;

use App\Models\Manufacturer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class FilmRequest extends FormRequest
{
    /**
     * Reguły walidacji
     *
     * @return array
     */
    public function rules()
    {
        if($this->iloscgwiazd>1){
            //dd($this->request);
            $rules = [
                'gatunek_id' => ['required', 'integer', 'sometimes' , 'exists:gatunek,id'],
                'gwiazda_id' => ['required', 'integer', 'exists:gwiazda,id'],
                'tytul' => ['required', 'string', 'max:255'],
                'data_premiery' => ['required', 'date'],
                'opis' => ['required', 'string', 'max:255']
            ];
            $rules += ['aktorzy_id' => ['required', 'array', 'min:1']];
            $rules += ['aktorzy_id.*' => ['required', 'integer', 'exists:gwiazda,id']];
            $rules += ['aktorzy_role' => ['required', 'array', 'min:1']];
            $rules += ['aktorzy_role.*' => ['required', 'string', 'max:255']];
            //dd($rules);
            return $rules;
        }
        else
            return [
                'gatunek_id' => ['required', 'integer', 'exists:gatunek,id'],
                'gwiazda_id' => ['required', 'integer', 'exists:gwiazda,id'],
                'tytul' => ['required', 'string', 'max:255'],
                'data_premiery' => ['required', 'date', 'max:255'],
                'opis' => ['required', 'string', 'max:255'],
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
            'gatunek_id' => __('translations.filmy.attribute.type'),
            'gwiazda_id' => __('translations.filmy.attribute.director'),
            'tytul' => __('translations.filmy.attribute.title'),
            'data_premiery' => __('translations.filmy.attribute.release'),
            'opis' => __('translations.filmy.attribute.descryption'),
            'aktorzy_id.*' => __('translations.filmy.attribute.star'),
            'aktorzy_role.*' => __('translations.filmy.attribute.stars-as'),
        ];
    }
}
