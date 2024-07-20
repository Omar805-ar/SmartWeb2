@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.country.title_singular') }}:
                    {{ trans('cruds.country.fields.id') }}
                    {{ $country->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.country.fields.id') }}
                            </th>
                            <td>
                                {{ $country->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.country.fields.iso') }}
                            </th>
                            <td>
                                {{ $country->iso }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('global.name') }} (AR)
                            </th>
                            <td>
                                {{ $country->translate('ar')->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('global.name') }} (EN)
                            </th>
                            <td>
                                {{ $country->translate('en')->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.country.fields.currency_code') }}
                            </th>
                            <td>
                                {{ $country->currency_code }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.country.fields.flag') }}
                            </th>
                            <td>
                                {!!  $country->flag !!}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('country_edit')
                    <a href="{{ route('admin.countries.edit', $country) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.countries.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection