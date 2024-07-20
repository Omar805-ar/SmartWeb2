<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Merchant;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MerchantController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('merchant_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.merchant.index');
    }

    public function create()
    {
        abort_if(Gate::denies('merchant_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.merchant.create');
    }

    public function edit(Merchant $merchant)
    {
        abort_if(Gate::denies('merchant_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.merchant.edit', compact('merchant'));
    }

    public function show(Merchant $merchant)
    {
        abort_if(Gate::denies('merchant_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.merchant.show', compact('merchant'));
    }
}
