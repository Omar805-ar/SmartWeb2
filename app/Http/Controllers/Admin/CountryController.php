<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCountryRequest;
use App\Models\Country;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class CountryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('country_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.country.index');
    }

    public function create()
    {
        abort_if(Gate::denies('country_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.country.create');
    }

    public function edit(Country $country)
    {
        abort_if(Gate::denies('country_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.country.edit', compact('country'));
    }
    public function update(UpdateCountryRequest $request, Country $country)
    {
        abort_if(Gate::denies('country_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $country->update($this->processData($request));

        return redirect()->route('admin.countries.index');

    }



    public function processData($request) : array {
        return [
            'ar' => [
                'name'          => $request->name_ar,
            ],
            'en' => [
                'name'          => $request->name_en,
            ],
            'iso'               =>  $request->iso,
            'currency_code'     => $request->currency_code,
            'flag'              => '<span class="fi fi-'.strtolower(Str::limit($request->iso, 2, '')).'"></span>',
         ];
    }

    public function show(Country $country)
    {
        abort_if(Gate::denies('country_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.country.show', compact('country'));
    }
}
