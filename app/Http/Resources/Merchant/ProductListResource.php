<?php

namespace App\Http\Resources\Merchant;

use App\Models\Favorite;
use App\Models\CartModel;
use App\Models\MerchantStoreProduct;
use Illuminate\Http\Request;
use App\Http\Helpers\GlobalHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductListResource extends JsonResource
{
    use GlobalHelper;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $merchantID = $this->getUserIDByToken(request()->bearerToken());
        $store_id = request()->header('store');

        return [
            'id'                => $this->id,
            'in_cart'           => CartModel::where('merchant_id','=', $merchantID)->where('product_id', '=', $this->id)->count() > 0 ? true : false,
            'in_store'           => MerchantStoreProduct::where('store_id','=', $store_id)->where('product_id', '=', $this->id)->count() > 0 ? true : false,
            'in_favorite'       => Favorite::where('merchant_id','=', $merchantID)->where('product_id', '=', $this->id)->count() > 0 ? true : false,
            'product_code'      => $this->product_code,
            'quantity'          => 1,
            'slug'              => $this->slug,
            'title'             => $this->translate($request->header('lang'))->name,
            'description'       => $this->translate($request->header('lang'))->description,
            'price'             => $this->price,
            'currency_code'     => $this->country->currency_code,
            'category'          => new CategoryListResource($this->category),
            'main_image'        => (count($this->thumbnail) > 0 ? $this->thumbnail[0]['url'] : null ),



        ];
    }
}


