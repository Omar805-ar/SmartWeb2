<?php

namespace App\Http\Services\Twilio;
use App\Http\Helpers\GlobalHelper;
use App\Http\Helpers\ResponseHelper;
use App\Http\Helpers\ValidationHelper;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;

class VerifyPhoneService
{
    use ResponseHelper, ValidationHelper, GlobalHelper;
    public $token;
    public $twilio_sid;
    public $twilio_verify_sid;
    public function __construct() {
        $this->token              = getenv("TWILIO_AUTH_TOKEN");
        $this->twilio_sid         = getenv("TWILIO_SID");
        $this->twilio_verify_sid  = getenv("TWILIO_VERIFY_SID");
    }
    public function verifyPhone($phone)
    {
       try {
            $twilio             = new Client($this->twilio_sid, $this->token);
            $twilio->verify->v2->services($this->twilio_verify_sid)->verifications->create($phone, "sms");
            return [
                'status'    => true,
                'message'   => __('request.otp_sent')
            ];
       } catch (\Throwable $th) {
            Log::critical($th->getMessage());
            return [
                'status'    => false,
                'message'   => __('request.try_later')
            ];
        }
    }
    public function verifyOTP($phone, $otp)
    {
        try {
            $twilio = new Client($this->twilio_sid, $this->token);
            $verification_check = $twilio->verify->v2->services($this->twilio_verify_sid)->verificationChecks->create([
                "to" => $phone,
                "code" => $otp
            ]);
            if($verification_check->valid && $verification_check->status == 'approved') {
                return [
                    'status'    => true,
                    'message'   => __('request.phone_verified')
                ];
            } else {
                return [
                    'status'    => false,
                    'message'   => __('request.invalid_otp_verification')
                ];
            }   
        } catch (\Throwable $th) {
            Log::critical($th->getMessage());
            return [
                'status'    => false,
                'message'   => __('request.try_later')
            ];
        }
    }
}
