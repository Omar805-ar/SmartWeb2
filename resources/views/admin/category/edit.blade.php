@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="card bg-blueGray-100">
            <div class="card-header">
                <div class="card-header-container">
                    <h6 class="card-title">
                        {{ trans('global.edit') }}
                        {{ trans('cruds.category.title_singular') }}:
                        {{ trans('cruds.category.fields.id') }}
                        {{ $category->id }}
                    </h6>
                </div>
            </div>

            <div class="card-body">

                <form method="POST" action="{{ route('admin.categories.update', $category->id) }}" class="pt-3">
                    @csrf
                    @method('PATCH')
                    <ul
                        class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400 localesTranslateTabs">
                        <li data-parent="#arabic-inputs">
                            <a href="#" aria-current="page" class="me-2 inline-block p-4 rounded-t-lg text-sky-600">
                                {{ auth()->user()->locale == 'ar' ? 'عربي' : 'Arabic' }}
                            </a>
                        </li>
                        <li data-parent="#english-inputs">
                            <a href="#" class="me-2 inline-block p-4 rounded-t-lg ">
                                {{ auth()->user()->locale == 'ar' ? 'انجيليزية' : 'English' }}

                            </a>
                        </li>
                    </ul>
                    <div class="localesTranslateContent pt-4">
                        <div id="arabic-inputs" class="tabsChild block">
                            <div class="form-group {{ $errors->has('category.name_ar') ? 'invalid' : '' }}">
                                <label class="form-label required" for="name_ar">{{ trans('global.name') }} (AR)</label>
                                <input class="form-control" type="text" name="name_ar" id="name_ar" required
                                    value="{{ $category->translate('ar')->name }}">
                                <div class="validation-message">
                                    {{ $errors->first('category.name_ar') }}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('category.meta_description_ar') ? 'invalid' : '' }}">
                                <label class="form-label required"
                                    for="meta_description_ar">{{ trans('global.meta_description') }} (AR)</label>
                                <textarea class="form-control" type="text" name="meta_description_ar" id="meta_description_ar" required>{{ $category->translate('ar')->meta_description}}</textarea>
                                <div class="validation-message">
                                    {{ $errors->first('category.meta_description_ar') }}
                                </div>
                            </div>
                        </div>
                        <div id="english-inputs" class="tabsChild hidden">
                            <div class="form-group {{ $errors->has('category.name_en') ? 'invalid' : '' }}">
                                <label class="form-label required" for="name_en">{{ trans('global.name') }} (EN)</label>
                                <input class="form-control" type="text" name="name_en" id="name_en" required
                                    value="{{ $category->translate('en')->name}}">
                                <div class="validation-message">
                                    {{ $errors->first('category.name_en') }}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('category.meta_description_en') ? 'invalid' : '' }}">
                                <label class="form-label required"
                                    for="meta_description_en">{{ trans('global.meta_description') }} (EN)</label>
                                <textarea class="form-control" type="text" name="meta_description_en" id="meta_description_en" required
                                    >{{ $category->translate('en')->meta_description}}</textarea>
                                <div class="validation-message">
                                    {{ $errors->first('category.meta_description_en') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <br>
                    <div class="form-group {{ $errors->has('category.icon') ? 'invalid' : '' }}">
                        <label class="form-label required" for="icon">{{ trans('cruds.category.fields.icon') }}</label>
                        <input class="form-control" type="text" name="icon" id="icon" required
                            value="{{ $category->icon }}">
                        <div class="validation-message">
                            {{ $errors->first('category.icon') }}
                        </div>
                        <div class="help-block">
                            {{ trans('cruds.category.fields.icon_helper') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-indigo mr-2" type="submit">
                            {{ trans('global.save') }}
                        </button>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
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
