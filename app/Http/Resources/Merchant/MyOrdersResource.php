<?php

namespace App\Http\Resources\Merchant;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MyOrdersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'order_id'          => $this->id,
            'merchant_name'     => $this->merchant->first_name .  ' ' . $this->merchant->last_name,
            'merchant_phone'    => $this->merchant->phone,
            'quantity'          => $this->order_item->sum('quantity'),
            'status'            => $this->status,
            'paid'              => $this->paid,
            'grand_total'       => $this->grand_total,
            'currency_code'     => $this->country->currency_code??'',
            'created_at'        => date('d-m-Y h:j a', strtotime($this->created_at)),

        ];
    }
}
