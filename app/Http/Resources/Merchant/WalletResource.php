<?php

namespace App\Http\Resources\Merchant;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WalletResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return   [
            'wallet_id'      => $this->id,
            'country_name'   => $this->country->translate($request->header('lang'))->name,
            'flag'           => $this->country->flag,
            'currency_code'  => $this->country->currency_code,
            'balance'        => $this->balance,
            'status_exchange' =>( $this->request_exchange==1)?'pending':null,  //1 = panding exchange

        ];
    }
}
