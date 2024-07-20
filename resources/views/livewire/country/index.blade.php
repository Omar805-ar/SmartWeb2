<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            {{ __('global.per_page') }}:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('country_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="Country" format="csv" />
                <livewire:excel-export model="Country" format="xlsx" />
                <livewire:excel-export model="Country" format="pdf" />
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
                        <th class="text-center w-9">
                        </th>
                        
                        <th class="text-center w-28">
                            {{ trans('cruds.country.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th class="text-center">
                            {{ trans('global.name') }} (AR)
                        </th>
                        <th class="text-center">
                            {{ trans('global.name') }} (EN)
                        </th>
                        <th class="text-center">
                            {{ trans('cruds.country.fields.iso') }}
                            @include('components.table.sort', ['field' => 'iso'])
                        </th>
                        <th class="text-center">
                            {{ trans('cruds.country.fields.currency_code') }}
                            @include('components.table.sort', ['field' => 'currency_code'])
                        </th>
                        <th class="text-center">
                            {{ trans('cruds.country.fields.flag') }}
                            @include('components.table.sort', ['field' => 'flag'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($countries as $country)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $country->id }}" wire:model="selected">
                            </td>
                            <td class="text-center">
                                {{ $country->id }}
                            </td>
                            <td class="text-center">
                                {{ $country->translate('ar')->name }}
                            </td>
                            <td class="text-center">
                                {{ $country->translate('en')->name }}
                            </td>
                            <td class="text-center">
                                {{ $country->iso }}
                            </td>
                            <td class="text-center">
                                {{ $country->currency_code }}
                            </td>
                            <td class="text-center">
                                {!! $country->flag !!}
                            </td>
                            <td>
                                <div class="flex justify-center">
                                    @can('country_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.countries.show', $country) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('country_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.countries.edit', $country) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('country_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $country->id }})" wire:loading.attr="disabled">
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
            {{ $countries->links() }}
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