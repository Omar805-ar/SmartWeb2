@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.bonu.title_singular') }}:
                    {{ trans('cruds.bonu.fields.id') }}
                    {{ $bonu->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.bonu.fields.id') }}
                            </th>
                            <td>
                                {{ $bonu->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.bonu.fields.min_orders') }}
                            </th>
                            <td>
                                {{ $bonu->min_orders }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.bonu.fields.minimum_order_amount') }}
                            </th>
                            <td>
                                {{ $bonu->minimum_order_amount }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.bonu.fields.bonus') }}
                            </th>
                            <td>
                                {{ $bonu->bonus }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.bonu.fields.country') }}
                            </th>
                            <td>
                                @if($bonu->country)
                                    <span class="badge badge-relationship">{{ $bonu->country->currency_code ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('bonu_edit')
                    <a href="{{ route('admin.bonus.edit', $bonu) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.bonus.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection