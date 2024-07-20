<?php

namespace App\Http\Helpers;
use App\Models\Merchant;
use App\Models\MerchantStore;
use Illuminate\Support\Str;
use Laravel\Sanctum\PersonalAccessToken;

trait GlobalHelper
{
    public function generateMerchantCode() {
        return rand(9999, 999999);
    }
    public function generateMerchantReferralCode() {
        $arr = [];
       for ($i=0; $i < 3; $i++) {
            $arr[] = Str::random(4);
       }
       return implode('-', $arr);
    }
    public function generateOrderCode($generateMerchantCode) {
        $arr = [];
        $arr[] = $generateMerchantCode;
       for ($i=0; $i < 3; $i++) {
            $arr[] = Str::random(4);
       }
       return implode('-', $arr);
    }
    public function getUserIDByToken($hashedToken)
    {
        $token = PersonalAccessToken::findToken($hashedToken);
        if($token != null) {
            return $token->tokenable_id;

        } else {
            return false;
        }

    }
    public function getCountryIDByToken($hashedToken)
    {
        $token = PersonalAccessToken::findToken($hashedToken);
        if($token != null) {
            return $token->country_id;

        } else {
            return false;
        }
    }
    public function generateStoreAPIKey()  {
        
        $api_key =  Str::upper(Str::random(16));
       
        return $api_key;
    }
    public  function uploadImage($file)
    {
        // Validate the file
        if (!$file->isValid()) {
            return false;
        }

        // Define the directory to store the logo
        $directory = 'uploads';

        // Generate a unique filename for the logo
        $filename = uniqid() . '_' . $file->getClientOriginalName();

        // Move the uploaded file to the storage directory
        $file->move(public_path($directory), $filename);

        // Return the path to the uploaded logo
        return $directory . '/' . $filename;
    }
}
