<?php

namespace App\Http\Controllers\Api\V1\Merchant;

use App\Http\Controllers\Controller;
use App\Http\Helpers\GlobalHelper;
use App\Http\Helpers\ResponseHelper;
use App\Http\Helpers\ValidationHelper;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Http\Resources\Admin\CountryResource;
use App\Http\Resources\Merchant\CountryListCollection;
use App\Http\Resources\Merchant\CountryListResource;
use App\Models\Country;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CountryApiController extends Controller
{
    use ResponseHelper, ValidationHelper, GlobalHelper;
    public function index()
    {

        $countries = Country::paginate(8);
    
        $countries->transform(function (Country $country) {
            return (new CountryListResource($country));
        });
        return $this->apiResponseHandler(200, true, __('request.data_retrieved'), new CountryListCollection($countries)); 


    }

   

    public function show(Country $country)
    {
        abort_if(Gate::denies('country_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CountryResource($country);
    }

    public function update(UpdateCountryRequest $request, Country $country)
    {
        $country->update($request->validated());

        return (new CountryResource($country))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Country $country)
    {
        abort_if(Gate::denies('country_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $country->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
