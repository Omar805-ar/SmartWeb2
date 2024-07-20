<?php

namespace App\Http\Controllers\Api\V1\Merchant;

use App\Http\Controllers\Controller;
use App\Http\Helpers\GlobalHelper;
use App\Http\Helpers\ResponseHelper;
use App\Http\Helpers\ValidationHelper;
use App\Models\Government;
use Illuminate\Http\Request;

class ShippingController extends Controller
{

    use ResponseHelper, ValidationHelper, GlobalHelper;
    
    public function get_governments()
    {
        $locale     = (request()->header('lang') != null ? request()->header('lang') : 'en' );
        app()->setLocale($locale);

        $data = [];

        foreach (Government::with('country:id,currency_code')->get() as $gov) {
            $data[] = [
                'id'                => $gov->id,
                'name'              => $gov->translate($locale)->name,
                'shipping_cost'     => $gov->shipping_cost,
                'currency'          => $gov->country->currency_code
            ];
        }
        return $this->apiResponseHandler(200, true, __('request.data_retrieved'), $data); 
    } 

    public function get_shipping(int $id) 
    {
       
        $gov = Government::with('country:id,currency_code')->find($id);
        if($gov != null)
        {
            return $this->apiResponseHandler(200, true, __('request.data_retrieved'), [
                'shipping_cost' => $gov->shipping_cost,
                'currency'      => $gov->country->currency_code
            ]); 

        } else {
            return $this->apiResponseHandler(404, false, __('request.not_found')); 

        }

    }
}
