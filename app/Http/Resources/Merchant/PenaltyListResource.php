<?php

namespace App\Http\Resources\Merchant;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PenaltyListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'reason'    => $this->reason,
            'amount'    => $this->amount . ' ' . $this->country->currency_code,
            'created_at'    => date('d-m-Y', strtotime($this->created_at)),

        ];
    }
}
