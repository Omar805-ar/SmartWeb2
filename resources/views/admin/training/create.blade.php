@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.create') }}
                    {{ trans('cruds.training.title_singular') }}
                </h6>
            </div>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.trainings.store') }}" enctype="multipart/form-data" method="POST" class="pt-3">
                @csrf
                <div class="form-group {{ $errors->has('training.category_id') ? 'invalid' : '' }}">
                    <div class="form-group {{ $errors->has('category_id') ? 'invalid' : '' }}">
                        <label class="form-label required">{{ trans('cruds.training.fields.category') }}</label>
                        <select class="form-control" id="category_id" name="category_id">
                            <option value="null">{{ trans('global.pleaseSelect') }}...</option>
                            @foreach($listsForFields['category'] as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                        <div class="validation-message">
                            {{ $errors->first('training.type') }}
                        </div>
                        <div class="help-block">
                            {{ trans('cruds.training.fields.type_helper') }}
                        </div>
                    </div>

                    <div class="validation-message">
                        {{ $errors->first('training.category_id') }}
                    </div>
                    <div class="help-block">
                        {{ trans('cruds.training.fields.category_helper') }}
                    </div>
                </div>
               
                <div class="form-group {{ $errors->has('training.type') ? 'invalid' : '' }}">
                    <label class="form-label required">{{ trans('cruds.training.fields.type') }}</label>
                    <select class="form-control" id="TrainingType" name="type">
                        <option value="null">{{ trans('global.pleaseSelect') }}...</option>
                        @foreach($listsForFields['type'] as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    <div class="validation-message">
                        {{ $errors->first('training.type') }}
                    </div>
                    <div class="help-block">
                        {{ trans('cruds.training.fields.type_helper') }}
                    </div>
                </div>
            
                <div class="videoSection hidden">
                    <div class="form-group {{ $errors->has('training.video_iframe') ? 'invalid' : '' }}">
                        <label class="form-label" for="video_iframe">{{ trans('cruds.training.fields.video_iframe') }}</label>
                        <textarea class="form-control" name="video_iframe" id="video_iframe" wire:model.defer="training.video_iframe" rows="4"></textarea>
                        <div class="validation-message">
                            {{ $errors->first('training.video_iframe') }}
                        </div>
                        <div class="help-block">
                            {{ trans('cruds.training.fields.video_iframe_helper') }}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('mediaCollections.training_uploaded_video') ? 'invalid' : '' }}">
                        <label class="form-label" for="uploaded_video">{{ trans('cruds.training.fields.uploaded_video') }}</label>
                        <input type="file" name="uploaded_video">
                        <div class="validation-message">
                            {{ $errors->first('mediaCollections.training_uploaded_video') }}
                        </div>
                        <div class="help-block">
                            {{ trans('cruds.training.fields.uploaded_video_helper') }}
                        </div>
                    </div>    
                </div>
                <div class="articleSection hidden">
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
                            <div class="form-group {{ $errors->has('training.name_ar') ? 'invalid' : '' }}">
                                <label class="form-label required" for="name_ar">{{ trans('global.name') }} (AR)</label>
                                <input class="form-control" type="text" name="name_ar" id="name_ar" required wire:model.defer="training.name_ar">
                                <div class="validation-message">
                                    {{ $errors->first('training.name_ar') }}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('training.description_ar') ? 'invalid' : '' }}">
                                <label class="form-label required" for="description_ar">{{ trans('global.description') }} (AR)</label>
                                <textarea class="form-control" type="text" name="description_ar" id="description_ar"  wire:model.defer="training.description_ar" rows="4"></textarea>
                                <div class="validation-message">
                                    {{ $errors->first('training.description_ar') }}
                                </div>
                            </div>
                        </div>
                        <div id="english-inputs" class="tabsChild hidden">
                            <div class="form-group {{ $errors->has('training.name_en') ? 'invalid' : '' }}">
                                <label class="form-label required" for="name_en">{{ trans('global.name') }} (EN)</label>
                                <input class="form-control" type="text" name="name_en" id="name_en" required wire:model.defer="training.name_en">
                                <div class="validation-message">
                                    {{ $errors->first('training.name_en') }}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('training.description_en') ? 'invalid' : '' }}">
                                <label class="form-label required" for="description_en">{{ trans('global.description') }} (EN)</label>
                                <textarea class="form-control" type="text" name="description_en" id="description_ar"  wire:model.defer="training.description_en" rows="4"></textarea>
                                <div class="validation-message">
                                    {{ $errors->first('training.description_en') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-indigo mr-2" type="submit">
                        {{ trans('global.save') }}
                    </button>
                    <a href="{{ route('admin.trainings.index') }}" class="btn btn-secondary">
                        {{ trans('global.cancel') }}
                    </a>
                </div>
            </form>
            @push('scripts')
            <script src="{{ asset('js/multi-language.js') }}"></script>
            <script>
                $(function () {
                    'use strict';
                    $('#TrainingType').on('change', function(e) {
                        e.preventDefault();
                        if ($(this).val() == 'article') {
                            $('.articleSection').removeClass('hidden');
                            $('.videoSection').addClass('hidden');
                        } else if ($(this).val() == 'video') {
                            $('.articleSection').addClass('hidden');
                            $('.videoSection').removeClass('hidden');
                        } else {
                            $('.articleSection').addClass('hidden');
                            $('.videoSection').addClass('hidden');
                        }
                    });
                });
            </script>
            @endpush

        </div>
    </div>
</div>
@endsection