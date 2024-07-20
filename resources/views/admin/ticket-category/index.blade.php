@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-white">
        <div class="card-header border-b border-blueGray-200">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('cruds.ticketCategory.title_singular') }}
                    {{ trans('global.list') }}
                </h6>

                @can('ticket_category_create')
                    <a class="btn btn-indigo" href="{{ route('admin.ticket-categories.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.ticketCategory.title_singular') }}
                    </a>
                @endcan
            </div>
        </div>
        @livewire('ticket-category.index')

    </div>
</div>
@endsection