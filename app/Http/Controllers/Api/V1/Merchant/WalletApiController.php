<?php

namespace App\Http\Controllers\Api\V1\Merchant;

use App\Models\Country;
use App\Models\Wallet;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Helpers\GlobalHelper;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ResponseHelper;
use App\Http\Helpers\ValidationHelper;
use App\Http\Resources\Merchant\WalletResource;

class WalletApiController extends Controller
{
    use ResponseHelper, ValidationHelper, GlobalHelper;

    public function get_balance(Request $request)
    {
        $merchantID = $this->getUserIDByToken(request()->bearerToken());
        foreach (Country::get() as $country) {
            if (Wallet::where('merchant_id','=', $merchantID)->where('country_id','=', $country->id)->first() == null) {
                Wallet::create([
                    'merchant_id'   => $merchantID,
                    'country_id'    => $country->id,
                    'balance'       => 0,
                ]);
            }
            
        }
        $wallet = Wallet::where('merchant_id','=', $merchantID)->get();

        return $this->apiResponseHandler(200, true, __('request.data_retrieved'),WalletResource::collection($wallet));
    }
    public function request_exchange(Request $request)
    {
        $merchantID = $this->getUserIDByToken(request()->bearerToken());
        $wallet = Wallet::find($request->wallet_id)->update([
            'request_exchange' => 1
        ]);
        return $this->apiResponseHandler(200, true, __('request.data_retrieved'));
    }

}
