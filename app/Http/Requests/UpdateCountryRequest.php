<?php

namespace App\Http\Requests;

use App\Models\Country;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCountryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('country_edit'),
            response()->json(
                ['message' => 'This action is unauthorized.'],
                Response::HTTP_FORBIDDEN
            ),
        );

        return true;
    }

    public function rules(): array
    {
        return [
            'iso' => [
                'string',
                'min:3',
                'max:5',
                'required',
                'unique:countries,iso,' . request()->route('country')->id,
            ],
            'name_ar' => [
                'string',
                'min:3',
                'max:255',
                'required',
            ],
            'name_en' => [
                'string',
                'min:3',
                'max:255',
                'required',
            ],
            'currency_code' => [
                'string',
                'min:2',
                'max:5',
                'required',
                'unique:countries,currency_code,' . request()->route('country')->id,
            ],
            
        ];
    }
}
