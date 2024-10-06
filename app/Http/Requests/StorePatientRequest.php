<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class StorePatientRequest extends FormRequest
{
    /**
     * Determine if the patient is authorized to make this request.
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'dui' => 'required|unique:patients|max:999999999|numeric',
            'gender' => 'required',
            'blood_type' => 'required',
            'blood_pressure' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es requerido',
            'name.max' => 'El nombre es muy largo',
            'dui.required' => 'El dui es requerido',
            'dui.numeric' => 'El dui debe contener solo numeros',
            'dui.max' => 'El dui debe contener máximo 9 digitos',
            'dui.unique' => 'Ya existe un paciente registrado con ese dui',
            'gender.required' => 'Seleccione Genero',
            'blood_type.required' => 'Seleccione Tipo de Sangre',
            'blood_pressure.required' => 'Seleccione Presion Arterial'
        ];
    }
}
