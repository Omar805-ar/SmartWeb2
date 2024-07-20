<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('size.size') ? 'invalid' : '' }}">
        <label class="form-label required" for="size">{{ trans('cruds.size.fields.size') }}</label>
        <input class="form-control" type="text" name="size" id="size" required wire:model.defer="size.size">
        <div class="validation-message">
            {{ $errors->first('size.size') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.size.fields.size_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.sizes.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>