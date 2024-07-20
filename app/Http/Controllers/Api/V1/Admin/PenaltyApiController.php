<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePenaltyRequest;
use App\Http\Requests\UpdatePenaltyRequest;
use App\Http\Resources\Admin\PenaltyResource;
use App\Models\Penalty;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PenaltyApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('penalty_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PenaltyResource(Penalty::with(['merchant', 'country'])->get());
    }

    public function store(StorePenaltyRequest $request)
    {
        $penalty = Penalty::create($request->validated());

        return (new PenaltyResource($penalty))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Penalty $penalty)
    {
        abort_if(Gate::denies('penalty_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PenaltyResource($penalty->load(['merchant', 'country']));
    }

    public function update(UpdatePenaltyRequest $request, Penalty $penalty)
    {
        $penalty->update($request->validated());

        return (new PenaltyResource($penalty))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Penalty $penalty)
    {
        abort_if(Gate::denies('penalty_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $penalty->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
