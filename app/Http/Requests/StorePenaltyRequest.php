<?php

namespace App\Http\Requests;

use App\Models\Penalty;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePenaltyRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('penalty_create'),
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
            'merchant_id' => [
                'integer',
                'exists:merchants,id',
                'required',
            ],
            'reason' => [
                'string',
                'max:255',
                'nullable',
            ],
            'amount' => [
                'numeric',
                'required',
            ],
            'country_id' => [
                'integer',
                'exists:countries,id',
                'required',
            ],
        ];
    }
}
