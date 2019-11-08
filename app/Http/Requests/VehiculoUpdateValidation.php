<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class VehiculoUpdateValidation extends FormRequest
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
        $parametros=$this->route()->parameters();
        $vehiculo_id=$parametros['vehiculo'];
        return [

            'unidad'=>'max:10|nullable',
            'placa'=>['required','max:10',
                Rule::unique('vehiculo')->where(function ($query) use($vehiculo_id) {
                    return $query->where('empresa_id',auth()->user()->empresa_id)->where('id','<>', $vehiculo_id);
                })
            ],
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
