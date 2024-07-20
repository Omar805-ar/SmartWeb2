<?php

namespace App\Http\Controllers\Api\V1\Merchant;

use App\Events\SendMessage;
use App\Http\Controllers\Controller;
use App\Http\Helpers\GlobalHelper;
use App\Http\Helpers\ResponseHelper;
use App\Http\Helpers\ValidationHelper;
use App\Http\Resources\Merchant\ChatResource;
use App\Http\Services\Twilio\VerifyPhoneService;
use App\Mail\forgetPassword;
use App\Models\Chat;
use App\Models\Country;
use App\Models\Merchant;
use App\Models\MerchantStore;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password AS ResetPass;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Propaganistas\LaravelPhone\Rules\Phone;
use Propaganistas\LaravelPhone\PhoneNumber;
use Resend\Laravel\Facades\Resend;

class AuthenticationController extends Controller
{
    use ResponseHelper, ValidationHelper, GlobalHelper;
    public function checkIfCodeIsUnique($column, $code)
    {
        if($column == 'merchant_code') {
            if(Merchant::where('merchant_code', '=', $code)->first() == null) {
                return $code;
            } else {
                return rand(10000, 99999) + $code;
            }
        } else if($column == 'referral_code') {
            if(Merchant::where('referral_code', '=', $code)->first() == null) {
                return $code;
            } else {
                return rand(10000, 99999) .'-'. $code;
            }
        }

    }
    public function register(Request $request) {
        $locale     = (request()->header('lang') != null ? request()->header('lang') : 'en' );
        app()->setLocale($locale);
        $validator = $this->ValidationHelper($request, [
            'first_name'        => ['required', 'string','min:4', 'max:255'],
            'last_name'         => ['required', 'string','min:4', 'max:255'],
            'email'             => ['required', 'email','min:4', 'max:255', Rule::unique('merchants', 'email')],
            'phone'             => [
                'required',
                'string',
                'min:10',
                'max:25',
                Rule::unique('merchants'),
                (new Phone)->country(['EG', 'AE', 'SA'])
            ],
            'password'          => ['required', 'string',  Password::min(8)
            ->letters()
            ->mixedCase()
            ->numbers()
            ->symbols()
            ->uncompromised()],
            'confirm_password'  => ['required', 'same:password'],
        ]);



        if(!$validator['status']) {
            return $this->apiResponseHandler(401, false, __('request.invalid_credential'), ['errors' => $validator['errors']]);
        }

        DB::beginTransaction();

        try {
            $formattedPhone = new PhoneNumber($request->phone, 'EG');
            $formattedPhone = $formattedPhone->formatE164();
            $phoneCheck = Merchant::select('id','phone')->where('phone', '=', $formattedPhone)->first();
            if($phoneCheck == null) {
                $merchant = Merchant::create([
                    'first_name'        => $request->first_name,
                    'last_name'         => $request->last_name,
                    'email'             => $request->email,
                    'phone'             => $formattedPhone,
                    'password'          => Hash::make($request->password),
                    'merchant_code'     => $this->checkIfCodeIsUnique('merchant_code', $this->generateMerchantCode()),
                    'referral_code'     => $this->checkIfCodeIsUnique('referral_code', $this->generateMerchantReferralCode()),
                ]);
                // $verify = new VerifyPhoneService();
                // $res = $verify->verifyPhone($formattedPhone);
                // if(!$res['status']) {
                //     return $this->apiResponseHandler(500, false, $res['message']);
                // }
    
    
                $credentials = $request->only(['email', 'password']);
    
                if(auth()->guard('merchants-api')->attempt($credentials)) {
    
                    $data = [
                        'merchant'  => [
                            "id"                => $merchant->id,
                            'first_name'        => $merchant->first_name,
                            'last_name'         => $merchant->last_name,
                            'email'             => $merchant->email,
                            'phone'             => $merchant->phone,
                            'referral_code'     => $merchant->referral_code,
                            'merchant_code'     => $merchant->merchant_code,
                            'has_steps'         => $merchant->has_steps,
                            'phone_verified_at' => $merchant->phone_verified_at,
                            'email_verified_at' => $merchant->email_verified_at,
                            "created_at"        => $merchant->created_at,
                        ],
                        'token'                 => $merchant->createToken('alrowadApp', ['merchant'], now()->addDay())->plainTextToken,
                        "has_store"             => false,
                        'store_id'              => null,
    
                    ];
                    DB::commit();
    
                    return $this->apiResponseHandler(200, true, __('request.merchant_registered'), $data);
                }
                DB::rollBack();
    
                return $this->apiResponseHandler(500, false, __('request.try_later'));
    
            } else {
                return $this->apiResponseHandler(401, false, __('request.invalid_credential'), ['errors' => [
                    'phone' => ['phone must be unique']
                ]]);

            }

            // Create Merchant
          
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::critical($th->getMessage());
            return $this->apiResponseHandler(500, false, $th->getMessage());

        }

    }
    public function login(Request $request) {
        app()->setLocale($request->header('lang'));
        $validator = $this->ValidationHelper($request, [
            'email'             => ['required', 'email'],
            'password'          => ['required', 'string']
        ]);


        if(!$validator['status']) {
            return $this->apiResponseHandler(401, false, __('request.invalid_credential'), ['errors' => $validator['errors']]);
        }
        // Create Merchant
        $credentials = $request->only(['email', 'password']);

        if(auth()->guard('merchants-api')->attempt($credentials)) {
            $merchant = Merchant::where('email', '=', $request->email)->first();
            $store = MerchantStore::where('merchant_id', '=', $merchant->id)->first();
            $data = [
                'merchant'  => [
                    "id"                => $merchant->id,
                    "wizard"            => ($merchant->wizard == 0 ? false : true),
                    'first_name'        => $merchant->first_name,
                    'last_name'         => $merchant->last_name,
                    'email'             => $merchant->email,
                    'phone'             => $merchant->phone,
                    'referral_code'     => $merchant->referral_code,
                    'merchant_code'     => $merchant->merchant_code,
                    'has_steps'         => $merchant->has_steps,
                    'phone_verified_at' => $merchant->phone_verified_at,
                    'email_verified_at' => $merchant->email_verified_at,
                    "created_at"        => $merchant->created_at,

                ],
                "has_store"             => ($store != null ? true : false),
                'store_id'              => ($store != null ? $store->id : null),

                'token'                 => $merchant->createToken('alrowadApp', ['merchant'], now()->addDay())->plainTextToken
            ];
            return $this->apiResponseHandler(200, true, __('request.merchant_logged'), $data);
        } else {
            return $this->apiResponseHandler(401, false, __('request.invalid_credential'));

        }
    }
    public function oauth(Request $request)
    {

        app()->setLocale($request->header('lang'));
        $validator = $this->ValidationHelper($request, [
            'name'              => ['required', 'string','min:4', 'max:255'],
            'email'             => ['required', 'email','min:4', 'max:255'],
        ]);


        if(!$validator['status']) {
            return $this->apiResponseHandler(401, false, __('request.invalid_credential'), ['errors' => $validator['errors']]);
        }

        $merchant = Merchant::where('email', '=', $request->email)->first();

        if ($merchant == null) {

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
          
            DB::beginTransaction();
            try {
                $name = $request->name;
                $first_name = strtok($name, ' ');
                $last_name = strstr($name, ' ');

                $formattedPhone = new PhoneNumber($request->phone, 'EG');
                $formattedPhone = $formattedPhone->formatE164();


                $merchant = Merchant::create([
                    'email_verified_at' => now(),
                    'first_name'        => $first_name??'',
                    'last_name'         => $last_name??'',
                    'email'             => $request->email??'',
                    'avatar'            => $request->image??'',
                    'google_verified'   => 1,
                    "wizard"            => 0,
                    'phone'             => $formattedPhone,
                    'password'          => Hash::make(Str::random(16)),
                    'merchant_code'     => $this->checkIfCodeIsUnique('merchant_code', $this->generateMerchantCode()),
                    'referral_code'     => $this->checkIfCodeIsUnique('referral_code', $this->generateMerchantReferralCode()),
                ]);
                /* $verify = new VerifyPhoneService();
                $res = $verify->verifyPhone($formattedPhone);
                if(!$res['status']) {
                    return $this->apiResponseHandler(500, false, $res['message']);
                } */
                DB::commit();

            } catch (\Throwable $th) {
                DB::rollBack();
                Log::critical($th->getMessage());
                return $this->apiResponseHandler(200, true, __('request.try_later'));
            }
        }
        Auth::guard('merchants-api')->login($merchant);
        $store = MerchantStore::where('merchant_id', '=', $merchant->id)->first();

        $data = [
            'merchant'  => $merchant,
            'token'     => $merchant->createToken('alrowadApp', ['merchant'], now()->addDay())->plainTextToken,
            "has_store"             => ($store != null ? true : false),
            'store_id'              => ($store != null ? $store->id : null),


        ];
        return $this->apiResponseHandler(200, true, __('request.merchant_logged'), $data);
    }
    public function submitForgetPasswordForm(Request $request)

    {
        $validator = $this->ValidationHelper($request, [
            'email'             => ['required', 'email','exists:merchants', 'max:255'],
        ]);
        if(!$validator['status']) {
            return $this->apiResponseHandler(401, false, __('request.invalid_credential'), ['errors' => $validator['errors']]);
        }

        DB::beginTransaction();
        try {
            
        $token = Str::random(64);



        DB::table('password_resets')->insert([

            'email' => $request->email, 

            'token' => $token, 

            'created_at' => Carbon::now()

          ]);


          Resend::emails()->send([
            'from' => 'onboarding@resend.dev',
            'to' => 'omarkhaledjob2001@gmail.com',
            'subject' => 'hello world',
            'html' => (new forgetPassword($token))->render()
        ]);


        DB::commit();

        return $this->apiResponseHandler(200, true, 'We have e-mailed your password reset link');
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }

    }

    public function submitResetPasswordForm(Request $request)

    {
        $validator = $this->ValidationHelper($request, [
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);
        



        $updatePassword = DB::table('password_resets')
        ->where([
            'email' => $request->email, 
            'token' => $request->token
        ])->first();



        if(!$updatePassword){
            return $this->apiResponseHandler(401, false, 'We Invalid token');
        }



        $user = Merchant::where('email', $request->email)->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        return $this->apiResponseHandler(2001, true, 'Your password has been changed');

    }
    public function test()
    {
        $conversion = Chat::where('sender_id', 1)->orWhere('receiver_id', 1)->get();
        $conversion =  ChatResource::collection($conversion);
        // event(new SendMessage($conversion, 1));
        return $this->apiResponseHandler(200, true, __('request.data_retrieved'));

    }
    public function logout(Request $request)
    {
        $locale     = ($request->header('lang') != null ? $request->header('lang') : 'en' );
        app()->setLocale($locale);
        $merchantID = $this->getUserIDByToken(request()->bearerToken());
        Merchant::find($merchantID)->update(['wizard' => 1]);
        return $this->apiResponseHandler(200, true, 'success');

    }
}
