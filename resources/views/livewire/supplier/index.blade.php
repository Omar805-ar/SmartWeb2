<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            {{ __('global.per_page') }}:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('supplier_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('global.delete_selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="Supplier" format="csv" />
                <livewire:excel-export model="Supplier" format="xlsx" />
                <livewire:excel-export model="Supplier" format="pdf" />
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
                        <th class="w-28 text-center">
                            {{ trans('cruds.supplier.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th class="text-center">
                            {{ trans('cruds.supplier.fields.name') }}
                            @include('components.table.sort', ['field' => 'name'])
                        </th>
                        <th class="text-center">
                            {{ trans('cruds.supplier.fields.email') }}
                            @include('components.table.sort', ['field' => 'email'])
                        </th>
                        <th class="text-center">
                            {{ trans('cruds.supplier.fields.phone') }}
                            @include('components.table.sort', ['field' => 'phone'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($suppliers as $supplier)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $supplier->id }}" wire:model="selected">
                            </td>
                            <td class="text-center">
                                {{ $supplier->id }}
                            </td>
                            <td class="text-center">
                                {{ $supplier->name }}
                            </td>
                            <td class="text-center">
                                {{ $supplier->email }}
                            </td>
                            <td class="text-center">
                                {{ $supplier->phone }}
                            </td>
                            <td>
                                <div class="flex justify-center">
                                    @can('supplier_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.suppliers.show', $supplier) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('supplier_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.suppliers.edit', $supplier) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('supplier_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $supplier->id }})" wire:loading.attr="disabled">
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
            {{ $suppliers->links() }}
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