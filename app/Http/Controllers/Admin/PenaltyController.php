<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penalty;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PenaltyController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('penalty_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.penalty.index');
    }

    public function create()
    {
        abort_if(Gate::denies('penalty_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.penalty.create');
    }

    public function edit(Penalty $penalty)
    {
        abort_if(Gate::denies('penalty_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.penalty.edit', compact('penalty'));
    }

    public function show(Penalty $penalty)
    {
        abort_if(Gate::denies('penalty_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $penalty->load('merchant', 'country');

        return view('admin.penalty.show', compact('penalty'));
    }
}
