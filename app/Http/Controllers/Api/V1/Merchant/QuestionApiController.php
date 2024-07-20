<?php


namespace App\Http\Controllers\Api\V1\Merchant;

use Gate;


use App\Models\FaqCategory;
use App\Http\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;
use App\Http\Helpers\ResponseHelper;
use App\Http\Resources\Merchant\CategoryQAResource;

class QuestionApiController extends Controller
{

    use ResponseHelper, GlobalHelper;
    public function get_question()
    {

       $category =  FaqCategory::whereHas('question')->with('question')->get();

        return $this->apiResponseHandler(200, true, __('request.data_retrieved'), CategoryQAResource::collection($category));
    }



}
