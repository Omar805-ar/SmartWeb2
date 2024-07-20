<?php

namespace App\Http\Requests;

use App\Models\Merchant;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMerchantRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('merchant_edit'),
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
                'unique:merchants,email,' . request()->route('merchant')->id,
            ],
            'phone' => [
                'string',
                'min:10',
                'max:25',
                'required',
                'unique:merchants,phone,' . request()->route('merchant')->id,
            ],
            'referral_code' => [
                'string',
                'required',
                'unique:merchants,referral_code,' . request()->route('merchant')->id,
            ],
        ];
    }
}
