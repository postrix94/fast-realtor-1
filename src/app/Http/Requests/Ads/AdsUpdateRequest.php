<?php

namespace App\Http\Requests\Ads;

use App\Models\ImageOlx;
use App\Models\OlxAdvertisement;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AdsUpdateRequest extends FormRequest
{
    /**
     * Indicates whether validation should stop after the first rule failure.
     *
     * @var bool
     */
    protected $stopOnFirstFailure = true;

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
            "id" => [Rule::exists(OlxAdvertisement::class, "id")],
            "title" => ["min:5", "max:70"],
            "body" => ["nullable", "max: 25000"],
            "price" => ["required","max:30"],
            "commentary" => ["nullable", "max:500"],
            "images" => ["nullable", "array"],
            "images.*.id" => ["required", "numeric", Rule::exists(ImageOlx::class, "id")],
            "images.*.link" => ["required", "string", Rule::exists(ImageOlx::class, "link")],
            "images.*.add_id" => ["required", "numeric", Rule::exists(ImageOlx::class, "add_id")],
        ];
    }

    public function messages()
    {
        return [
            "id.exists" => "Такого оголошення не існує",
            "title.min" => "Мінімальна довжина заголовку 5 символів",
            "title.max" => "Максимальна довжина заголовку 70 символів",
            "body.max" => "Максимальна довжина опису 25 000 символів",
            "price.required" => "Ціна не може бути пустою",
            "price.max" => "Максимальна довжина ціни 30 символів",
            "commentary.max" => "Максимальна довжина коментарію 500 символів",
        ];
    }
}
