@extends('layouts.admin')
@section('content')
    <div class="card bg-blueGray-100">
        <div class="grid grid-cols-12 gap-0">
            <div class="col-span-12 lg:col-span-6">
                <div class="card-header">
                    <div class="card-header-container">
                        <h6 class="card-title">
                            {{ trans('global.view') }}
                            {{ trans('cruds.product.title_singular') }}:
                            {{ trans('cruds.product.fields.id') }}
                            {{ $product->id }}
                        </h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="pt-3">
                        <table class="table table-view">
                            <tbody class="bg-white">
                                <tr>
                                    <th>
                                        {{ trans('cruds.product.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $product->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.product.fields.category') }}
                                    </th>
                                    <td>
                                        @if ($product->category)
                                            <span
                                                class="badge badge-relationship">{{ $product->category->slug ?? '' }}</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.product.fields.country') }}
                                    </th>
                                    <td>
                                        @if ($product->country)
                                            <span class="badge badge-relationship">{{ $product->country->iso ?? '' }}</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.product.fields.price') }}
                                    </th>
                                    <td>
                                        {{ $product->price }}
                                        @if ($product->country)
                                            {{ $product->country->currency_code }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.product.fields.slug') }}
                                    </th>
                                    <td>
                                        {{ $product->slug }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.product.fields.product_code') }}
                                    </th>
                                    <td>
                                        {{ $product->product_code }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('global.name') }} (AR)
                                    </th>
                                    <td>
                                        {{ $product->translate('ar')->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('global.name') }} (EN)
                                    </th>
                                    <td>
                                        {{ $product->translate('en')->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('global.meta_description') }} (EN)
                                    </th>
                                    <td>
                                        {{ $product->translate('en')->meta_description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('global.meta_description') }} (EN)
                                    </th>
                                    <td>
                                        {{ $product->translate('en')->meta_description }}
                                    </td>
                                </tr>



                                <tr>
                                    <th>
                                        {{ trans('global.description') }} (EN)
                                    </th>
                                    <td>
                                        {{ $product->translate('en')->description }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('global.description') }} (EN)
                                    </th>
                                    <td>
                                        {{ $product->translate('en')->description }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-span-12 lg:col-span-6">
                <div class="card-header">
                    <div class="card-header-container">
                        <h6 class="card-title">
                            {{ __('global.options') }}
                        </h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="pt-3">
                        <table class="table table-view">
                            <tbody class="bg-white">
                                @if (count($product->colors) > 0)
                                    <tr>
                                        <th>
                                            {{ trans('global.colors') }}
                                        </th>
                                        <td>
                                            <div class="flex">
                                                @foreach ($product->colors as $color)
                                                    <div class="flex justify-center">
                                                        <div class="block"
                                                            style="background-color: {{ $color->hex }};width:30px;height:30px;border-radius:50%">
                                                        </div>
                                                        <span
                                                            style="background-color: {{ $color->hex }}; border-radius: 10px 10px 10px 10px; padding: 0 12px; position: relative; left: -4px; font-size: 19px; font-weight: bold;">{{ $color->hex }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                                @if (count($product->sizes) > 0)
                                <tr>
                                    <th>
                                        {{ trans('global.sizes') }}
                                    </th>
                                    <td>
                                        @foreach ($product->sizes as $size)
                                        <span class="badge badge-relationship">{{ $size->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>

                    


                </div>
            </div>
        </div>
    </div>
@endsection
