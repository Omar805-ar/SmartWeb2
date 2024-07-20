<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('product.category_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="category">{{ trans('cruds.product.fields.category') }}</label>
        <x-select-list class="form-control" required id="category" name="category" :options="$this->listsForFields['category']" wire:model="product.category_id" />
        <div class="validation-message">
            {{ $errors->first('product.category_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.product.fields.category_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('product.country_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="country">{{ trans('cruds.product.fields.country') }}</label>
        <x-select-list class="form-control" required id="country" name="country" :options="$this->listsForFields['country']" wire:model="product.country_id" />
        <div class="validation-message">
            {{ $errors->first('product.country_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.product.fields.country_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('product.price') ? 'invalid' : '' }}">
        <label class="form-label required" for="price">{{ trans('cruds.product.fields.price') }}</label>
        <input class="form-control" type="number" name="price" id="price" required wire:model.defer="product.price" step="0.01">
        <div class="validation-message">
            {{ $errors->first('product.price') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.product.fields.price_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('product.slug') ? 'invalid' : '' }}">
        <label class="form-label required" for="slug">{{ trans('cruds.product.fields.slug') }}</label>
        <input class="form-control" type="text" name="slug" id="slug" required wire:model.defer="product.slug">
        <div class="validation-message">
            {{ $errors->first('product.slug') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.product.fields.slug_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('product.product_code') ? 'invalid' : '' }}">
        <label class="form-label required" for="product_code">{{ trans('cruds.product.fields.product_code') }}</label>
        <input class="form-control" type="text" name="product_code" id="product_code" required wire:model.defer="product.product_code">
        <div class="validation-message">
            {{ $errors->first('product.product_code') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.product.fields.product_code_helper') }}
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