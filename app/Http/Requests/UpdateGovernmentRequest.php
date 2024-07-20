<?php

namespace App\Http\Requests;

use App\Models\Government;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateGovernmentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('government_edit'),
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
            'country_id' => [
                'integer',
                'exists:countries,id',
                'required',
            ],
            'name_en' => [
                'string',
                'max:255',
                'required',
            ],
            'name_ar' => [
                'string',
                'max:255',
                'required',
            ],
        ];
    }
}
