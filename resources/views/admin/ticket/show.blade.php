@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.ticket.title_singular') }}:
                    {{ trans('cruds.ticket.fields.id') }}
                    {{ $ticket->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.ticket.fields.id') }}
                            </th>
                            <td>
                                {{ $ticket->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.ticket.fields.merchant') }}
                            </th>
                            <td>
                                @if($ticket->merchant)
                                    <span class="badge badge-relationship">{{ $ticket->merchant->first_name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.ticket.fields.category') }}
                            </th>
                            <td>
                                @if($ticket->category)
                                    <span class="badge badge-relationship">{{ $ticket->category->icon ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.ticket.fields.status') }}
                            </th>
                            <td>
                                {{ $ticket->status_label }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.ticket.fields.message') }}
                            </th>
                            <td>
                                {{ $ticket->message }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('ticket_edit')
                    <a href="{{ route('admin.tickets.edit', $ticket) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.tickets.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection