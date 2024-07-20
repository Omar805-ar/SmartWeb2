<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\Admin\ProductResource;
use App\Http\Resources\Merchant\ProductListCollection;
use App\Http\Resources\Merchant\ProductListResource;
use App\Models\Product;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductApiController extends Controller
{
    public function index(Request $request)
    {

        if($request->get('country_id') != null) {

        } else {
            
        }

        $products = Product::with(['category', 'country', 'colors', 'sizes']);
        if($request->get('order') == 'cheapest') {
            $products = $products->orderBy('price', 'DESC');
        } else if($request->get('order') == 'new') {
            $products = $products->orderBy('created_at', 'DESC');

        }
        $products = $products->paginate(8);

        $products->transform(function (Product $product) {
            return (new ProductListResource($product));
        });
        return new ProductListCollection($products);

    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());

        return (new ProductResource($product))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Product $product)
    {
        abort_if(Gate::denies('product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductResource($product->load(['category', 'country']));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        return (new ProductResource($product))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Product $product)
    {
        abort_if(Gate::denies('product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
