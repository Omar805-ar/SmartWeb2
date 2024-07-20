@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.training.title_singular') }}:
                    {{ trans('cruds.training.fields.id') }}
                    {{ $training->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('training.edit', [$training])
        </div>
    </div>
</div>
@endsection