@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.government.title_singular') }}:
                    {{ trans('cruds.government.fields.id') }}
                    {{ $government->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.government.fields.id') }}
                            </th>
                            <td>
                                {{ $government->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('global.name') }} (AR)
                            </th>
                            <td>
                                {{ $government->translate('ar')->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('global.name') }} (EN)
                            </th>
                            <td>
                                {{ $government->translate('en')->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.government.fields.country') }}
                            </th>
                            <td>
                                @if($government->country)
                                    <span class="badge badge-relationship">{{ $government->country->iso ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('government_edit')
                    <a href="{{ route('admin.governments.edit', $government) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.governments.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection