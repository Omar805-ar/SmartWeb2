<?php

namespace App\Http\Controllers\Api\V1\Merchant;

use App\Http\Controllers\Controller;
use App\Http\Helpers\GlobalHelper;
use App\Http\Helpers\ResponseHelper;
use App\Http\Helpers\ValidationHelper;
use App\Http\Resources\Merchant\ProductListCollection;
use App\Http\Resources\Merchant\ProductListResource;
use App\Http\Resources\Merchant\ProductSingleCollection;
use App\Http\Resources\Merchant\ProductSingleResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    use ResponseHelper, ValidationHelper, GlobalHelper;
    public function index(Request $request)
    {
        if($request->header('country') != null) {

            $products = Product::with(['category', 'country', 'colors', 'sizes'])
            ->where('country_id', '=', $request->header('country'));
            
            if($request->get('category')) {

                $category = Category::where('slug', '=', $request->get('category'))->first();
                if ($category != null) {

                    $products = $products->where('category_id', '=', $category->id);
                
                } else {
                    $products = $products->where('category_id', '=', uniqid());

                }

            }
            
            
            if($request->get('order') == 'cheapest') {
                $products = $products->orderBy('price', 'DESC');
            } else if($request->get('order') == 'new') {
                $products = $products->orderBy('created_at', 'DESC');
    
            }
            $products = $products->paginate(8);
    
            $products->transform(function (Product $product) {
                return (new ProductListResource($product));
            });

            return $this->apiResponseHandler(200, true, __('request.data_retrieved'), new ProductListCollection($products)); 


        } else {
            return $this->apiResponseHandler(401, false, __('request.country_id_required')); 
        }
    }
    public function single($slug)
    {
        if(request()->header('country') != null) {


            $product = Product::with(['category', 'country', 'colors', 'sizes'])
            ->where('slug', '=', $slug)
            ->where('country_id', '=', request()->header('country'))
            ->first();
            
            if($product != null) {
              
                return $this->apiResponseHandler(200, true, __('request.data_retrieved'), new ProductSingleResource($product)); 
            } else {

                return $this->apiResponseHandler(404, false, __('request.not_found')); 
            }
        } else {

            return $this->apiResponseHandler(401, false, __('request.country_id_required')); 

        }
        
    }
}
