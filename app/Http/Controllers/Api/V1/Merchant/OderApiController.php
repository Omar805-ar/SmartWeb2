<?php

namespace App\Http\Controllers\Api\V1\Merchant;

use App\Models\Client;
use App\Models\MerchantStore;
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
use App\Models\OrderItem;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Nafezly\Payments\Classes\TapPayment;
use Propaganistas\LaravelPhone\Exceptions\NumberParseException;
use Propaganistas\LaravelPhone\PhoneNumber;
use Propaganistas\LaravelPhone\Rules\Phone;

class OderApiController extends Controller
{
    use ResponseHelper, ValidationHelper, GlobalHelper, PaymentHelper;
    public function create_order(Request $request)
    {
        $locale     = (request()->header('lang') != null ? request()->header('lang') : 'en');
        $country = null;
        app()->setLocale($locale);
        $government = Government::find($request['formData']['city_id']);
        if ($government == null) {
            return $this->apiResponseHandler(404, false, __('request.not_foend'), __('request.city_id_not_found'));
        }
        try {
            $formattedPhone = new PhoneNumber($request['formData']['phone'], 'EG');
            $country = 'EG';
        } catch (\Throwable $th) {

            try {
                $formattedPhone = new PhoneNumber($request['formData']['phone'], 'SA');
                $country = 'SA';
            } catch (\Throwable $th) {

                try {
                    $formattedPhone = new PhoneNumber($request['formData']['phone'], 'EA');
                    $country = 'EA';
                } catch (\Throwable $th) {

                    return $this->apiResponseHandler(401, false, 'Phone is not valid');

                }
                
            }
        }
        if($formattedPhone->isOfCountry($country)) {
            DB::beginTransaction();
            try {
               $merchantID     = $this->getUserIDByToken(request()->bearerToken());
   
               $formattedPhone = $formattedPhone->formatE164();
               $shipping_cost  = $government->shipping_cost;
               $products_total = 0;
               foreach ($request['products_cart'] as $product) {
                   foreach ($product as $item) {
   
                       $products_total += Product::find($item['id'])->price * $item['quantity'];
                   }
               }
               $grand_total = $products_total + $shipping_cost;
               $order =   Order::create([
                   'subtotal'              => $products_total,
                   'shipping_cost'         => $shipping_cost,
                   'grand_total'           => $grand_total,
                   'city'                  => $request['formData']['region'],
                   'address'               => $request['formData']['details_address'],
                   'notes'                 => $request['formData']['other_notes'],
                   'merchant_id'           => $merchantID,
                   'country_id'            => request()->header('country'),
               ]);
   
               foreach ($request['products_cart'] as $product) {
                   foreach ($product as $item) {
                       $product = Product::find($item['id']);
                       $products_total += $product->price * $item['quantity'];
                       OrderItem::create([
                           'order_id' => $order->id,
                           'product_id' =>  $item['id'],
                           'quantity' =>   $item['quantity'],
                           'selling_price_for_client' => $product->price,
                           'selling_price_for_merchant' => $product->price,
                           'total_profit_for_merchant' => $products_total
                       ]);
                   }
               }
               if ($request['formData']['payment'] != 'cash') {
                   if ($request['formData']['gateway'] == 'tap') {
                       $payment = $this->tap($request, $grand_total, $merchantID);
                       $redirect_url = $payment['redirect_url'];
                       $paymentjson =   json_encode($payment);
                       $order->update([
                        'payment_gateway_data'=> $paymentjson,
                        'payment_id'=> $payment['payment_id'],
                        'payment_method'=> $request['formData']['gateway'],
                       ]);
                    
                    }
               } else {
                $order->update([
                    'payment_method'=> 'cash',
                    'paid'=> 0,

                ]);
               }
               DB::commit();
   
               return $this->apiResponseHandler(200, true, __('request.data_retrieved'), [
                'redirect_url'      => $redirect_url ?? '',
                'payment_method'    => $order->payment_method
            ]);
          } catch (\Throwable $th) {
               DB::rollBack();
               return $th;
           }
        } else {
            return $this->apiResponseHandler(401, false, 'Phone is not valid');

        }
    }
    public function payment_verify(Request $request)
    {
        //return ($request->all());
        $payment    = new TapPayment();
        $res        = $payment->verify($request);
        return $res;
    }
    public function payment_result(Request $request)
    {
        $payment    = new TapPayment();
        $res        = $payment->verify($request);
        if ($res['success']) {
            $order = Order::where('payment_id', $res['payment_id'])->first();
            if ($order != null) {
                $order->paid = 1;
                $order->save();

                 
                return $this->apiResponseHandler(200, true, __('request.payment_succes'));
            } else {
                return $this->apiResponseHandler(200, false, 'payment_id Not found');
            }
        }
        return $this->apiResponseHandler(200, false, __('request.payment_error'));
    }
  
  
   
  
  
  
  
  
  
  
  
  
      public function create_order_store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'phone'     => 'required|string|max:25',
            'email'     => 'required|email|max:255',
            'city'      => 'required|string|max:255',
            'city_id'   => 'required|integer',
            'address'   => 'string|required',
            'address2'  => 'nullable|string',
            'note'      => 'nullable|string',

            

        ]);
        $locale     = (request()->header('lang') != null ? request()->header('lang') : 'en');
        $store = MerchantStore::find($request->store_id);
        
        $country = null;
        app()->setLocale($locale);
        $government = Government::find($request->city_id);
        if ($government == null) {
            return $this->apiResponseHandler(404, false, __('request.not_foend'), __('request.city_id_not_found'));
        }
        try {
            $formattedPhone = new PhoneNumber($request->phone, 'EG');
            $country = 'EG';
        } catch (\Throwable $th) {

            try {
                $formattedPhone = new PhoneNumber($request->phone, 'SA');
                $country = 'SA';
            } catch (\Throwable $th) {

                try {
                    $formattedPhone = new PhoneNumber($request->phone, 'EA');
                    $country = 'EA';
                } catch (\Throwable $th) {

                    return $this->apiResponseHandler(401, false, 'Phone is not valid');

                }
                
            }
        }
        if($formattedPhone->isOfCountry($country)) {
            DB::beginTransaction();
            try {
               $formattedPhone = $formattedPhone->formatE164();
               $shipping_cost  = $government->shipping_cost;
               $products_total = 0;
               foreach ($request->products_cart as $product) {
                   $products_total += $product['price'] * $product['qty'];
               }
               // Client::create();
               $grand_total = $products_total + $shipping_cost;
               $order =   Order::create([
                   'subtotal'              => $products_total,
                   'shipping_cost'         => $shipping_cost,
                   'grand_total'           => $grand_total,
                   'city'                  => $request->city,
                   'address'               => $request->address,
                   'address2'               => $request->address2,
                   'notes'                 => $request->note,
                   'merchant_id'           => $store->merchant_id,
                   'country_id'            => $government->country_id,
                 	'in_store'				=> 1,
                 	'store_name'			=> $store->name,
               ]);
   
               foreach ($request->products_cart as $product) {
                       $original_product = Product::find($product['id']);
                       $products_total += $product['price'] * $product['qty'];
                       OrderItem::create([
                           'order_id' => $order->id,
                           'product_id' =>  $product['id'],
                           'quantity' =>   $product['qty'],
                           'selling_price_for_client' => $product['price'] * $product['qty'],
                           'selling_price_for_merchant' => $original_product->price * $product['qty'],
                           'total_profit_for_merchant' => $products_total
                       ]);
                   
               }
               if ($request->payment != 'cash') {
                   if ($request->payment == 'tap') {
                       $payment = $this->tap($request, $grand_total, $store->merchant_id);
                       $redirect_url = $payment['redirect_url'];
                       $paymentjson =   json_encode($payment);
                       $order->update([
                        'payment_gateway_data'=> $paymentjson,
                        'payment_id'=> $payment['payment_id'],
                        'payment_method'=> $request->gateway,
                       ]);
                    
                    }
               } else {
                $order->update([
                    'payment_method'=> 'cash',
                    'paid'=> 0,

                ]);
               }
               DB::commit();
   
               return $this->apiResponseHandler(200, true, __('request.data_retrieved'), [
                'redirect_url'      => $redirect_url ?? '',
                'payment_method'    => $order->payment_method
            ]);
          } catch (\Throwable $th) {
               DB::rollBack();
               return $th;
           }
        } else {
            return $this->apiResponseHandler(401, false, 'Phone is not valid');

        }
    }
    
    public function my_orders(Request $request)
    {
        $merchantID = $this->getUserIDByToken(request()->bearerToken());
        $orders = order::where(['merchant_id' =>  $merchantID])->with(['merchant', 'order_item'])->get();

        return $this->apiResponseHandler(200,true, __('request.data_retrieved'),MyOrdersResource::collection($orders));
    }
}
