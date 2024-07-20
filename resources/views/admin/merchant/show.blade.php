@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.merchant.title_singular') }}:
                    {{ trans('cruds.merchant.fields.id') }}
                    {{ $merchant->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.merchant.fields.id') }}
                            </th>
                            <td>
                                {{ $merchant->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.merchant.fields.first_name') }}
                            </th>
                            <td>
                                {{ $merchant->first_name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.merchant.fields.last_name') }}
                            </th>
                            <td>
                                {{ $merchant->last_name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.merchant.fields.email') }}
                            </th>
                            <td>
                                <a class="link-light-blue" href="mailto:{{ $merchant->email }}">
                                    <i class="far fa-envelope fa-fw">
                                    </i>
                                    {{ $merchant->email }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.merchant.fields.phone') }}
                            </th>
                            <td>
                                {{ $merchant->phone }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.merchant.fields.referral_code') }}
                            </th>
                            <td>
                                {{ $merchant->referral_code }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('merchant_edit')
                    <a href="{{ route('admin.merchants.edit', $merchant) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.merchants.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection