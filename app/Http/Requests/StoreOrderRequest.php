<?php

namespace App\Http\Requests;

use App\Models\Order;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOrderRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('order_create'),
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
            'admin_subtotal' => [
                'numeric',
                'required',
            ],
            'merchant_subtotal' => [
                'numeric',
                'required',
            ],
            'shipping_cost' => [
                'numeric',
                'required',
            ],
            'admin_grand_total' => [
                'numeric',
                'required',
            ],
            'merchant_grand_total' => [
                'string',
                'required',
            ],
            'admin_net_profit' => [
                'numeric',
                'required',
            ],
            'merchant_net_profit' => [
                'numeric',
                'required',
            ],
            'merchant_id' => [
                'integer',
                'exists:merchants,id',
                'required',
            ],
            'country_id' => [
                'integer',
                'exists:countries,id',
                'required',
            ],
            'city' => [
                'string',
                'max:255',
                'required',
            ],
            'address' => [
                'string',
                'max:255',
                'required',
            ],
            'address_2' => [
                'string',
                'max:255',
                'nullable',
            ],
            'notes' => [
                'string',
                'max:255',
                'nullable',
            ],
            'status' => [
                'nullable',
                'in:' . implode(',', array_keys(Order::STATUS_SELECT)),
            ],
        ];
    }
}
