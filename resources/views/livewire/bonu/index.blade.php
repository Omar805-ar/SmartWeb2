<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('bonu_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('global.delete_selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="Bonu" format="csv" />
                <livewire:excel-export model="Bonu" format="xlsx" />
                <livewire:excel-export model="Bonu" format="pdf" />
            @endif




        </div>
        <div class="w-full sm:w-1/2 sm:text-right">
            Search:
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
                        <th class="w-28">
                            {{ trans('cruds.bonu.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.bonu.fields.min_orders') }}
                            @include('components.table.sort', ['field' => 'min_orders'])
                        </th>
                        <th>
                            {{ trans('cruds.bonu.fields.minimum_order_amount') }}
                            @include('components.table.sort', ['field' => 'minimum_order_amount'])
                        </th>
                        <th>
                            {{ trans('cruds.bonu.fields.bonus') }}
                            @include('components.table.sort', ['field' => 'bonus'])
                        </th>
                        <th>
                            {{ trans('cruds.bonu.fields.country') }}
                            @include('components.table.sort', ['field' => 'country.currency_code'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bonus as $bonu)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $bonu->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $bonu->id }}
                            </td>
                            <td>
                                {{ $bonu->min_orders }}
                            </td>
                            <td>
                                {{ $bonu->minimum_order_amount }}
                            </td>
                            <td>
                                {{ $bonu->bonus }}
                            </td>
                            <td>
                                @if($bonu->country)
                                    <span class="badge badge-relationship">{{ $bonu->country->currency_code ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('bonu_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.bonus.show', $bonu) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('bonu_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.bonus.edit', $bonu) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('bonu_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $bonu->id }})" wire:loading.attr="disabled">
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
            {{ $bonus->links() }}
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