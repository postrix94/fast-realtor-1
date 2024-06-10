<?php

namespace App\Http\Requests\Login;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

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
            "phone" => ["digits:9"],
            "password" => ["min:5", "max:100"],
        ];
    }

    public function messages()
    {
        return [
            "phone.digits" => "Невірно введено номер",
            "password.min" => "Мінімальна довжина пролю 5 символів",
            "password.max" => "Максимальна довжина пролю 100 символів",

        ];
    }
}
