<?php

namespace App\Http\Controllers\Api\V1\Merchant;
use App\Models\Product;
use App\Models\Favorite;
use App\Models\CartModel;
use Illuminate\Http\Request;
use App\Http\Helpers\GlobalHelper;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Helpers\ResponseHelper;
use App\Http\Helpers\ValidationHelper;
use App\Http\Resources\Merchant\FavListResource;
use App\Http\Resources\Merchant\CartListResource;
use App\Http\Resources\Merchant\CartListCollection;

class FavoriteController extends Controller
{
    use ResponseHelper, ValidationHelper, GlobalHelper;

    public function add_to_favorite(Request $request)
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
            $check = Favorite::where('product_id', '=', $request->product_id)
            ->where('merchant_id', '=', $merchantID)
            ->first();

            if($check == null)
            {

                Favorite::create([
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
    public function get_favorite(Request $request)
    {
        $locale     = ($request->header('lang') != null ? $request->header('lang') : 'en' );
        app()->setLocale($locale);
        $merchantID = $this->getUserIDByToken(request()->bearerToken());
        $favorite      = Favorite::where('merchant_id', '=', $merchantID)->get();

        $favorite->transform(function (Favorite $favorite) {
            return (new FavListResource($favorite));
        });
        return $this->apiResponseHandler(200, true, __('request.data_retrieved'), new CartListCollection($favorite));
    }
    public function get_favorite_count(Request $request)
    {
        $merchantID = $this->getUserIDByToken(request()->bearerToken());
        $favorite_count      = Favorite::where('merchant_id', '=', $merchantID)->count();

        return $this->apiResponseHandler(200, true, __('request.data_retrieved'), ['count'=>$favorite_count]);
    }
    public function delete($id)
    {
        $locale     = (request()->header('lang') != null ? request()->header('lang') : 'en' );
        $merchantID = $this->getUserIDByToken(request()->bearerToken());

        app()->setLocale($locale);

        $check =  Favorite::where('product_id', '=', $id)
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
