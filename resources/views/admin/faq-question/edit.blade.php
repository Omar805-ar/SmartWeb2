@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="card bg-blueGray-100">
            <div class="card-header">
                <div class="card-header-container">
                    <h6 class="card-title">
                        {{ trans('global.edit') }}
                        {{ trans('cruds.faqQuestion.title_singular') }}:
                        {{ trans('cruds.faqQuestion.fields.id') }}
                        {{ $faqQuestion->id }}
                    </h6>
                </div>
            </div>

            <div class="card-body">
                <form method="post" action="{{ route('admin.faq-questions.update', $faqQuestion->id) }}" class="pt-3">
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
                            <div class="form-group {{ $errors->has('question_ar') ? 'invalid' : '' }}">
                                <label class="form-label required"
                                    for="question_ar">{{ trans('cruds.faqQuestion.fields.question') }} (AR)</label>
                                <textarea rows="4" class="form-control" type="text" name="question_ar" id="question_ar">{{ $faqQuestion->translate('ar')->question }}</textarea>
                                <div class="validation-message">
                                    {{ $errors->first('question_ar') }}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('answer_ar') ? 'invalid' : '' }}">
                                <label class="form-label required"
                                    for="answer_ar">{{ trans('cruds.faqQuestion.fields.answer') }} (AR)</label>
                                <textarea rows="4" class="form-control" type="text" name="answer_ar" id="answer_ar">{{ $faqQuestion->translate('ar')->answer }}</textarea>
                                <div class="validation-message">
                                    {{ $errors->first('answer_ar') }}
                                </div>
                            </div>
                        </div>


                        <div id="english-inputs" class="tabsChild hidden">
                            <div class="form-group {{ $errors->has('question_en') ? 'invalid' : '' }}">
                                <label class="form-label required"
                                    for="question_en">{{ trans('cruds.faqQuestion.fields.question') }} (EN)</label>
                                <textarea rows="4" class="form-control" type="text" name="question_en" id="question_en">{{ $faqQuestion->translate('en')->question }}</textarea>
                                <div class="validation-message">
                                    {{ $errors->first('question_en') }}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('answer_en') ? 'invalid' : '' }}">
                                <label class="form-label required"
                                    for="answer_en">{{ trans('cruds.faqQuestion.fields.answer') }} (EN)</label>
                                <textarea rows="4" class="form-control" type="text" name="answer_en" id="answer_en">{{ $faqQuestion->translate('ar')->answer }}</textarea>
                                <div class="validation-message">
                                    {{ $errors->first('answer_en') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <br>
                    <div class="form-group {{ $errors->has('category_id') ? 'invalid' : '' }}">
                        <label class="form-label required"
                            for="category">{{ trans('cruds.faqQuestion.fields.category') }}</label>


                        <select class="select2 customSelectBox form-control" required id="category_id" name="category_id"
                            data-placeholder="{{ __('global.select_option') }}">
                            @foreach ($listsForFields as $ietm)
                                @foreach ($ietm as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            @endforeach
                        </select>
                        <div class="validation-message">
                            {{ $errors->first('category_id') }}
                        </div>
                        <div class="help-block">
                            {{ trans('cruds.faqQuestion.fields.category_helper') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-indigo mr-2" type="submit">
                            {{ trans('global.save') }}
                        </button>
                        <a href="{{ route('admin.faq-questions.index') }}" class="btn btn-secondary">
                            {{ trans('global.cancel') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('js/multi-language.js') }}"></script>
        @endpush
    @endsection
