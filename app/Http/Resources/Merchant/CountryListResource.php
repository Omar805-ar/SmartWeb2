<?php

namespace App\Http\Resources\Merchant;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return   [
            'id'                => $this->id,
            'name'              => $this->translate($request->header('lang'))->name,
            'iso'               => $this->iso,
            'currency_code'     => $this->currency_code,
            'flag'              => $this->flag,
        ];
    }
}
