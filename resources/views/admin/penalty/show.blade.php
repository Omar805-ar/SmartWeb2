@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.penalty.title_singular') }}:
                    {{ trans('cruds.penalty.fields.id') }}
                    {{ $penalty->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.penalty.fields.id') }}
                            </th>
                            <td>
                                {{ $penalty->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.penalty.fields.merchant') }}
                            </th>
                            <td>
                                @if($penalty->merchant)
                                    <span class="badge badge-relationship">{{ $penalty->merchant->email ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.penalty.fields.reason') }}
                            </th>
                            <td>
                                {{ $penalty->reason }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.penalty.fields.amount') }}
                            </th>
                            <td>
                                {{ $penalty->amount }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.penalty.fields.country') }}
                            </th>
                            <td>
                                @if($penalty->country)
                                    <span class="badge badge-relationship">{{ $penalty->country->currency_code ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('penalty_edit')
                    <a href="{{ route('admin.penalties.edit', $penalty) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.penalties.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection