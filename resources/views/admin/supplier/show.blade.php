@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.supplier.title_singular') }}:
                    {{ trans('cruds.supplier.fields.id') }}
                    {{ $supplier->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.supplier.fields.id') }}
                            </th>
                            <td>
                                {{ $supplier->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.supplier.fields.name') }}
                            </th>
                            <td>
                                {{ $supplier->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.supplier.fields.email') }}
                            </th>
                            <td>
                                {{ $supplier->email }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.supplier.fields.phone') }}
                            </th>
                            <td>
                                {{ $supplier->phone }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('supplier_edit')
                    <a href="{{ route('admin.suppliers.edit', $supplier) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.suppliers.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection