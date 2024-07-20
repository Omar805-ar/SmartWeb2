<?php

namespace App\Http\Requests;

use App\Models\Setting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSettingRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('setting_edit'),
            response()->json(
                ['message' => 'This action is unauthorized.'],
                Response::HTTP_FORBIDDEN
            ),
        );

        return true;
    }

    public function rules(): array
    {
        return [
            'app_name' => [
                'string',
                'max:255',
                'nullable',
            ],
            'twitter_handle' => [
                'string',
                'max:255',
                'nullable',
            ],
            'twitter_url' => [
                'string',
                'max:255',
                'nullable',
            ],
            'facebook_url' => [
                'string',
                'nullable',
            ],
            'youtube_url' => [
                'string',
                'max:255',
                'nullable',
            ],
            'tiktok_url' => [
                'string',
                'max:255',
                'nullable',
            ],
            'custom_url' => [
                'string',
                'max:255',
                'nullable',
            ],
        ];
    }
}
