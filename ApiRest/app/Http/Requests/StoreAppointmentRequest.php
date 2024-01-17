<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string|regex:/^[0-9]{10}$/',
            'date' => 'required|date',
            'curp' => [
                'required',
                'string',
                'unique:appointments,curp,NULL,id,date,' . request('date'),
                'regex:/^[A-Z]{4}[0-9]{6}[H,M][A-Z]{5}[0-9]{2}$/',
            ],
            'password' => [
                'required',
                'string',
                'min:8',            // Mínimo 8 caracteres
                // 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/', // Al menos una minúscula, una mayúscula, un número y un carácter especial
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El campo nombre es obligatorio.',
            'last_name.required' => 'El campo apellido es obligatorio.',
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.email' => 'Por favor, introduce una dirección de correo electrónico válida.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            'phone.required' => 'El campo teléfono es obligatorio.',
            'phone.regex' => 'El campo teléfono no es valido.',
            'date.required' => 'El campo fecha es obligatorio.',
            'date.date' => 'Por favor, introduce una fecha válida.',
            'curp.required' => 'El campo CURP es obligatorio.',
            'curp.unique' => 'Este CURP ya ha sido registrado para la fecha seleccionada.',
            'curp.regex' => 'El campo CURP tiene un formato invalido.',
        ];
    }
}
