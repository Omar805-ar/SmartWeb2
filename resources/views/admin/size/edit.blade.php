@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.size.title_singular') }}:
                    {{ trans('cruds.size.fields.id') }}
                    {{ $size->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('size.edit', [$size])
        </div>
    </div>
</div>
@endsection