<?php

namespace App\Http\Requests\Olx;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class OlxRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "olx_link" => ["regex:/^https?:\/\/(www|m).olx.ua[\\w\\W]+/"],
        ];
    }

    public function messages()
    {
        return [
          "olx_link.regex" => "Вставте посилання з OLX",
        ];
    }
}
