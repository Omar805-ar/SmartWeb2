@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.size.title_singular') }}:
                    {{ trans('cruds.size.fields.id') }}
                    {{ $size->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.size.fields.id') }}
                            </th>
                            <td>
                                {{ $size->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.size.fields.size') }}
                            </th>
                            <td>
                                {{ $size->size }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('size_edit')
                    <a href="{{ route('admin.sizes.edit', $size) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.sizes.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection