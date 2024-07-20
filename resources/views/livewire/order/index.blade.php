<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('order_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('global.delete_selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="Order" format="csv" />
                <livewire:excel-export model="Order" format="xlsx" />
                <livewire:excel-export model="Order" format="pdf" />
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
                        <th class="w-28 text-center">
                            {{ trans('cruds.order.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th class="text-center">
                            {{ trans('cruds.order.fields.subtotal') }}
                            @include('components.table.sort', ['field' => 'subtotal'])
                        </th>
                        <th class="text-center">
                            {{ trans('cruds.order.fields.shipping_cost') }}
                            @include('components.table.sort', ['field' => 'shipping_cost'])
                        </th>
                        <th class="text-center">
                            {{ trans('cruds.order.fields.grand_total') }}
                            @include('components.table.sort', ['field' => 'grand_total'])
                        </th>
                        <th class="text-center">
                            {{ trans('cruds.order.fields.merchant') }}
                            @include('components.table.sort', ['field' => 'merchant.email'])
                        </th>
                        
                        <th class="text-center">
                            {{ trans('cruds.order.fields.payment_method') }}
                            @include('components.table.sort', ['field' => 'payment_method'])
                        </th>
                        <th class="text-center">
                            {{ trans('cruds.order.fields.status') }}
                            @include('components.table.sort', ['field' => 'status'])
                        </th>
                        <th class="text-center">
                            {{ trans('cruds.order.fields.paid') }}
                            @include('components.table.sort', ['field' => 'paid'])
                        </th>
                        <th class="text-center">
                            {{ trans('cruds.order.fields.in_store') }}
                            @include('components.table.sort', ['field' => 'in_store'])
                        </th>
                        <th class="text-center">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $order->id }}" wire:model="selected">
                            </td>
                            <td class="text-center">
                                {{ $order->id }}
                            </td>
                            <td class="text-center">
                                {{ number_format($order->subtotal, 2) }} {{ $order->country->currency_code ?? '' }}
                            </td>
                            <td class="text-center">
                                {{ number_format($order->shipping_cost, 2) }} {{ $order->country->currency_code ?? '' }}
                            </td>
                            <td class="text-center">
                                {{ number_format($order->grand_total, 2) }} {{ $order->country->currency_code ?? '' }}
                            </td>
                            <td class="text-center">
                                @if($order->merchant)
                                    <span class="badge badge-relationship">{{ $order->merchant->email ?? '' }}</span>
                                @endif
                            </td>
                           
                            <td class="text-center">
                                {{ $order->payment_method }}
                            </td>
                            <td class="text-center">
                                {{ $order->status_label }}
                            </td>
                            <td class="text-center">
                                @if ($order->paid == 0)
                                <span class="badge" style="background-color: rgb(255 202 202);color: rgb(105 14 14);">
                                {{ __('global.unpaid') }}
                                </span>
                                @else
                                <span class="badge" style="background-color: rgb(155 231 178);color: rgb(14 105 18);">
                                {{  __('global.paid') }}
                                </span>
                                @endif
                            </td>
                            <td class="text-center">
                                {{($order->in_store == 0 ? __('global.merchant') : __('global.store'))}}
                               
                            </td>
                            <td>
                                <div class="flex justify-center">
                                    @can('order_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.orders.show', $order) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('order_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $order->id }})" wire:loading.attr="disabled">
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
            {{ $orders->links() }}
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