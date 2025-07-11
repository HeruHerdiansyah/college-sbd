<?php

namespace App\Http\Requests\RegisterPasien;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRegisterPasienRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'pasien_id' => 'required|exists:pasiens,id',
            'poli_id' => ['required', Rule::in('poli-umum', 'poli-gigi', 'poli-mata')],
        ];
    }
}
