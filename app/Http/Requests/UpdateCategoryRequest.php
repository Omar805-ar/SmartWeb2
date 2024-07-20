<?php

namespace App\Http\Requests;

use App\Models\Category;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('category_edit'),
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
            'name_ar' => [
                'string',
                'min:3',
                'max:255',
                'required',
            ],
            'name_en' => [
                'string',
                'min:3',
                'max:255',
                'required',
            ],
            'meta_description_en' => [
                'string',
                'min:3',
                'max:300',
                'required',
            ],
            'meta_description_ar' => [
                'string',
                'min:3',
                'max:300',
                'required',
            ],
            'icon' => [
                'string',
                'required',
            ],
        ];
    }
}
