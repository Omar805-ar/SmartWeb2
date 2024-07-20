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
            <div class="form-group {{ $errors->has('faqCategory.category') ? 'invalid' : '' }}">
                <label class="form-label required" for="category_ar">{{ trans('global.name') }} (AR)</label>
                <input class="form-control" type="text" name="category_ar" id="category_ar"  wire:model.defer="faqCategory.category_ar">
                <div class="validation-message">
                    {{ $errors->first('faqCategory.category') }}
                </div>
            </div>
        </div>
        <div id="english-inputs" class="tabsChild hidden">
            <div class="form-group {{ $errors->has('faqCategory.category') ? 'invalid' : '' }}">
                <label class="form-label required" for="category_en">{{ trans('global.name') }} (EN)</label>
                <input class="form-control" type="text" name="category_en" id="category_en"  wire:model.defer="faqCategory.category_en">
                <div class="validation-message">
                    {{ $errors->first('faqCategory.category') }}
                </div>
            </div>
        </div>
    </div>


    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.faq-categories.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>
@push('scripts')
<script src="{{ asset('js/multi-language.js') }}"></script>
@endpush