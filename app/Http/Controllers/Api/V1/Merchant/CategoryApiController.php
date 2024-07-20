<?php

namespace App\Http\Controllers\Api\V1\Merchant;

use App\Http\Controllers\Controller;
use App\Http\Helpers\GlobalHelper;
use App\Http\Helpers\ResponseHelper;
use App\Http\Helpers\ValidationHelper;
use App\Http\Resources\Merchant\CategoryListCollection;
use App\Http\Resources\Merchant\CategoryListResource;
use App\Http\Resources\Merchant\CategorySingleResource;
use App\Http\Resources\Merchant\ProductListCollection;
use App\Http\Resources\Merchant\ProductListResource;
use App\Http\Resources\Merchant\ProductSingleCollection;
use App\Http\Resources\Merchant\ProductSingleResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    use ResponseHelper, ValidationHelper, GlobalHelper;
    public function index(Request $request)
    {
        $categories = Category::paginate(8);
    
        $categories->transform(function (Category $category) {
            return (new CategoryListResource($category));
        });

        return $this->apiResponseHandler(200, true, __('request.data_retrieved'), new CategoryListCollection($categories)); 
    }
    public function single($slug)
    {
        $category = Category::with(['products'])
        ->where('slug', '=', $slug)
        ->first();
        
        if($category != null) {
          
            return $this->apiResponseHandler(200, true, __('request.data_retrieved'), new CategorySingleResource($category)); 
        } else {

            return $this->apiResponseHandler(404, false, __('request.not_found')); 
        }
        
    }
}
