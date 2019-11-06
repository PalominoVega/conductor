<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;
use App\Rules\DniRule;
use App\Rules\CelularRule;

class ConductorValidation extends FormRequest
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
            'file'=>'nullable',
            'dni'=>['required',new DniRule(),
                Rule::unique('conductor')->where(function ($query) {
                    return $query->where('empresa_id',auth()->user()->empresa_id);
                })
            ],
            'nombre'    => 'required|max:50',
            'apellido'    => 'required|max:50',
            'celular'   => [new CelularRule(),'max:22'],
            'direccion' => 'max:100|nullable',
            'licencia'=>'max:10|nullable',
            'fecha_licencia'=>'date|nullable',
            'fecha_nacimiento'=>'date|nullable',
        ];
    }

    public function messages(){
        return [
            'dni.unique'=> 'El conductor ya fue registrado.'
        ];
    }
}
