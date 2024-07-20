<?php

namespace App\Http\Controllers\Api\V1\Merchant;

use App\Http\Controllers\Controller;
use App\Http\Helpers\GlobalHelper;
use App\Http\Helpers\ResponseHelper;
use App\Http\Helpers\ValidationHelper;
use App\Http\Resources\Merchant\CategoryListCollection;
use App\Http\Resources\Merchant\CategoryListResource;
use App\Http\Resources\Merchant\CategorySingleResource;
use App\Http\Resources\Merchant\PenaltyListCollection;
use App\Http\Resources\Merchant\PenaltyListResource;
use App\Http\Resources\Merchant\ProductListCollection;
use App\Http\Resources\Merchant\ProductListResource;
use App\Http\Resources\Merchant\ProductSingleCollection;
use App\Http\Resources\Merchant\ProductSingleResource;
use App\Models\Category;
use App\Models\Penalty;
use App\Models\Product;
use Illuminate\Http\Request;

class PenaltyApiController extends Controller
{
    use ResponseHelper, ValidationHelper, GlobalHelper;
    public function index(Request $request)
    {

        $merchantID = $this->getUserIDByToken(request()->bearerToken());
        if ($merchantID != false) {
            $penalties = Penalty::where('merchant_id', '=', $merchantID)-> paginate(15);
    
            $penalties->transform(function (Penalty $category) {
                return (new PenaltyListResource($category));
            });        
            return $this->apiResponseHandler(200, true, __('request.data_retrieved'), new PenaltyListCollection($penalties)); 
        } else {
            return $this->apiResponseHandler(404, false, __('request.not_found'), []); 
        }
      

    }
}
