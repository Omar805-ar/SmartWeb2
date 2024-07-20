<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('penalty.merchant_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="merchant">{{ trans('cruds.penalty.fields.merchant') }}</label>
        <x-select-list class="form-control" required id="merchant" name="merchant" :options="$this->listsForFields['merchant']" wire:model="penalty.merchant_id" />
        <div class="validation-message">
            {{ $errors->first('penalty.merchant_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.penalty.fields.merchant_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('penalty.reason') ? 'invalid' : '' }}">
        <label class="form-label" for="reason">{{ trans('cruds.penalty.fields.reason') }}</label>
        <input class="form-control" type="text" name="reason" id="reason" wire:model.defer="penalty.reason">
        <div class="validation-message">
            {{ $errors->first('penalty.reason') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.penalty.fields.reason_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('penalty.amount') ? 'invalid' : '' }}">
        <label class="form-label required" for="amount">{{ trans('cruds.penalty.fields.amount') }}</label>
        <input class="form-control" type="number" name="amount" id="amount" required wire:model.defer="penalty.amount" step="0.01">
        <div class="validation-message">
            {{ $errors->first('penalty.amount') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.penalty.fields.amount_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('penalty.country_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="country">{{ trans('cruds.penalty.fields.country') }}</label>
        <x-select-list class="form-control" required id="country" name="country" :options="$this->listsForFields['country']" wire:model="penalty.country_id" />
        <div class="validation-message">
            {{ $errors->first('penalty.country_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.penalty.fields.country_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.penalties.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>