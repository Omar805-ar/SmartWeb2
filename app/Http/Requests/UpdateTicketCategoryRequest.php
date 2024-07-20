<?php

namespace App\Http\Requests;

use App\Models\TicketCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTicketCategoryRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('ticket_category_edit'),
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
                'required',
                'max:255',
                'min:2'
            ],
            'name_en' => [
                'string',
                'required',
                'max:255',
                'min:2'
            ],
        ];
    }
}
