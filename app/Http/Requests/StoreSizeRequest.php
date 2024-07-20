<?php

namespace App\Http\Requests;

use App\Models\Size;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSizeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('size_create'),
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
            'size' => [
                'string',
                'required',
            ],
        ];
    }
}
