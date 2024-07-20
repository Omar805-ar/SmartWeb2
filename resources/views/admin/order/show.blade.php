@extends('layouts.admin')
@section('content')

<div class="grid grid-cols-12 gap-4">
    <div class="col-span-12 lg:col-span-6">
        <div class="card bg-blueGray-100">
            <div class="card-header">
                <div class="flex justify-between">
                    <div>
                        <h6 class="card-title">
                            {{ trans('global.view') }}
                            {{ trans('cruds.order.title_singular') }}:
                            {{ trans('cruds.order.fields.id') }}
                            {{ $order->id }}
                        </h6>
                        <h6 class="card-title">
                            {{ trans('global.financial') }}
                            {{ $order->id }}
                        </h6>
                    </div>
                    <div>
                        <form action="{{ route('admin.orders.change_status',  $order) }}" method="POST">
                            @csrf
                            <button class="btn btn-sm btn-indigo mr-2" type="submit">
                                {{ trans('global.accept') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="pt-3">
                    <table class="table table-view">
                        <tbody class="bg-white">
                            <tr>
                                <th>
                                    {{ trans('cruds.order.fields.id') }}
                                </th>
                                <td>
                                    {{ $order->id }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.order.fields.subtotal') }}
                                </th>
                                <td>
                                    {{ $order->subtotal }} {{ $order->country->currency_code ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.order.fields.shipping_cost') }}
                                </th>
                                <td>
                                    {{ $order->shipping_cost }} {{ $order->country->currency_code ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.order.fields.grand_total') }}
                                </th>
                                <td>
                                    {{ $order->grand_total }} {{ $order->country->currency_code ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.order.fields.status') }}
                                </th>
                                <td>
                                    {{ $order->status_label }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.order.fields.paid') }}
                                </th>
                                <td>
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
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.order.fields.in_store') }}
                                </th>
                                <td>
                                    {{($order->in_store == 0 ? __('global.merchant') : __('global.store'))}}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.order.fields.created_at') }}
                                </th>
                                <td>
                                    {{$order->created_at}}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.order.fields.updated_at') }}
                                </th>
                                <td>
                                    {{$order->updated_at}}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.order.fields.payment_method') }}
                                </th>
                                <td>
                                    {{$order->payment_method}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-span-12 lg:col-span-6">
        <div class="card bg-blueGray-100">
            <div class="card-header">
               
                <h6 class="card-title">
                    {{ trans('global.address') }}
                </h6>
            </div>
            <div class="card-body">
                <div class="pt-3">
                    <table class="table table-view">
                        <tbody class="bg-white">
                            <tr>
                           
                            <tr>
                                <th>
                                    {{ trans('cruds.order.fields.country') }}
                                </th>
                                <td>
                                    {{ $order->country->iso ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.order.fields.city') }}
                                </th>
                                <td>
                                    {{ $order->city ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.order.fields.address') }}
                                </th>
                                <td>
                                    {{ $order->address ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.order.fields.address_2') }}
                                </th>
                                <td>
                                    {{ $order->address_2 }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.order.fields.notes') }}
                                </th>
                                <td>
                                    {{ $order->notes }}
                                    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-span-12 lg:col-span-6">
        <div class="card bg-blueGray-100">
            <div class="card-header">
               
                <h6 class="card-title">
                    {{ trans('global.receiver_info') }}
                </h6>
            </div>
            <div class="card-body">
                <div class="pt-3">
                    <table class="table table-view">
                        <tbody class="bg-white">
                            <tr>
                                <th>
                                    {{ trans('cruds.order.fields.id') }}
                                </th>
                                <td>
                                    {{ $order->id }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.orders.fields.country') }}
                                </th>
                                <td>
                                    {{ $order->country->iso ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.order.fields.city') }}
                                </th>
                                <td>
                                    {{ $order->city ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.order.fields.address') }}
                                </th>
                                <td>
                                    {{ $order->address ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.order.fields.address_2') }}
                                </th>
                                <td>
                                    {{ $order->address_2 }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.order.fields.paid') }}
                                </th>
                                <td>
                                    {{ $order->notes }}
                                    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- 



<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.order.title_singular') }}:
                    {{ trans('cruds.order.fields.id') }}
                    {{ $order->id }}
                </h6>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card-body">
                   
                </div>
            </div>
            <div class="col-lg-6">
                <table class="table table-view">
                    <tbody class="bg-white">
                        
                        <tr>
                            <th>
                                {{ trans('cruds.order.fields.city') }}
                            </th>
                            <td>
                                {{ $order->city }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.order.fields.address') }}
                            </th>
                            <td>
                                {{ $order->address}}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.order.fields.address_2') }}
                            </th>
                            <td>
                                {{ $order->address_2 }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.order.fields.notes') }}
                            </th>
                            <td>
                                {{ $order->notes }}
                            </td>
                        </tr>
                       
                    </tbody>
                </table>
            </div>
        </div>
     
    </div>
</div> --}}
@endsection