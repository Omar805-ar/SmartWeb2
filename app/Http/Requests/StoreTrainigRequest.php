<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTrainigRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name_ar'           => ['nullable', 'string', 'max:255'],
            'description_ar'    => ['nullable', 'string', 'max:65000'],
            'name_en'           => ['nullable', 'string', 'max:255'],
            'description_en'    => ['nullable', 'string', 'max:65000'],
            //'type'              => ['required', 'in:article,video'],
            'video_iframe'      => ['nullable'],
            'category_id'       => ['required', 'integer', 'exist:training_categories,id'],
        ];
    }
}
