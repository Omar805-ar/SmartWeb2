@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.color.title_singular') }}:
                    {{ trans('cruds.color.fields.id') }}
                    {{ $color->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.color.fields.id') }}
                            </th>
                            <td>
                                {{ $color->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.color.fields.hex') }}
                            </th>
                            <td>
                                <div style="background-color: {{ $color->hex }};width:30px;height:30px;border-radius:50%" ></div>                                    
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('color_edit')
                    <a href="{{ route('admin.colors.edit', $color) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.colors.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection