<form wire:submit.prevent="submit" class="pt-3">
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
            <div class="form-group {{ $errors->has('faqQuestion.question_ar') ? 'invalid' : '' }}">
                <label class="form-label required" for="question_ar">{{ trans('cruds.faqQuestion.fields.question') }} (AR)</label>
                <textarea rows="4" class="form-control" type="text" name="question_ar" id="question_ar"  wire:model.defer="faqQuestion.question_ar"></textarea>
                <div class="validation-message">
                    {{ $errors->first('faqQuestion.question_ar') }}
                </div>
            </div>
            <div class="form-group {{ $errors->has('faqQuestion.answer_ar') ? 'invalid' : '' }}">
                <label class="form-label required" for="answer_ar">{{ trans('cruds.faqQuestion.fields.answer') }} (AR)</label>
                <textarea rows="4" class="form-control" type="text" name="answer_ar" id="answer_ar"  wire:model.defer="faqQuestion.answer_ar"></textarea>
                <div class="validation-message">
                    {{ $errors->first('faqQuestion.answer_ar') }}
                </div>
            </div>
        </div>

        
        <div id="english-inputs" class="tabsChild hidden">
            <div class="form-group {{ $errors->has('faqQuestion.question_en') ? 'invalid' : '' }}">
                <label class="form-label required" for="question_en">{{ trans('cruds.faqQuestion.fields.question') }} (EN)</label>
                <textarea rows="4" class="form-control" type="text" name="question_en" id="question_en"  wire:model.defer="faqQuestion.question_en"></textarea>
                <div class="validation-message">
                    {{ $errors->first('faqQuestion.question_en') }}
                </div>
            </div>
            <div class="form-group {{ $errors->has('faqQuestion.answer_en') ? 'invalid' : '' }}">
                <label class="form-label required" for="answer_en">{{ trans('cruds.faqQuestion.fields.answer') }} (EN)</label>
                <textarea rows="4" class="form-control" type="text" name="answer_en" id="answer_en"  wire:model.defer="faqQuestion.answer_en"></textarea>
                <div class="validation-message">
                    {{ $errors->first('faqQuestion.answer_en') }}
                </div>
            </div>
        </div>
    </div>
    <br>
    <hr>
    <br>
    <div class="form-group {{ $errors->has('faqQuestion.category_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="category">{{ trans('cruds.faqQuestion.fields.category') }}</label>
        <x-select-list class="form-control" required id="category" name="category" :options="$this->listsForFields['category']" wire:model="faqQuestion.category_id" />
        <div class="validation-message">
            {{ $errors->first('faqQuestion.category_id') }}
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
@push('scripts')
<script src="{{ asset('js/multi-language.js') }}"></script>
@endpush