@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.merchant.title_singular') }}:
                    {{ trans('cruds.merchant.fields.id') }}
                    {{ $merchant->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('merchant.edit', [$merchant])
        </div>
    </div>
</div>
@endsection