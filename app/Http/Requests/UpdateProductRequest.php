<?php

namespace App\Http\Requests;

use App\Models\Product;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('product_edit'),
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
            'category_id' => [
                'integer',
                'exists:categories,id',
                'required',
            ],
            'country_id' => [
                'integer',
                'exists:countries,id',
                'required',
            ],
            'price' => [
                'numeric',
                'required',
            ],
            'slug' => [
                'string',
                'max:255',
                'required',
                'unique:products,slug,' . request()->route('product')->id,
            ],
            'product_code' => [
                'string',
                'max:255',
                'required',
                'unique:products,product_code,' . request()->route('product')->id,
            ],
        ];
    }
}
