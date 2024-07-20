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
            <div class="form-group {{ $errors->has('country.name_ar') ? 'invalid' : '' }}">
                <label class="form-label required" for="name_ar">{{ trans('global.name') }} (AR)</label>
                <input class="form-control" type="text" name="name_ar" id="name_ar" required wire:model.defer="country.name_ar">
                <div class="validation-message">
                    {{ $errors->first('country.name_ar') }}
                </div>
            </div>
        </div>
        <div id="english-inputs" class="tabsChild hidden">
            <div class="form-group {{ $errors->has('country.name_en') ? 'invalid' : '' }}">
                <label class="form-label required" for="name_en">{{ trans('global.name') }} (EN)</label>
                <input class="form-control" type="text" name="name_en" id="name_en" required wire:model.defer="country.name_en">
                <div class="validation-message">
                    {{ $errors->first('country.name_en') }}
                </div>
            </div>
        </div>
    </div>
    <br>
    <hr>
    <br>
    <div class="form-group {{ $errors->has('country.iso') ? 'invalid' : '' }}">
        <label class="form-label required" for="iso">{{ trans('cruds.country.fields.iso') }}</label>
        <input class="form-control" type="text" name="iso" id="iso" required wire:model.defer="country.iso">
        <div class="validation-message">
            {{ $errors->first('country.iso') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.country.fields.iso_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('country.currency_code') ? 'invalid' : '' }}">
        <label class="form-label required" for="currency_code">{{ trans('cruds.country.fields.currency_code') }}</label>
        <input class="form-control" type="text" name="currency_code" id="currency_code" required wire:model.defer="country.currency_code">
        <div class="validation-message">
            {{ $errors->first('country.currency_code') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.country.fields.currency_code_helper') }}
        </div>
    </div>
    
    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.countries.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>

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