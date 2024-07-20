@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.penalty.title_singular') }}:
                    {{ trans('cruds.penalty.fields.id') }}
                    {{ $penalty->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('penalty.edit', [$penalty])
        </div>
    </div>
</div>
@endsection