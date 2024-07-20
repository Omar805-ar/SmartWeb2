<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMerchantRequest;
use App\Http\Requests\UpdateMerchantRequest;
use App\Http\Resources\Admin\MerchantResource;
use App\Models\Merchant;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MerchantApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('merchant_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MerchantResource(Merchant::all());
    }

    public function store(StoreMerchantRequest $request)
    {
        $merchant = Merchant::create($request->validated());

        return (new MerchantResource($merchant))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Merchant $merchant)
    {
        abort_if(Gate::denies('merchant_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MerchantResource($merchant);
    }

    public function update(UpdateMerchantRequest $request, Merchant $merchant)
    {
        $merchant->update($request->validated());

        return (new MerchantResource($merchant))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Merchant $merchant)
    {
        abort_if(Gate::denies('merchant_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $merchant->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
