<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            {{ __('global.per_page') }}:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('ticket_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('global.delete_selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="Ticket" format="csv" />
                <livewire:excel-export model="Ticket" format="xlsx" />
                <livewire:excel-export model="Ticket" format="pdf" />
            @endif




        </div>
        <div class="w-full sm:w-1/2 sm:text-right">
            {{ __('global.search') }}:
            <input type="text" wire:model.debounce.300ms="search" class="w-full sm:w-1/3 inline-block" />
        </div>
    </div>
    <div wire:loading.delay>
        Loading...
    </div>

    <div class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table table-index w-full">
                <thead>
                    <tr>
                        <th class="w-9">
                        </th>
                        <th class="text-center w-28">
                            {{ trans('cruds.ticket.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th class="text-center">
                            {{ trans('cruds.ticket.fields.merchant') }}
                        </th>
                        <th class="text-center">
                            {{ trans('cruds.ticket.fields.category') }}
                        </th>
                        <th class="text-center">
                            {{ trans('cruds.ticket.fields.type') }}
                        </th>
                        <th class="text-center">
                            {{ trans('cruds.ticket.fields.status') }}
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tickets as $ticket)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $ticket->id }}" wire:model="selected">
                            </td>
                            <td class="text-center">
                                {{ $ticket->id }}
                            </td>
                            <td class="text-center">
                                @if($ticket->merchant)
                                    <span class="badge badge-relationship">{{ $ticket->merchant->email ?? '' }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($ticket->category)
                                    <span class="badge badge-relationship">{{ $ticket->category->translate(app()->getLocale())->name ?? '' }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                {{ $ticket->type }}
                            </td>
                            <td class="text-center">
                                {{ $ticket->status }}
                            </td>
                            <td>
                                <div class="flex justify-center">
                                    @can('ticket_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.tickets.show', $ticket) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('ticket_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $ticket->id }})" wire:loading.attr="disabled">
                                            {{ trans('global.delete') }}
                                        </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10">No entries found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-body">
        <div class="pt-3">
            @if($this->selectedCount)
                <p class="text-sm leading-5">
                    <span class="font-medium">
                        {{ $this->selectedCount }}
                    </span>
                    {{ __('Entries selected') }}
                </p>
            @endif
            {{ $tickets->links() }}
        </div>
    </div>
</div>

@push('scripts')
    <script>
        Livewire.on('confirm', e => {
    if (!confirm("{{ trans('global.areYouSure') }}")) {
        return
    }
@this[e.callback](...e.argv)
})
    </script>
@endpush