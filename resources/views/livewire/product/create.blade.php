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
            <div class="form-group {{ $errors->has('product.name_ar') ? 'invalid' : '' }}">
                <label class="form-label required" for="name_ar">{{ trans('global.name') }} (AR)</label>
                <input class="form-control" type="text" name="name_ar" id="name_ar"  wire:model.defer="product.name_ar">
                <div class="validation-message">
                    {{ $errors->first('product.name_ar') }}
                </div>
            </div>
            <div class="form-group {{ $errors->has('product.meta_description_ar') ? 'invalid' : '' }}">
                <label class="form-label required" for="meta_description_ar">{{ trans('global.meta_description') }} (AR)</label>
                <textarea class="form-control" type="text" name="meta_description_ar" id="meta_description_ar"  wire:model.defer="product.meta_description_ar"></textarea>
                <div class="validation-message">
                    {{ $errors->first('product.meta_description_ar') }}
                </div>
            </div>
           
            <div class="form-group {{ $errors->has('product.description_ar') ? 'invalid' : '' }}">
                <label class="form-label required" for="description_ar">{{ trans('global.description') }} (AR)</label>
                <textarea class="form-control" type="text" name="description_ar" id="description_ar"  wire:model.defer="product.description_ar" rows="4"></textarea>
                <div class="validation-message">
                    {{ $errors->first('product.description_ar') }}
                </div>
            </div>
        </div>
        <div id="english-inputs" class="tabsChild hidden">
            <div class="form-group {{ $errors->has('product.name_en') ? 'invalid' : '' }}">
                <label class="form-label required" for="name_en">{{ trans('global.name') }} (EN)</label>
                <input class="form-control" type="text" name="name_en" id="name_en"  wire:model.defer="product.name_en">
                <div class="validation-message">
                    {{ $errors->first('product.name_en') }}
                </div>
            </div>
            <div class="form-group {{ $errors->has('product.meta_description_en') ? 'invalid' : '' }}">
                <label class="form-label required" for="meta_description_en">{{ trans('global.meta_description') }} (EN)</label>
                <textarea class="form-control" type="text" name="meta_description_en" id="meta_description_en"  wire:model.defer="product.meta_description_en"></textarea>
                <div class="validation-message">
                    {{ $errors->first('product.meta_description_en') }}
                </div>
            </div>
            
            <div class="form-group {{ $errors->has('product.description_en') ? 'invalid' : '' }}">
                <label class="form-label required" for="description_en">{{ trans('global.description') }} (EN)</label>
                <textarea class="form-control" type="text" name="description_en" id="description_en"  wire:model.defer="product.description_en" rows="4"></textarea>
                <div class="validation-message">
                    {{ $errors->first('product.description_en') }}
                </div>
            </div>
        </div>
    </div>
    <br>
    <hr>
    <br> 
    <div class="form-group {{ $errors->has('product.category_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="category_id">{{ trans('cruds.product.fields.category_id') }}</label>
        <x-select-list class="form-control" 
         id="category_id" 
        name="category_id" 
        :options="$this->listsForFields['category']" 
        wire:model="product.category_id" />
        <div class="validation-message">
            {{ $errors->first('product.category_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.product.fields.category_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('product.country_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="country_id">{{ trans('cruds.product.fields.country_id') }}</label>
        <x-select-list class="form-control" 
         id="country_id" 
        name="country_id" 
        :options="$this->listsForFields['country']" 
        wire:model="product.country_id" />
        <div class="validation-message">
            {{ $errors->first('product.country_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.product.fields.country_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('product.colors') ? 'invalid' : '' }}">
        <label class="form-label" for="colors">{{ trans('cruds.product.fields.colors') }}</label>
        <x-select-list 
        multiple
        class="form-control" id="colors" name="colors[]" :options="$this->listsForFields['color']" wire:model="product.colors" />
        <div class="validation-message">
            {{ $errors->first('product.colors') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.product.fields.colors_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('product.sizes') ? 'invalid' : '' }}">
        <label class="form-label" for="sizes">{{ trans('cruds.product.fields.sizes') }}</label>
        <x-select-list 
        multiple
        class="form-control" id="sizes" name="sizes[]" :options="$this->listsForFields['size']" wire:model="product.sizes" />
        <div class="validation-message">
            {{ $errors->first('product.sizes') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.product.fields.sizes_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('product.price') ? 'invalid' : '' }}">
        <label class="form-label required" for="price">{{ trans('cruds.product.fields.price') }}</label>
        <input class="form-control" type="number" name="price" id="price"  wire:model.defer="product.price" step="0.01">
        <div class="validation-message">
            {{ $errors->first('product.price') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.product.fields.price_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('product.supplier_id') ? 'invalid' : '' }}">
        <label class="form-label" for="supplier">{{ trans('cruds.product.fields.supplier') }}</label>
        <x-select-list class="form-control" id="supplier" name="supplier" :options="$this->listsForFields['supplier']" wire:model="product.supplier_id" />
        <div class="validation-message">
            {{ $errors->first('product.supplier_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.product.fields.supplier_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('product.product_code') ? 'invalid' : '' }}">
        <label class="form-label" for="product_code">{{ trans('cruds.product.fields.product_code') }}</label>
        <input class="form-control" type="text" name="product_code" id="product_code" wire:model.defer="product.product_code">
        <div class="validation-message">
            {{ $errors->first('product.product_code') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.product.fields.product_code_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('mediaCollections.product_thumbnail') ? 'invalid' : '' }}">
        <label class="form-label required" for="thumbnail">{{ trans('cruds.product.fields.thumbnail') }}</label>
        <x-dropzone id="thumbnail" name="thumbnail" action="{{ route('admin.products.storeMedia') }}" collection-name="product_thumbnail" max-file-size="2" max-width="4096" max-height="4096" max-files="1" />
        <div class="validation-message">
            {{ $errors->first('mediaCollections.product_thumbnail') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.product.fields.thumbnail_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('mediaCollections.product_images') ? 'invalid' : '' }}">
        <label class="form-label required" for="images">{{ trans('cruds.product.fields.images') }}</label>
        <x-dropzone id="images" name="images" action="{{ route('admin.products.storeMedia') }}" collection-name="product_images" max-file-size="2" max-width="4096" max-height="4096" />
        <div class="validation-message">
            {{ $errors->first('mediaCollections.product_images') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.product.fields.images_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('mediaCollections.product_videos') ? 'invalid' : '' }}">
        <label class="form-label" for="videos">{{ trans('cruds.product.fields.videos') }}</label>
        <x-dropzone id="videos" name="videos" action="{{ route('admin.products.storeMedia') }}" collection-name="product_videos" max-file-size="30" />
        <div class="validation-message">
            {{ $errors->first('mediaCollections.product_videos') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.product.fields.videos_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form> 


@push('scripts')
<script src="{{ asset('js/multi-language.js') }}"></script>
<script>
    let myObj = {};
    $('select.select2').each(function() {

        if($(this).prop('multiple')) {
            $(this).on('change', function(e) {
            let data = $(this).select2("val");
            if (data === "") {
                data = null
            }
            myObj[$(this).attr('id')] = data;
        });
        } 
  
    });

    Livewire.on('getSelects', () => {
            console.log(myObj);
            Livewire.emit('doneSave', myObj);

        })

   
</script>
@endpush 