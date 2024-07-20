<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('color.hex') ? 'invalid' : '' }}">
        <label class="form-label required" for="hex">{{ trans('cruds.color.fields.hex') }}</label>
        <input class="form-control" type="color" name="hex" id="hex" required wire:model.defer="color.hex">
        <div class="validation-message">
            {{ $errors->first('color.hex') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.color.fields.hex_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.colors.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>