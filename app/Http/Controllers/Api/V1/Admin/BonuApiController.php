<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBonuRequest;
use App\Http\Requests\UpdateBonuRequest;
use App\Http\Resources\Admin\BonuResource;
use App\Models\Bonu;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BonuApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bonu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BonuResource(Bonu::with(['country'])->get());
    }

    public function store(StoreBonuRequest $request)
    {
        $bonu = Bonu::create($request->validated());

        return (new BonuResource($bonu))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Bonu $bonu)
    {
        abort_if(Gate::denies('bonu_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BonuResource($bonu->load(['country']));
    }

    public function update(UpdateBonuRequest $request, Bonu $bonu)
    {
        $bonu->update($request->validated());

        return (new BonuResource($bonu))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Bonu $bonu)
    {
        abort_if(Gate::denies('bonu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bonu->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
