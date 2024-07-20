<?php

namespace App\Http\Controllers\Api\V1\Merchant;

use App\Http\Controllers\Controller;
use App\Http\Helpers\GlobalHelper;
use App\Http\Helpers\ResponseHelper;
use App\Http\Helpers\ValidationHelper;
use App\Http\Services\Twilio\VerifyPhoneService;
use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Propaganistas\LaravelPhone\Rules\Phone;
use Propaganistas\LaravelPhone\PhoneNumber;
class VerifyPhoneController extends Controller
{
    use ResponseHelper, ValidationHelper, GlobalHelper;
    
    
    public function resend_otp(Request $request)
    {        
        app()->setLocale($request->header('lang'));
        $validator = $this->ValidationHelper($request, [
            'phone'             => [
                'required', 
                'string',
                'min:10', 
                'max:25', 
                Rule::unique('merchants', 'phone'),
                (new Phone)->country(['EG', 'AE', 'SA'])
            ]
        ]);
        if(!$validator['status']) {
            return $this->apiResponseHandler(401, false, __('request.invalid_credential'), ['errors' => $validator['errors']]); 
        }
        $merchantID     = $this->getUserIDByToken(request()->bearerToken());
        $formattedPhone = Merchant::select('id', 'phone')->find($merchantID)->phone;

        $verify = new VerifyPhoneService();
        $res = $verify->verifyPhone($formattedPhone);
        if(!$res['status']) {
            return $this->apiResponseHandler(500, false, $res['message']); 
        }
        return $this->apiResponseHandler(200, true, $res['message']); 
    }
    public function verify_otp(Request $request)
    {        
        app()->setLocale($request->header('lang'));
        $validator = $this->ValidationHelper($request, [
            'code'              => ['required', 'string','min:6', 'max:6'],
        ]);
        if(!$validator['status']) {
            return $this->apiResponseHandler(401, false, __('request.invalid_credential'), ['errors' => $validator['errors']]); 
        }
        $merchantID     = $this->getUserIDByToken(request()->bearerToken());
        $merchant       = Merchant::select('id', 'phone', 'phone_verified_at')->find($merchantID);
        $formattedPhone = $merchant->phone;
        $verify         = new VerifyPhoneService();
        $res            = $verify->verifyOTP($formattedPhone, $request->code);
        
        if($res['status']) {
            $merchant->update(['phone_verified_at' => now()]);
            return $this->apiResponseHandler(200, true, $res['message'], []); 
        } else {
            return $this->apiResponseHandler(401, false, $res['message'], []); 
        }
    }
}
