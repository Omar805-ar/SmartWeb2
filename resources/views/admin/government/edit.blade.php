@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.government.title_singular') }}:
                    {{ trans('cruds.government.fields.id') }}
                    {{ $government->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.governments.update', $government->id) }}" method="POST" class="pt-3">
                @csrf
                @method('PATCH')
                <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400 localesTranslateTabs">
                        <li data-parent="#arabic-inputs">
                            <a href="#" aria-current="page" class="me-2 inline-block p-4 rounded-t-lg text-sky-600">
                                {{ (auth()->user()->locale == 'ar' ? 'عربي': 'Arabic' ) }}
                            </a>
                        </li>
                        <li data-parent="#english-inputs">
                            <a href="#" class="me-2 inline-block p-4 rounded-t-lg ">
                                {{ (auth()->user()->locale == 'ar' ? 'انجيليزية': 'English' ) }}
                
                            </a>
                        </li>
                    </ul>
                    <div class="localesTranslateContent pt-4">
                        <div id="arabic-inputs" class="tabsChild block">
                            <div class="form-group {{ $errors->has('name_ar') ? 'invalid' : '' }}">
                                <label class="form-label required" for="name_ar">{{ trans('global.name') }} (AR)</label>
                                <input class="form-control" type="text" name="name_ar" id="name_ar" required value="{{  $government->translate('ar')->name }}">
                                <div class="validation-message">
                                    {{ $errors->first('name_ar') }}
                                </div>
                            </div>
                        </div>
                        <div id="english-inputs" class="tabsChild hidden">
                            <div class="form-group {{ $errors->has('name_en') ? 'invalid' : '' }}">
                                <label class="form-label required" for="name_en">{{ trans('global.name') }} (EN)</label>
                                <input class="form-control" type="text" name="name_en" id="name_en" required value="{{  $government->translate('en')->name  }}">
                                <div class="validation-message">
                                    {{ $errors->first('name_en') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <br>
                    <div class="form-group {{ $errors->has('country_id') ? 'invalid' : '' }}">
                        <label class="form-label required" for="country">{{ trans('cruds.government.fields.country') }}</label>
                        <select class="select2 form-control" name="country_id" placeholder="{{ __('global.select_option') }}">
                            @foreach($listsForFields as $country)
                                @foreach($country as $key => $value)
                                <option {{ ($government->country_id == $key ? 'selected' : '') }} value="{{ $key }}">{{ $value }}</option>
                                @endforeach   
                            @endforeach
                        </select>

                        <div class="validation-message">
                            {{ $errors->first('country_id') }}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('shipping_cost') ? 'invalid' : '' }}">
                        <label class="form-label required" for="shipping_cost">{{ trans('cruds.government.fields.shipping_cost') }}</label>
                        <input class="form-control" type="number" name="shipping_cost" id="shipping_cost"  value="{{  $government->shipping_cost  }}" step="0.01">
                        <div class="validation-message">
                            {{ $errors->first('shipping_cost') }}
                        </div>
                        <div class="help-block">
                            {{ trans('cruds.government.fields.shipping_cost_helper') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-indigo mr-2" type="submit">
                            {{ trans('global.save') }}
                        </button>
                        <a href="{{ route('admin.governments.index') }}" class="btn btn-secondary">
                            {{ trans('global.cancel') }}
                        </a>
                    </div>
                </form>
                

        </div>
    </div>
</div>
@push('scripts')
    <script>
        document.querySelectorAll('.localesTranslateTabs li').forEach((li) => {
            li.addEventListener('click', (e) => {


                document.querySelectorAll('.localesTranslateTabs li').forEach((item) => {
                    item.querySelector('a').classList.remove('text-sky-600');
                });
                document.querySelectorAll('.localesTranslateContent .tabsChild').forEach((item) => {
                    item.classList.add('hidden');
                    item.classList.remove('block');
                });


                document.querySelector(li.getAttribute('data-parent')).classList.add('block');
                document.querySelector(li.getAttribute('data-parent')).classList.remove('hidden');

                e.target.classList.add('text-sky-600');
            });
        });

    </script>
@endpush
@endsection