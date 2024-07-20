<?php

namespace App\Http\Controllers\Api\V1\Merchant;

use App\Http\Controllers\Controller;
use App\Http\Helpers\GlobalHelper;
use App\Http\Helpers\ResponseHelper;
use App\Http\Helpers\ValidationHelper;
use App\Http\Resources\Merchant\StoreProductListCollection;
use App\Http\Resources\Merchant\StoreProductListResource;
use App\Http\Resources\Merchant\StoreProductSingleResource;
use App\Models\Merchant;
use App\Models\MerchantStore;
use App\Models\MerchantStoreProduct;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StoreApiController extends Controller
{
    use ResponseHelper, ValidationHelper, GlobalHelper;

    public function create_store(Request $request) 
    {
        $locale     = (request()->header('lang') != null ? request()->header('lang') : 'en' );
        $merchantID = $this->getUserIDByToken(request()->bearerToken());
        app()->setLocale($locale);
        $validator = $this->ValidationHelper($request, [
            'store_name'        => ['required', 'string', 'max:255', 'unique:merchant_stores'],
            'color'             => ['required', 'in:avy,orange,pink,purple,red,violet,yellow,fuchsia,sky,grape'],
            'logo'              => ['required', 'image','mimes:jpeg,jpg,png,webp'],
        ]);
        if(!$validator['status']) {
            return $this->apiResponseHandler(404, false, __('request.not_found'), ['errors' => $validator['errors']]);
        }
        DB::beginTransaction();
        try {
            $store = MerchantStore::create([
                'color'         => $request->color,
                'store_name'    => $request->store_name,
                'logo'          => $this->uploadImage($request->logo),
                'api_key'       => $this->generateStoreAPIKey(),
                'merchant_id'   => $merchantID
            ]);    
            DB::commit();
            return $this->apiResponseHandler(200, true, __('request.data_retrieved'), $store);
        } catch (\Throwable $th) {
            Log::critical($th->getMessage());
            DB::rollBack();
            return $this->apiResponseHandler(500, false, __('request.try_later'));

        }   
    }
    public function verify(Request $request)
    {
        $store = MerchantStore::where('store_name', '=', $request->store_name)->first();
        if($store != null) {
            return $this->apiResponseHandler(200, true, 'success', $store);
        } else {
            return $this->apiResponseHandler(404, false, 'error');
 
        }
    }
    public function add_product(Request $request) 
    {
        $locale     = (request()->header('lang') != null ? request()->header('lang') : 'en' );
        $merchantID = $this->getUserIDByToken(request()->bearerToken());
        app()->setLocale($locale);
        $validator = $this->ValidationHelper($request, [
            'product_id'            => ['required', 'numeric', 'max:255', 'exists:products,id'],
            'selling_price'         => ['required', 'numeric'],
        ]);
        if(!$validator['status']) {
            return $this->apiResponseHandler(404, false, __('request.not_found'), ['errors' => $validator['errors']]);
        }
        $store = MerchantStore::where('merchant_id', '=', $merchantID)->first();
        if($store != null) {
            $store_id = $store->id;
            DB::beginTransaction();
            try {
                $check = MerchantStoreProduct::where('product_id', '=', $request->product_id)->where('store_id', '=', $store_id)->first();
                if($check == null)
                {
                    $pro = MerchantStoreProduct::create([
                        'product_id' 	=> $request->product_id,
                        'store_id'      => $store_id,
                        'selling_price' => $request->selling_price,
                    ]);    
                    DB::commit();
                    return $this->apiResponseHandler(200, true, 'product added', $pro);
                } else {
                    return $this->apiResponseHandler(401, false, 'product already Exist');
                }
            } catch (\Throwable $th) {
                Log::critical($th->getMessage());
                DB::rollBack();
                return $this->apiResponseHandler(500, false, __('request.try_later'));
    
            }  
        } else {
            return $this->apiResponseHandler(401, false, 'this merchant dose not have a store');
        }  
    }
    public function edit_product(Request $request) 
    {
        $validator = $this->ValidationHelper($request, [
            'product_id'            => ['required', 'numeric', 'max:255', 'exists:merchant_store_products,id'],
            'selling_price'         => ['required', 'numeric'],
        ]);
        if(!$validator['status']) {
            return $this->apiResponseHandler(404, false, __('request.not_found'), ['errors' => $validator['errors']]);
        }
        $pro = MerchantStoreProduct::find($request->product_id)
        ->update([
            'selling_price' => $request->selling_price,
        ]);
        return $this->apiResponseHandler(200, true, 'edited successfully');
    }
    public function remove_product(Request $request) 
    {
        $validator = $this->ValidationHelper($request, [
            'product_id'            => ['required', 'numeric', 'max:255', 'exists:merchant_store_products,id'],
        ]);
        if(!$validator['status']) {
            return $this->apiResponseHandler(404, false, __('request.not_found'), ['errors' => $validator['errors']]);
        }
        MerchantStoreProduct::find($request->product_id)->delete();
        return $this->apiResponseHandler(200, true, 'delete successfully');
    }
    public function list_products(Request $request) 
    {
        $locale     = (request()->header('lang') != null ? request()->header('lang') : 'en' );
        $merchantID = $this->getUserIDByToken(request()->bearerToken());
        app()->setLocale($locale);
        $carts      = MerchantStoreProduct::with('product')->where('store_id', '=', request()->header('store'))
        ->whereHas('product', function (Builder $query) {
            $query->where('country_id', '=', request()->header('country'));
        })->get();
        if(count($carts) > 0) {
            $carts->transform(function (MerchantStoreProduct $cart) {
                return (new StoreProductListResource($cart));
            });

            return $this->apiResponseHandler(200, true, __('request.data_retrieved'), new StoreProductListCollection($carts)); 
        } else {
            return $this->apiResponseHandler(404, false, __('request.not_found')); 
        }

    }
    public function list_products_store(Request $request) 
    {

        $carts      = MerchantStoreProduct::with('product', 'product.category')->where('store_id', '=', $request->storeID)->get();
       
        $carts->transform(function (MerchantStoreProduct $cart) {
            return (new StoreProductListResource($cart));
        });

        return $this->apiResponseHandler(200, true, __('request.data_retrieved'), new StoreProductListCollection($carts)); 
    }
    public function store_product(Request $request) 
    {
        $product      = MerchantStoreProduct::with('product', 'product.category')
        ->whereHas('product', function($q) use ($request) {
                $q->where('slug', '=', $request->slug);
            })
        ->where('store_id', '=', $request->storeID)
        ->first();
            if($product != null) {
                return $this->apiResponseHandler(200, true, __('request.data_retrieved'), new StoreProductSingleResource($product)); 

            } else {
                return $this->apiResponseHandler(404, false, __('request.not_found')); 

            }

    }
}