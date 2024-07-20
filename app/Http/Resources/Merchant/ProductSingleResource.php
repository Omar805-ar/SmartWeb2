<?php

namespace App\Http\Resources\Merchant;

use App\Http\Helpers\GlobalHelper;
use App\Models\CartModel;
use App\Models\Color;
use App\Models\MerchantStoreProduct;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductSingleResource extends JsonResource
{
    use GlobalHelper;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $colors = $this->colors->transform(function (Color $color) {
            return (new ColorSingleResource($color));
        });
        $sizes = $this->sizes->transform(function (Size $size) {
            return (new SizeSingleResource($size));
        });
        $merchantID = $this->getUserIDByToken(request()->bearerToken());
        $store_id = request()->header('store_id');
        return [
            'id'                => $this->id,
            'in_cart'           => CartModel::where('merchant_id','=', $merchantID)->where('product_id', '=', $this->id)->count() > 0 ? true : false, 
            'in_store'           => MerchantStoreProduct::where('store_id','=', $store_id)->where('product_id', '=', $this->id)->count() > 0 ? true : false,
            'slug'              => $this->slug,
            'product_code'      => $this->product_code,
            'quantity'          => 1,
            'title'             => $this->translate($request->header('lang'))->name,
            'description'       => $this->translate($request->header('lang'))->description,
            'meta_description'  => $this->translate($request->header('lang'))->meta_description,
            'features'          => $this->translate($request->header('lang'))->features,
            'price'             => $this->price,
            'currency_code'     => $this->country->currency_code,
            'main_image'        => (count($this->thumbnail) > 0 ? $this->thumbnail[0]['url'] : null ),
            'images'            => $this->images,
            'videos'            => $this->videos,
            'category'          => new CategorySingleResource($this->category),
            'colors'            => new ColorSingleCollection($colors),
            'sizes'             => new SizeSingleCollection($sizes),

        ];
    }
}
