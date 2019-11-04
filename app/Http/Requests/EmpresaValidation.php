<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\DniRule;
use App\Rules\CelularRule;

class EmpresaValidation extends FormRequest
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
            'nombreempresa'    => 'required|max:150',
            'ruc'    => 'required|max:11',
            'direccionempresa' => 'nullable|max:100',
            'telefonoempresa'  => [new CelularRule()],
            'emailempresa'     => 'required|email|unique:empresas,email|nullable|max:100',
            'file'      => 'nullable',
            'nombre'          => 'required|max:30',
            'apellido'        => 'required|max:50',
            'dni'=>['required',new DniRule(),
                Rule::unique('user')->where(function ($query) {
                    return $query->where('empresa_id',auth()->user()->empresa_id);
                })
            ],
            'email'           => 'required|email|unique:users,email',
            'numero'=>['required','max:12', new CelularRule()],
            'direccion'       => 'nullable|max:100',            
            'contrasenia'     => 'required',
        ];
    }

    public function messages(){
        return [
            'ruc.unique'=> 'El empresa ya fue registrado.',
            'dni.unique'=> 'El usuario ya fue registrado.'
        ];
    }
}
