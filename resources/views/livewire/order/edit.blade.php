<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('order.admin_subtotal') ? 'invalid' : '' }}">
        <label class="form-label required" for="admin_subtotal">{{ trans('cruds.order.fields.admin_subtotal') }}</label>
        <input class="form-control" type="number" name="admin_subtotal" id="admin_subtotal" required wire:model.defer="order.admin_subtotal" step="0.01">
        <div class="validation-message">
            {{ $errors->first('order.admin_subtotal') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.order.fields.admin_subtotal_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('order.merchant_subtotal') ? 'invalid' : '' }}">
        <label class="form-label required" for="merchant_subtotal">{{ trans('cruds.order.fields.merchant_subtotal') }}</label>
        <input class="form-control" type="number" name="merchant_subtotal" id="merchant_subtotal" required wire:model.defer="order.merchant_subtotal" step="0.01">
        <div class="validation-message">
            {{ $errors->first('order.merchant_subtotal') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.order.fields.merchant_subtotal_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('order.shipping_cost') ? 'invalid' : '' }}">
        <label class="form-label required" for="shipping_cost">{{ trans('cruds.order.fields.shipping_cost') }}</label>
        <input class="form-control" type="number" name="shipping_cost" id="shipping_cost" required wire:model.defer="order.shipping_cost" step="0.01">
        <div class="validation-message">
            {{ $errors->first('order.shipping_cost') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.order.fields.shipping_cost_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('order.admin_grand_total') ? 'invalid' : '' }}">
        <label class="form-label required" for="admin_grand_total">{{ trans('cruds.order.fields.admin_grand_total') }}</label>
        <input class="form-control" type="number" name="admin_grand_total" id="admin_grand_total" required wire:model.defer="order.admin_grand_total" step="0.01">
        <div class="validation-message">
            {{ $errors->first('order.admin_grand_total') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.order.fields.admin_grand_total_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('order.merchant_grand_total') ? 'invalid' : '' }}">
        <label class="form-label required" for="merchant_grand_total">{{ trans('cruds.order.fields.merchant_grand_total') }}</label>
        <input class="form-control" type="text" name="merchant_grand_total" id="merchant_grand_total" required wire:model.defer="order.merchant_grand_total">
        <div class="validation-message">
            {{ $errors->first('order.merchant_grand_total') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.order.fields.merchant_grand_total_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('order.admin_net_profit') ? 'invalid' : '' }}">
        <label class="form-label required" for="admin_net_profit">{{ trans('cruds.order.fields.admin_net_profit') }}</label>
        <input class="form-control" type="number" name="admin_net_profit" id="admin_net_profit" required wire:model.defer="order.admin_net_profit" step="0.01">
        <div class="validation-message">
            {{ $errors->first('order.admin_net_profit') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.order.fields.admin_net_profit_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('order.merchant_net_profit') ? 'invalid' : '' }}">
        <label class="form-label required" for="merchant_net_profit">{{ trans('cruds.order.fields.merchant_net_profit') }}</label>
        <input class="form-control" type="number" name="merchant_net_profit" id="merchant_net_profit" required wire:model.defer="order.merchant_net_profit" step="0.01">
        <div class="validation-message">
            {{ $errors->first('order.merchant_net_profit') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.order.fields.merchant_net_profit_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('order.merchant_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="merchant">{{ trans('cruds.order.fields.merchant') }}</label>
        <x-select-list class="form-control" required id="merchant" name="merchant" :options="$this->listsForFields['merchant']" wire:model="order.merchant_id" />
        <div class="validation-message">
            {{ $errors->first('order.merchant_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.order.fields.merchant_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('order.country_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="country">{{ trans('cruds.order.fields.country') }}</label>
        <x-select-list class="form-control" required id="country" name="country" :options="$this->listsForFields['country']" wire:model="order.country_id" />
        <div class="validation-message">
            {{ $errors->first('order.country_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.order.fields.country_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('order.city') ? 'invalid' : '' }}">
        <label class="form-label required" for="city">{{ trans('cruds.order.fields.city') }}</label>
        <input class="form-control" type="text" name="city" id="city" required wire:model.defer="order.city">
        <div class="validation-message">
            {{ $errors->first('order.city') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.order.fields.city_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('order.address') ? 'invalid' : '' }}">
        <label class="form-label required" for="address">{{ trans('cruds.order.fields.address') }}</label>
        <input class="form-control" type="text" name="address" id="address" required wire:model.defer="order.address">
        <div class="validation-message">
            {{ $errors->first('order.address') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.order.fields.address_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('order.address_2') ? 'invalid' : '' }}">
        <label class="form-label" for="address_2">{{ trans('cruds.order.fields.address_2') }}</label>
        <input class="form-control" type="text" name="address_2" id="address_2" wire:model.defer="order.address_2">
        <div class="validation-message">
            {{ $errors->first('order.address_2') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.order.fields.address_2_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('order.notes') ? 'invalid' : '' }}">
        <label class="form-label" for="notes">{{ trans('cruds.order.fields.notes') }}</label>
        <input class="form-control" type="text" name="notes" id="notes" wire:model.defer="order.notes">
        <div class="validation-message">
            {{ $errors->first('order.notes') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.order.fields.notes_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('order.status') ? 'invalid' : '' }}">
        <label class="form-label">{{ trans('cruds.order.fields.status') }}</label>
        <select class="form-control" wire:model="order.status">
            <option value="null" disabled>{{ trans('global.pleaseSelect') }}...</option>
            @foreach($this->listsForFields['status'] as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
        <div class="validation-message">
            {{ $errors->first('order.status') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.order.fields.status_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>