<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Gate;
use Illuminate\Http\Response;

class UpdateTrainigCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
            abort_if(
                Gate::denies('training_category_edit'),
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
            ];
    }

}
