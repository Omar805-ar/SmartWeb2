<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('merchant.first_name') ? 'invalid' : '' }}">
        <label class="form-label required" for="first_name">{{ trans('cruds.merchant.fields.first_name') }}</label>
        <input class="form-control" type="text" name="first_name" id="first_name" required wire:model.defer="merchant.first_name">
        <div class="validation-message">
            {{ $errors->first('merchant.first_name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.merchant.fields.first_name_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('merchant.last_name') ? 'invalid' : '' }}">
        <label class="form-label required" for="last_name">{{ trans('cruds.merchant.fields.last_name') }}</label>
        <input class="form-control" type="text" name="last_name" id="last_name" required wire:model.defer="merchant.last_name">
        <div class="validation-message">
            {{ $errors->first('merchant.last_name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.merchant.fields.last_name_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('merchant.email') ? 'invalid' : '' }}">
        <label class="form-label required" for="email">{{ trans('cruds.merchant.fields.email') }}</label>
        <input class="form-control" type="email" name="email" id="email" required wire:model.defer="merchant.email">
        <div class="validation-message">
            {{ $errors->first('merchant.email') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.merchant.fields.email_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('merchant.phone') ? 'invalid' : '' }}">
        <label class="form-label required" for="phone">{{ trans('cruds.merchant.fields.phone') }}</label>
        <input class="form-control" type="text" name="phone" id="phone" required wire:model.defer="merchant.phone">
        <div class="validation-message">
            {{ $errors->first('merchant.phone') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.merchant.fields.phone_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('merchant.referral_code') ? 'invalid' : '' }}">
        <label class="form-label required" for="referral_code">{{ trans('cruds.merchant.fields.referral_code') }}</label>
        <input class="form-control" type="text" name="referral_code" id="referral_code" required wire:model.defer="merchant.referral_code">
        <div class="validation-message">
            {{ $errors->first('merchant.referral_code') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.merchant.fields.referral_code_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.merchants.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>