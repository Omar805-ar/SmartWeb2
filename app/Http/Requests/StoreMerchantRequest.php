<?php

namespace App\Http\Requests;

use App\Models\Merchant;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMerchantRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('merchant_create'),
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
            'first_name' => [
                'string',
                'min:4',
                'max:255',
                'required',
            ],
            'last_name' => [
                'string',
                'min:4',
                'max:255',
                'required',
            ],
            'email' => [
                'email:rfc',
                'required',
                'unique:merchants,email',
            ],
            'phone' => [
                'string',
                'min:10',
                'max:25',
                'required',
                'unique:merchants,phone',
            ],
            'referral_code' => [
                'string',
                'required',
                'unique:merchants,referral_code',
            ],
        ];
    }
}
