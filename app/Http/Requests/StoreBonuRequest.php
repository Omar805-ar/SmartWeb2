<?php

namespace App\Http\Requests;

use App\Models\Bonu;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBonuRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('bonu_create'),
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
            'min_orders' => [
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'required',
            ],
            'minimum_order_amount' => [
                'numeric',
                'required',
            ],
            'bonus' => [
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
