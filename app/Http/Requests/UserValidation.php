<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'unidad'=>'max:10|nullable',
            'placa'=>'max:10',
            'marca'=>'max:20|nullable',
            'modelo'=>'max:20|nullable',
            'color'=>'max:30|nullable',
            'anio'=>'numeric|max:9999|nullable',

            'soat'=>'max:20|nullable',
            'fecha_soat'=>'date|nullable',
            'revicion_tecnica'=>'max:20|nullable',
            'fecha_tecnica'=>'date|nullable',
        ];
    }

    public function messages(){
        return [
            'placa.unique'=> 'La placa ya fue registrado.'
        ];
    }
}
