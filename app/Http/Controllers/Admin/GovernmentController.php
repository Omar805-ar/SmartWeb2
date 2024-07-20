<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateGovernmentRequest;
use App\Models\Country;
use App\Models\Government;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GovernmentController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('government_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.government.index');
    }

    public function create()
    {
        abort_if(Gate::denies('government_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.government.create');
    }

    public function edit(Government $government)
    {
        abort_if(Gate::denies('government_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $listsForFields['country'] = Country::pluck('iso', 'id')->toArray();


        return view('admin.government.edit', compact('government', 'listsForFields'));
    }

    public function show(Government $government)
    {
        abort_if(Gate::denies('government_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $government->load('country');

        return view('admin.government.show', compact('government'));
    }
    public function update(UpdateGovernmentRequest $request, Government $government)
    {
        abort_if(Gate::denies('country_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $government->update($this->processData($request));

        return redirect()->route('admin.governments.index');

    }



    public function processData($request) : array {
        return [
            'ar' => [
                'name'                  => $request->name_ar,
            ],
            'en' => [
                'name'                  => $request->name_en,
            ],
            'country_id'                =>  $request->country_id,
            'shipping_cost'             =>  $request->shipping_cost,

         ];
    }
}
