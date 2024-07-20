<?php

namespace App\Http\Controllers\Api\V1\Merchant;

use App\Models\Order;
use App\Models\Product;
use App\Models\Government;
use Illuminate\Http\Request;
use App\Http\Helpers\GlobalHelper;
use Illuminate\Support\Facades\DB;
use App\Http\Helpers\PaymentHelper;
use App\Http\Controllers\Controller;
use App\Http\Helpers\ResponseHelper;
use App\Http\Helpers\ValidationHelper;
use App\Http\Resources\Merchant\MyOrdersResource;
use App\Models\Country;
use App\Models\OrderItem;
use Nafezly\Payments\Classes\TapPayment;
use Propaganistas\LaravelPhone\PhoneNumber;
use Propaganistas\LaravelPhone\Rules\Phone;

class DashboardMerchantApiController extends Controller
{
    use ResponseHelper, ValidationHelper, GlobalHelper, PaymentHelper;

    public function statistics(Request $request)
    {
        $merchantID = $this->getUserIDByToken(request()->bearerToken());
        if ($request->header('country') != null) {
            $country_id = $request->header('country');
        } else {
            $country_id = 1;
        }

        $orders_count         = order::where(['merchant_id' =>  $merchantID, 'country_id' => $country_id])->count();
        $orders_sales         = order::where(['merchant_id' =>  $merchantID, 'country_id' => $country_id])->sum('grand_total');
        $status_pending_count = order::where(['merchant_id' =>  $merchantID, 'country_id' => $country_id, 'status' => 'pending'])->count();
        $status_success_count = order::where(['merchant_id' =>  $merchantID, 'country_id' => $country_id, 'status' => 'success'])->count();
        $status_return_count  = order::where(['merchant_id' =>  $merchantID, 'country_id' => $country_id, 'status' => 'return'])->count();
        $status_cancel_count  = order::where(['merchant_id' =>  $merchantID, 'country_id' => $country_id, 'status' => 'cancel'])->count();
        $status_paid_count    = order::where(['merchant_id' =>  $merchantID, 'country_id' => $country_id, 'paid'   =>  1])->count();
        $status_notpaid_count = order::where(['merchant_id' =>  $merchantID, 'country_id' => $country_id, 'paid'   =>  0])->count();
        $currency_code = Country::find($country_id)->currency_code;

        $data = [
            'currency_code'        => $currency_code        ?? '0',
            'orders_count'         => $orders_count         ?? '0',
            'orders_sales'         => $orders_sales         ?? '0',
            'status_pending_count' => $status_pending_count ?? '0',
            'status_success_count' => $status_success_count ?? '0',
            'status_cancel_count'  => $status_cancel_count  ?? '0',
            'status_return_count'  => $status_return_count  ?? '0',
            'status_paid_count'    => $status_paid_count    ?? '0',
            'status_notpaid_count' => $status_notpaid_count ?? '0',
        ];
        return $this->apiResponseHandler(200, true, __('request.data_retrieved'), $data);
    }
}
