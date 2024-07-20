<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('government.country_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="country">{{ trans('cruds.government.fields.country') }}</label>
        <x-select-list class="form-control" required id="country" name="country" :options="$this->listsForFields['country']" wire:model="government.country_id" />
        <div class="validation-message">
            {{ $errors->first('government.country_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.government.fields.country_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.governments.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>