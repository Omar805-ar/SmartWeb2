@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.color.title_singular') }}:
                    {{ trans('cruds.color.fields.id') }}
                    {{ $color->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('color.edit', [$color])
        </div>
    </div>
</div>
@endsection