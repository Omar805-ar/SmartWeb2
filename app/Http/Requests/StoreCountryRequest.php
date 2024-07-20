<?php

namespace App\Http\Requests;

use App\Models\Country;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCountryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('country_create'),
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
                'min:4',
                'max:5',
                'required',
                'unique:countries,iso',
            ],
            'currency_code' => [
                'string',
                'min:4',
                'max:5',
                'required',
                'unique:countries,currency_code',
            ],
            'flag' => [
                'string',
                'nullable',
            ],
        ];
    }
}
