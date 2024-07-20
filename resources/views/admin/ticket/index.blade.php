@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-white">
        <div class="card-header border-b border-blueGray-200">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('cruds.ticket.title_singular') }}
                    {{ trans('global.list') }}
                </h6>

                @can('ticket_create')
                    <a class="btn btn-indigo" href="{{ route('admin.tickets.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.ticket.title_singular') }}
                    </a>
                @endcan
            </div>
        </div>
        @livewire('ticket.index')

    </div>
</div>
@endsection