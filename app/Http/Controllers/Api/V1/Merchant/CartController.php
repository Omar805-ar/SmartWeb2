<?php

namespace App\Http\Controllers\Api\V1\Merchant;
use App\Http\Controllers\Controller;
use App\Http\Helpers\GlobalHelper;
use App\Http\Helpers\ResponseHelper;
use App\Http\Helpers\ValidationHelper;
use App\Http\Resources\Merchant\CartListCollection;
use App\Http\Resources\Merchant\CartListResource;
use App\Models\CartModel;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    use ResponseHelper, ValidationHelper, GlobalHelper;

    public function add_to_cart(Request $request)
    {
        $merchantID = $this->getUserIDByToken(request()->bearerToken());
        $product    = Product::find((int)$request->product_id)->first();
        $locale     = ($request->header('lang') != null ? $request->header('lang') : 'en' );
        app()->setLocale($locale);
        $validator = $this->ValidationHelper($request, [
            'product_id'        => ['required', 'exists:products,id'],
        ]);
        if(!$validator['status']) {
            return $this->apiResponseHandler(404, false, __('request.not_found'), ['errors' => $validator['errors']]);
        }

        DB::beginTransaction();
        try {
            $check = CartModel::where('product_id', '=', $request->product_id)
            ->where('merchant_id', '=', $merchantID)
            ->first();

            if($check == null)
            {

                CartModel::create([
                    'product_id'    => $request->product_id,
                    'merchant_id'   => $merchantID,
                    'quantity'      => 1,
                    'total'         => $product->price
                ]);

                DB::commit();
                return $this->apiResponseHandler(200, true, __('request.added_successfully'));

            } else {
                DB::rollBack();
                return $this->apiResponseHandler(401, false, __('request.already_exists'));
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->apiResponseHandler(401, false, __('request.something_went_wrong'), ['errors' => $th->getMessage()]);
        }
    }
    public function get_cart(Request $request)
    {
        $locale     = ($request->header('lang') != null ? $request->header('lang') : 'en' );
        app()->setLocale($locale);
        $merchantID = $this->getUserIDByToken(request()->bearerToken());
        $carts      = CartModel::where('merchant_id', '=', $merchantID)->get();
        if(count($carts) > 0) {
            $carts->transform(function (CartModel $cart) {
                return (new CartListResource($cart));
            });
            return $this->apiResponseHandler(200, true, __('request.data_retrieved'), new CartListCollection($carts));
        } else {
            return $this->apiResponseHandler(200, true, __('request.data_retrieved'), []);
        }
        
    }
    public function delete($id)
    {
        $locale     = (request()->header('lang') != null ? request()->header('lang') : 'en' );
        $merchantID = $this->getUserIDByToken(request()->bearerToken());

        app()->setLocale($locale);

        $check =  CartModel::where('product_id', '=', $id)
        ->where('merchant_id', '=', $merchantID)
        ->first();

        if($check != null)
        {
            $check->delete();

            return $this->apiResponseHandler(200, true, __('request.data_retrieved'));

        } else {
            return $this->apiResponseHandler(500, false, __('request.data_retrieved'));

        }


    }

    }
