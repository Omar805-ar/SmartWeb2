<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            {{ __('global.per_page') }}:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('product_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('global.delete_selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="Product" format="csv" />
                <livewire:excel-export model="Product" format="xlsx" />
                <livewire:excel-export model="Product" format="pdf" />
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
                            {{ trans('cruds.product.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th class="text-center">
                            {{ trans('cruds.product.fields.category') }}
                            @include('components.table.sort', ['field' => 'category.slug'])
                        </th>
                        <th class="text-center">
                            {{ trans('cruds.product.fields.country') }}
                            @include('components.table.sort', ['field' => 'country.iso'])
                        </th>
                        <th class="text-center">
                            {{ trans('cruds.product.fields.price') }}
                            @include('components.table.sort', ['field' => 'price'])
                        </th>
                        <th class="text-center">
                            {{ trans('global.name') }} (AR)
                        </th>
                        <th class="text-center">
                            {{ trans('global.name') }} (EN)
                        </th>
                        <th class="text-center">
                            {{ trans('cruds.product.fields.product_code') }}
                            @include('components.table.sort', ['field' => 'product_code'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $product->id }}" wire:model="selected">
                            </td>
                            <td class="text-center">
                                {{ $product->id }}
                            </td>
                            <td class="text-center">
                                @if($product->category)
                                    <span class="badge badge-relationship">{{ $product->category->slug ?? '' }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($product->country)
                                    <span class="badge badge-relationship">{{ $product->country->iso ?? '' }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                {{ number_format($product->price, 2) }}
                                @if($product->country)
                                {{  $product->country->currency_code  }}
                                @endif
                            </td>
                            <td class="text-center">
                                {{ Str::substr($product->translate('ar')->name, 0, 50) }}
                            </td>
                            <td class="text-center">
                                {{ Str::substr($product->translate('en')->name, 0, 50) }}
                            </td>
                            <td class="text-center">
                                {{ $product->product_code }}
                            </td>
                            <td>
                                <div class="flex justify-center">
                                    @can('product_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.products.show', $product) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('product_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.products.edit', $product) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('product_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $product->id }})" wire:loading.attr="disabled">
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
            {{ $products->links() }}
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