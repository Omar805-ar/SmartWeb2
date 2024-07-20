<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('bonu.min_orders') ? 'invalid' : '' }}">
        <label class="form-label required" for="min_orders">{{ trans('cruds.bonu.fields.min_orders') }}</label>
        <input class="form-control" type="number" name="min_orders" id="min_orders" required wire:model.defer="bonu.min_orders" step="1">
        <div class="validation-message">
            {{ $errors->first('bonu.min_orders') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.bonu.fields.min_orders_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('bonu.minimum_order_amount') ? 'invalid' : '' }}">
        <label class="form-label required" for="minimum_order_amount">{{ trans('cruds.bonu.fields.minimum_order_amount') }}</label>
        <input class="form-control" type="number" name="minimum_order_amount" id="minimum_order_amount" required wire:model.defer="bonu.minimum_order_amount" step="0.01">
        <div class="validation-message">
            {{ $errors->first('bonu.minimum_order_amount') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.bonu.fields.minimum_order_amount_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('bonu.bonus') ? 'invalid' : '' }}">
        <label class="form-label required" for="bonus">{{ trans('cruds.bonu.fields.bonus') }}</label>
        <input class="form-control" type="number" name="bonus" id="bonus" required wire:model.defer="bonu.bonus" step="0.01">
        <div class="validation-message">
            {{ $errors->first('bonu.bonus') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.bonu.fields.bonus_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('bonu.country_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="country">{{ trans('cruds.bonu.fields.country') }}</label>
        <x-select-list class="form-control" required id="country" name="country" :options="$this->listsForFields['country']" wire:model="bonu.country_id" />
        <div class="validation-message">
            {{ $errors->first('bonu.country_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.bonu.fields.country_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.bonus.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>