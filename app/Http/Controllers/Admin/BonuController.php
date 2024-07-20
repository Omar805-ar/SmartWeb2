<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bonu;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BonuController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bonu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bonu.index');
    }

    public function create()
    {
        abort_if(Gate::denies('bonu_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bonu.create');
    }

    public function edit(Bonu $bonu)
    {
        abort_if(Gate::denies('bonu_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bonu.edit', compact('bonu'));
    }

    public function show(Bonu $bonu)
    {
        abort_if(Gate::denies('bonu_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bonu->load('country');

        return view('admin.bonu.show', compact('bonu'));
    }
}
