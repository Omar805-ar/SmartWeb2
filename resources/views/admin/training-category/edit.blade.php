@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.trainingCategory.title_singular') }}:
                    {{ trans('cruds.trainingCategory.fields.id') }}
                    {{ $trainingCategory->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.training-categories.update', $trainingCategory->id) }}" method="POST" class="pt-3">
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
                        <div class="form-group {{ $errors->has('trainingCategory.name_ar') ? 'invalid' : '' }}">
                            <label class="form-label required" for="name_ar">{{ trans('global.name') }} (AR)</label>
                            <input class="form-control" type="text" name="name_ar" id="name_ar"  value="{{ $trainingCategory->translate('ar')->name }}">
                            <div class="validation-message">
                                {{ $errors->first('trainingCategory.name_ar') }}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('trainingCategory.meta_description_ar') ? 'invalid' : '' }}">
                            <label class="form-label required" for="meta_description_ar">{{ trans('global.meta_description') }} (AR)</label>
                            <textarea class="form-control" type="text" name="meta_description_ar" id="meta_description_ar">{{ $trainingCategory->translate('ar')->meta_description }}</textarea>
                            <div class="validation-message">
                                {{ $errors->first('trainingCategory.meta_description_ar') }}
                            </div>
                        </div>
                    </div>
                    <div id="english-inputs" class="tabsChild hidden">
                        <div class="form-group {{ $errors->has('trainingCategory.name_en') ? 'invalid' : '' }}">
                            <label class="form-label required" for="name_en">{{ trans('global.name') }} (EN)</label>
                            <input class="form-control" type="text" name="name_en" id="name_en"  value="{{ $trainingCategory->translate('en')->name }}">
                            <div class="validation-message">
                                {{ $errors->first('trainingCategory.name_en') }}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('trainingCategory.meta_description_en') ? 'invalid' : '' }}">
                            <label class="form-label required" for="meta_description_en">{{ trans('global.meta_description') }} (EN)</label>
                            <textarea class="form-control" type="text" name="meta_description_en" id="meta_description_en" >{{ $trainingCategory->translate('ar')->meta_description }}</textarea>
                            <div class="validation-message">
                                {{ $errors->first('trainingCategory.meta_description_en') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-indigo mr-2" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
<script src="{{ asset('js/multi-language.js') }}"></script>
@endpush 
@endsection