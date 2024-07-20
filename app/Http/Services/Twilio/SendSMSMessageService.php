<?php

namespace App\Http\Services\Twilio;

use App\Http\Helpers\GlobalHelper;
use App\Http\Helpers\ResponseHelper;
use App\Http\Helpers\ValidationHelper;
use App\Models\Merchant;
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;

class SendSMSMessageService
{
    use ResponseHelper, ValidationHelper, GlobalHelper;
    public $token;
    public $twilio_sid;
    public $twilio_verify_sid;
    public function __construct()
    {
        $this->token = getenv("TWILIO_AUTH_TOKEN");
        $this->twilio_sid = getenv("TWILIO_SID");
        $this->twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
    }
    public function send_sms($message, $phone)
    {
        try {
            $client = new Client($this->twilio_sid, $this->token);
            $client->messages->create($phone, [
                'from' => '+14144347038',
                'body' => $message
            ]);
            return [
                'status' => true,
                'message' => __('request.message_sent')
            ];
        } catch (\Throwable $th) {
            Log::critical($th->getMessage());
            return [
                'status' => false,
                'message' => __('request.try_later')
            ];
        }
    }
}
