<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('merchant_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('global.delete_selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="Merchant" format="csv" />
                <livewire:excel-export model="Merchant" format="xlsx" />
                <livewire:excel-export model="Merchant" format="pdf" />
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
                            {{ trans('cruds.merchant.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.merchant.fields.first_name') }}
                            @include('components.table.sort', ['field' => 'first_name'])
                        </th>
                        <th>
                            {{ trans('cruds.merchant.fields.last_name') }}
                            @include('components.table.sort', ['field' => 'last_name'])
                        </th>
                        <th>
                            {{ trans('cruds.merchant.fields.email') }}
                            @include('components.table.sort', ['field' => 'email'])
                        </th>
                        <th>
                            {{ trans('cruds.merchant.fields.phone') }}
                            @include('components.table.sort', ['field' => 'phone'])
                        </th>
                        <th>
                            {{ trans('cruds.merchant.fields.referral_code') }}
                            @include('components.table.sort', ['field' => 'referral_code'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($merchants as $merchant)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $merchant->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $merchant->id }}
                            </td>
                            <td>
                                {{ $merchant->first_name }}
                            </td>
                            <td>
                                {{ $merchant->last_name }}
                            </td>
                            <td>
                                <a class="link-light-blue" href="mailto:{{ $merchant->email }}">
                                    <i class="far fa-envelope fa-fw">
                                    </i>
                                    {{ $merchant->email }}
                                </a>
                            </td>
                            <td>
                                {{ $merchant->phone }}
                            </td>
                            <td>
                                {{ $merchant->referral_code }}
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('merchant_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.merchants.show', $merchant) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('merchant_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.merchants.edit', $merchant) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('merchant_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $merchant->id }})" wire:loading.attr="disabled">
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
            {{ $merchants->links() }}
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