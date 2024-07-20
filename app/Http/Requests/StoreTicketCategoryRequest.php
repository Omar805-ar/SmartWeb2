<?php

namespace App\Http\Requests;

use App\Models\TicketCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTicketCategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('ticket_category_create'),
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
            'icon' => [
                'string',
                'nullable',
            ],
        ];
    }
}
