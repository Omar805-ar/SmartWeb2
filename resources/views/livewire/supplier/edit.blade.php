<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('supplier.name') ? 'invalid' : '' }}">
        <label class="form-label required" for="name">{{ trans('cruds.supplier.fields.name') }}</label>
        <input class="form-control" type="text" name="name" id="name" required wire:model.defer="supplier.name">
        <div class="validation-message">
            {{ $errors->first('supplier.name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.supplier.fields.name_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('supplier.email') ? 'invalid' : '' }}">
        <label class="form-label required" for="email">{{ trans('cruds.supplier.fields.email') }}</label>
        <input class="form-control" type="text" name="email" id="email" required wire:model.defer="supplier.email">
        <div class="validation-message">
            {{ $errors->first('supplier.email') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.supplier.fields.email_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('supplier.phone') ? 'invalid' : '' }}">
        <label class="form-label required" for="phone">{{ trans('cruds.supplier.fields.phone') }}</label>
        <input class="form-control" type="text" name="phone" id="phone" required wire:model.defer="supplier.phone">
        <div class="validation-message">
            {{ $errors->first('supplier.phone') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.supplier.fields.phone_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.suppliers.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>